<?php

namespace App\Controllers;

use App\Models\TrDaftarModel;
use CodeIgniter\RESTful\ResourceController;

/**
 * Pasien Controller
 * 
 * @author Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * @date 2025-04-23
 */
class Pasien extends ResourceController
{
    protected $modelName = 'App\Models\TrDaftarModel';
    protected $format = 'json';

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $data = $this->model->find($id);
        if (!$data) {
            return $this->failNotFound('Data tidak ditemukan');
        }
        return $this->respond($data);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $data = $this->request->getJSON(true);
        $data['uuid'] = generate_uuid();
        $data['tgl_simpan'] = date('Y-m-d H:i:s');
        $data['tgl_modif'] = date('Y-m-d H:i:s');
        
        if (!$this->model->insert($data)) {
            return $this->fail($this->model->errors());
        }

        return $this->respondCreated($data, 'Data berhasil ditambahkan');
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $data = $this->request->getJSON(true);
        $data['tgl_modif'] = date('Y-m-d H:i:s');
        
        if (!$this->model->update($id, $data)) {
            return $this->fail($this->model->errors());
        }

        return $this->respond($data, 200, 'Data berhasil diupdate');
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        if (!$this->model->delete($id)) {
            return $this->fail($this->model->errors());
        }

        return $this->respondDeleted(['id' => $id], 'Data berhasil dihapus');
    }
} 