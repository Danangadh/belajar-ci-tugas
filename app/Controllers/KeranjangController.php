<?php

use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\Cart\Cart;

class KeranjangController extends BaseController
{
public function add()
{
    $cart = \Config\Services::cart();
    $request = \Config\Services::request();

    $id     = $request->getPost('id');
    $name   = $request->getPost('nama');
    $price  = $request->getPost('harga');
    $qty    = 1;

    $diskon = session()->get('diskon') ?? 0;
    $finalPrice = max(0, $price - $diskon); // potong diskon per item

    $cart->insert([
        'id'      => $id,
        'qty'     => $qty,
        'price'   => $finalPrice,
        'name'    => $name,
        'options' => ['diskon' => $diskon]
    ]);

    return redirect()->to('/keranjang')->with('success', 'Produk berhasil dimasukkan ke keranjang.');
}
}
