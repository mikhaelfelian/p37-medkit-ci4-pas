<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * VKamar Model
 */
class VKamarModel extends Model
{
    protected $table = 'tbl_m_kamar';
    protected $primaryKey = 'id';
    protected $returnType = 'object';

    /**
     * Get kamar data with occupancy info
     * 
     * @return array
     */
    public function getKamarData()
    {
        $subquery = "(SELECT COUNT(0) FROM tbl_trans_medcheck_kamar 
                    JOIN tbl_trans_medcheck ON tbl_trans_medcheck_kamar.id_medcheck = tbl_trans_medcheck.id 
                    WHERE tbl_trans_medcheck_kamar.id_kamar = tbl_m_kamar.id 
                    AND tbl_trans_medcheck_kamar.status = '1' 
                    AND tbl_trans_medcheck.status_bayar = '0')";

        return $this->select("
            tbl_m_kamar.id,
            tbl_m_kamar.kode,
            tbl_m_kamar.kamar,
            tbl_m_kamar.tipe,
            tbl_m_kamar.jml_max,
            {$subquery} as jml,
            tbl_m_kamar.jml_max - {$subquery} as sisa
        ")
        ->where('tbl_m_kamar.status', '1')
        ->orderBy('tbl_m_kamar.id')
        ->findAll();
    }
} 