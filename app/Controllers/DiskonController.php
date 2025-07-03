<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DiskonModel;

class DiskonController extends BaseController
{
    protected $diskon;

    public function __construct()
    {
        $this->diskon = new DiskonModel();
    }

    private function isAdmin()
    {
        return session()->get('role') === 'admin';
    }

    public function index()
    {
        if (!$this->isAdmin()) return redirect()->to('/');

        $q = $this->request->getGet('q'); // ambil query pencarian
        $builder = $this->diskon;

        if ($q) {
            $builder = $builder
                        ->like('tanggal', $q)
                        ->orLike('nominal', $q);
        }

        $data['diskon'] = $builder->findAll();
        $data['q'] = $q; // kirim query ke view

        return view('v_diskon', $data);
    }

    public function create()
    {
        if (!$this->isAdmin()) return redirect()->to('/');
        return view('v_diskon_create');
    }

    public function store()
{
    if (!$this->isAdmin()) return redirect()->to('/');

    $rules = [
        'tanggal' => 'required|is_unique[diskon.tanggal]',
        'nominal' => 'required|numeric'
    ];

    if (!$this->validate($rules)) {
        // simpan error & beri trigger untuk buka modal
        return redirect()->to('/diskon')
                         ->withInput()
                         ->with('errors', $this->validator->getErrors())
                         ->with('show_add_modal', true)
                         ->with('failed', 'Gagal menambahkan diskon. Tanggal tidak boleh sama!.');
    }

    $this->diskon->save([
        'tanggal' => $this->request->getPost('tanggal'),
        'nominal' => $this->request->getPost('nominal'),
    ]);

    return redirect()->to('/diskon')->with('success', 'Diskon berhasil ditambahkan.');
}


    public function edit($id)
    {
        if (!$this->isAdmin()) return redirect()->to('/');
        $diskon = $this->diskon->find($id);
        return view('v_diskon_edit', ['diskon' => $diskon]);
    }

    public function update($id)
    {
        if (!$this->isAdmin()) return redirect()->to('/');
        $this->diskon->update($id, [
            'nominal' => $this->request->getPost('nominal'),
        ]);
        return redirect()->to('/diskon')->with('success', 'Diskon berhasil diubah.');
    }

    public function delete($id)
    {
        if (!$this->isAdmin()) return redirect()->to('/');
        $this->diskon->delete($id);
        return redirect()->to('/diskon')->with('success', 'Diskon berhasil dihapus.');
    }
}
