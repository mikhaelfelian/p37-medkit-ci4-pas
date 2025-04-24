<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * VDokter Model
 * 
 * @author Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * @date 2025-04-23
 */
class VDokterModel extends Model
{
    protected $table            = 'v_master_dokter';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';

    /**
     * Get dokter by poli_id
     * 
     * @param int $poli_id
     * @return array
     */
    public function getDokterByPoli($poli_id)
    {
        return $this->where('id_poli', $poli_id)
                    ->where('status_prtk', 1)
                    ->groupBy('id_user')
                    ->orderBy('id_poli', 'ASC')
                    ->findAll();
    }

    /**
     * Get jadwal dokter where days are not empty
     * 
     * @return array
     */
    public function getJadwalDokter()
    {
        return $this->where('hari_1 !=', '')
                    ->orWhere('hari_2 !=', '')
                    ->orWhere('hari_3 !=', '')
                    ->orWhere('hari_4 !=', '')
                    ->orWhere('hari_5 !=', '')
                    ->orWhere('hari_6 !=', '')
                    ->orWhere('hari_7 !=', '')
                    ->where('status_prtk', 1)
                    ->where('status_aps', 0)
                    ->orderBy('id_poli', 'ASC')
                    ->findAll();
    }
} 