<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class TransaksiController extends BaseController
{
    protected $cart;

    function __construct()
    {
        helper('number');
        helper('form');
        $this->cart = \Config\Services::cart();
    }

    public function index()
    {
        $data['items'] = $this->cart->contents();
        $data['total'] = $this->cart->total();
        return view('v_keranjang', $data);
    }

    public function cart_add()
    {
        $this->cart->insert(array(
            'id'        => $this->request->getPost('id'),
            'qty'       => 1,
            'price'     => $this->request->getPost('harga'),
            'name'      => $this->request->getPost('nama'),
            'options'   => array('foto' => $this->request->getPost('foto'))
        ));
        session()->setflashdata('success', 'Produk berhasil ditambahkan ke keranjang. (<a href="' . base_url() . 'keranjang">Lihat</a>)');
        return redirect()->to(base_url('/'));
    }

    public function cart_clear()
    {
        $this->cart->destroy();
        session()->setflashdata('success', 'Keranjang Berhasil Dikosongkan');
        return redirect()->to(base_url('keranjang'));
    }

    public function cart_edit()
    {
        $i = 1;
        foreach ($this->cart->contents() as $value) {
            $this->cart->update(array(
                'rowid' => $value['rowid'],
                'qty'   => $this->request->getPost('qty' . $i++)
            ));
        }

        session()->setflashdata('success', 'Keranjang Berhasil Diedit');
        return redirect()->to(base_url('keranjang'));
    }

    public function cart_delete($rowid)
    {
        $this->cart->remove($rowid);
        session()->setflashdata('success', 'Keranjang Berhasil Dihapus');
        return redirect()->to(base_url('keranjang'));
    }
    public function checkout()
{
    $cart = \Config\Services::cart();
    $db = \Config\Database::connect();
    $builder = $db->table('transaksi');

    $userId = session()->get('user_id'); // sesuaikan
    $tanggal = date('Y-m-d');

    // hitung total langsung dari cart (price sudah diskon)
    $total = 0;
    foreach ($cart->contents() as $item) {
        $total += $item['price'] * $item['qty'];
    }

    // simpan transaksi (header)
    $builder->insert([
        'user_id' => $userId,
        'total' => $total,
        'tanggal' => $tanggal
    ]);

    $transaksiId = $db->insertID();

    // simpan detail transaksi
    $detailBuilder = $db->table('transaction_detail');
    foreach ($cart->contents() as $item) {
        $subtotal = $item['price'] * $item['qty'];

        $detailBuilder->insert([
            'transaksi_id' => $transaksiId,
            'produk_id'    => $item['id'],
            'qty'          => $item['qty'],
            'harga'        => $item['price'], // sudah diskon
            'subtotal'     => $subtotal
        ]);
    }

    $cart->destroy();
    return redirect()->to('/transaksi')->with('success', 'Transaksi berhasil disimpan.');
}


}

