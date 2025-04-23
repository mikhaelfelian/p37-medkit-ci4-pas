<?php

namespace App\Controllers;

use App\Models\TrDaftarModel;
use CodeIgniter\Controller;

/**
 * Pasien Controller
 * 
 * @author Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * @date 2025-04-23
 */
class Pasien extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new TrDaftarModel();
    }

    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index()
    {
        $data = [
            'title' => 'Daftar Pasien',
            'data' => $this->model->findAll()
        ];
        return view('admin-lte-2/pasien/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return mixed
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Pasien'
        ];
        return view('admin-lte-2/pasien/create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return mixed
     */
    public function store()
    {
        $data = $this->request->getPost();
        $data['uuid'] = generate_uuid();
        
        if (!$this->model->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        return redirect()->to('pasien')->with('message', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return mixed
     */
    public function show($id = null)
    {
        $data = $this->model->find($id);
        if (!$data) {
            return redirect()->to('pasien')->with('error', 'Data tidak ditemukan');
        }

        return view('admin-lte-2/pasien/show', [
            'title' => 'Detail Pasien',
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return mixed
     */
    public function edit($id = null)
    {
        $data = $this->model->find($id);
        if (!$data) {
            return redirect()->to('pasien')->with('error', 'Data tidak ditemukan');
        }

        return view('admin-lte-2/pasien/edit', [
            'title' => 'Edit Pasien',
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return mixed
     */
    public function update($id = null)
    {
        $data = $this->request->getPost();
        
        if (!$this->model->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        return redirect()->to('pasien')->with('message', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return mixed
     */
    public function delete($id = null)
    {
        if (!$this->model->delete($id)) {
            return redirect()->to('pasien')->with('error', 'Gagal menghapus data');
        }

        return redirect()->to('pasien')->with('message', 'Data berhasil dihapus');
    }
} 