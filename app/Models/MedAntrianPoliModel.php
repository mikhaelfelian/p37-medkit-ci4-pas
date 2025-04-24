<?php

namespace App\Models;

use CodeIgniter\Model;

class MedAntrianPoliModel extends Model
{
    protected $table            = 'mpoli';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $allowedFields    = [
        'id_poli',
        'id_view',
        'kode',
        'poli',
        'icon',
        'style',
        'status',
        'status_tmpl',
        'status_ant',
        'sp',
        'sort'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'tgl_simpan';
    protected $updatedField  = 'tgl_modif';

    // Validation
    protected $validationRules      = [
        'kode' => 'required|min_length[2]|max_length[50]',
        'poli' => 'required|min_length[2]|max_length[160]',
        'icon' => 'required|min_length[2]|max_length[50]',
        'style' => 'required|min_length[2]|max_length[50]',
        'status' => 'required|in_list[0,1]',
        'status_tmpl' => 'required|in_list[0,1,2]',
        'status_ant' => 'required|in_list[0,1]',
        'sp' => 'required|in_list[0,1,2]',
        'sort' => 'required|numeric'
    ];
    protected $validationMessages   = [
        'kode' => [
            'required' => 'Kode poli harus diisi',
            'min_length' => 'Kode poli minimal 2 karakter',
            'max_length' => 'Kode poli maksimal 50 karakter'
        ],
        'poli' => [
            'required' => 'Nama poli harus diisi',
            'min_length' => 'Nama poli minimal 2 karakter',
            'max_length' => 'Nama poli maksimal 160 karakter'
        ]
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['beforeInsert'];
    protected $beforeUpdate   = ['beforeUpdate'];

    protected function beforeInsert(array $data)
    {
        $data['data']['tgl_simpan'] = date('Y-m-d H:i:s');
        $data['data']['tgl_modif']  = date('Y-m-d H:i:s');
        return $data;
    }

    protected function beforeUpdate(array $data)
    {
        $data['data']['tgl_modif'] = date('Y-m-d H:i:s');
        return $data;
    }

    /**
     * Get active polis
     * 
     * @return array
     */
    public function getActivePolis()
    {
        return $this->where('status', '1')
                    ->orderBy('sort', 'ASC')
                    ->findAll();
    }

    /**
     * Get polis with active queue
     * 
     * @return array
     */
    public function getPolisWithQueue()
    {
        return $this->where('status', '1')
                    ->where('status_ant', '1')
                    ->orderBy('sort', 'ASC')
                    ->findAll();
    }

    /**
     * Get polis by template status
     * 
     * @param string $status_tmpl Template status (0,1,2)
     * @return array
     */
    public function getPolisByTemplate($status_tmpl)
    {
        return $this->where('status', '1')
                    ->where('status_tmpl', $status_tmpl)
                    ->orderBy('sort', 'ASC')
                    ->findAll();
    }

    /**
     * Get polis by special position
     * 
     * @param string $sp Special position (0,1,2)
     * @return array
     */
    public function getPolisBySpecialPosition($sp)
    {
        return $this->where('status', '1')
                    ->where('sp', $sp)
                    ->orderBy('sort', 'ASC')
                    ->findAll();
    }

    /**
     * Get poli by code
     * 
     * @param string $kode Poli code
     * @return object|null
     */
    public function getPoliByCode($kode)
    {
        return $this->where('kode', $kode)
                    ->where('status', '1')
                    ->first();
    }

    /**
     * Get poli by id_poli
     * 
     * @param int $id_poli Poli ID
     * @return object|null
     */
    public function getPoliById($id_poli)
    {
        return $this->where('id_poli', $id_poli)
                    ->where('status', '1')
                    ->first();
    }

    /**
     * Update poli status
     * 
     * @param int $id Poli ID
     * @param string $status New status (0,1)
     * @return bool
     */
    public function updateStatus($id, $status)
    {
        return $this->update($id, ['status' => $status]);
    }

    /**
     * Update poli queue status
     * 
     * @param int $id Poli ID
     * @param string $status_ant New queue status (0,1)
     * @return bool
     */
    public function updateQueueStatus($id, $status_ant)
    {
        return $this->update($id, ['status_ant' => $status_ant]);
    }
} 