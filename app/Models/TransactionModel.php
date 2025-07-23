<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table = 'transaction';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'username', 'total_harga', 'alamat', 'ongkir', 'status', 'created_at', 'updated_at'
    ];

    public function cart_add()
{
    $diskon = session()->get('diskon') ?? 0;

    $hargaAsli = $this->request->getPost('harga');
    $hargaDiskon = max(0, $hargaAsli - $diskon);

    $this->cart->insert([
        'id'      => $this->request->getPost('id'),
        'qty'     => 1,
        'price'   => $hargaDiskon, // ✅ harga sudah dipotong
        'name'    => $this->request->getPost('nama'),
        'options' => [
            'foto'   => $this->request->getPost('foto'),
            'diskon' => $diskon
        ]
    ]);

    session()->setFlashdata('success', 'Produk berhasil ditambahkan ke keranjang.');
    return redirect()->to(base_url('/'));
}

}