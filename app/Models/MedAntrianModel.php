<?php

namespace App\Models;

use CodeIgniter\Model;

class MedAntrianModel extends Model
{
    protected $table            = 'tr_queue';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $allowedFields    = [
        'id_view',
        'id_medcheck',
        'id_dft',
        'ddate',
        'cnoro',
        'ncount',
        'ccustsrv',
        'cnote',
        'csflagqu',
        'csflaghd',
        'ccode',
        'crgcode',
        'ddatestart',
        'ddatepross',
        'ddateend',
        'cUser',
        'suara',
        'suara2',
        'status',
        'status_pgl',
        'dCreateDate',
        'dLastUpdate'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'dCreateDate';
    protected $updatedField  = 'dLastUpdate';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['beforeInsert'];
    protected $beforeUpdate   = ['beforeUpdate'];

    protected function beforeInsert(array $data)
    {
        $data['data']['dCreateDate'] = date('Y-m-d H:i:s');
        $data['data']['dLastUpdate'] = date('Y-m-d H:i:s');
        return $data;
    }

    protected function beforeUpdate(array $data)
    {
        $data['data']['dLastUpdate'] = date('Y-m-d H:i:s');
        return $data;
    }

    /**
     * Get queue by date and status
     * 
     * @param string $date Date in Y-m-d format
     * @param string $status Queue status (0,1,2)
     * @return array
     */
    public function getQueueByDate($date, $status = '0')
    {
        return $this->where('ddate', $date)
                    ->where('status', $status)
                    ->orderBy('ncount', 'ASC')
                    ->findAll();
    }

    /**
     * Get next queue number for a specific date
     * 
     * @param string $date Date in Y-m-d format
     * @return int
     */
    public function getNextQueueNumber($date, $poli)
    {
        $lastQueue = $this->select('ncount')
                         ->where('ddate', $date)
                         ->where('cnoro', $poli)
                         ->orderBy('ncount', 'DESC')
                         ->first();

        return $lastQueue ? $lastQueue->ncount + 1 : 1;
    }

    /**
     * Update queue status
     * 
     * @param int $id Queue ID
     * @param string $status New status (0,1,2)
     * @return bool
     */
    public function updateStatus($id, $status)
    {
        return $this->update($id, ['status' => $status]);
    }

    /**
     * Get active queue by date
     * 
     * @param string $date Date in Y-m-d format
     * @return array
     */
    public function getActiveQueue($date)
    {
        return $this->where('ddate', $date)
                    ->where('status', '0')
                    ->orderBy('ncount', 'ASC')
                    ->findAll();
    }

    /**
     * Get processed queue by date
     * 
     * @param string $date Date in Y-m-d format
     * @return array
     */
    public function getProcessedQueue($date)
    {
        return $this->where('ddate', $date)
                    ->where('status', '1')
                    ->orderBy('ddatepross', 'DESC')
                    ->findAll();
    }

    /**
     * Get completed queue by date
     * 
     * @param string $date Date in Y-m-d format
     * @return array
     */
    public function getCompletedQueue($date)
    {
        return $this->where('ddate', $date)
                    ->where('status', '2')
                    ->orderBy('ddateend', 'DESC')
                    ->findAll();
    }
} 