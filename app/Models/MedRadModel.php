<?php

namespace App\Models;

use CodeIgniter\Model;

class MedRadModel extends Model
{
    protected $table            = 'tbl_trans_medcheck_rad';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_medcheck',
        'id_pasien',
        'id_user',
        'id_radiografer',
        'id_dokter',
        'id_dokter_kirim',
        'tgl_simpan',
        'tgl_modif',
        'tgl_masuk',
        'tgl_keluar',
        'no_rad',
        'no_sample',
        'dokter_kirim',
        'file_name',
        'ket',
        'item',
        'status',
        'status_dokter_krm'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'tgl_simpan';
    protected $updatedField  = 'tgl_modif';

    /**
     * Get rad data with related information
     *
     * @param int|null $id
     * @return object|null
     */
    public function getRadData($id = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('
            tbl_trans_medcheck_rad.*,
            m1.nama AS nama_radiografer,
            m2.nama AS nama_dokter,
            m3.nama AS nama_dokter_kirim,
            p.nama AS nama_pasien
        ');
        $builder->join('tbl_master_pegawai m1', 'm1.id = tbl_trans_medcheck_rad.id_radiografer', 'left');
        $builder->join('tbl_master_pegawai m2', 'm2.id = tbl_trans_medcheck_rad.id_dokter', 'left');
        $builder->join('tbl_master_pegawai m3', 'm3.id = tbl_trans_medcheck_rad.id_dokter_kirim', 'left');
        $builder->join('tbl_master_pasien p', 'p.id = tbl_trans_medcheck_rad.id_pasien', 'left');

        if ($id !== null) {
            $builder->where('tbl_trans_medcheck_rad.id', $id);
            return $builder->get()->getRow();
        }

        return $builder->get()->getResult();
    }

    /**
     * Get rad data by medcheck ID
     *
     * @param int $medcheckId
     * @return object|null
     */
    public function getRadByMedcheck($medcheckId)
    {
        return $this->where('id_medcheck', $medcheckId)->first();
    }

    /**
     * Get rad data by patient ID
     *
     * @param int $patientId
     * @return array
     */
    public function getRadByPatient($patientId)
    {
        $builder = $this->db->table($this->table);
        $builder->select('tbl_trans_medcheck_rad.id, tbl_trans_medcheck_rad.tgl_simpan, tbl_trans_medcheck_rad.tgl_masuk, tbl_trans_medcheck_rad.no_rad, tbl_trans_medcheck_rad.no_sample, tbl_trans_medcheck_rad.ket, tbl_trans_medcheck_rad.file_name, tbl_trans_medcheck_rad.status, tbl_trans_medcheck_rad.item, tbl_ion_users.first_name as radiografer');
        $builder->join('tbl_ion_users', 'tbl_ion_users.id = tbl_trans_medcheck_rad.id_radiografer', 'left');
        $builder->where('tbl_trans_medcheck_rad.id_pasien', $patientId);
        $builder->orderBy('tbl_trans_medcheck_rad.tgl_masuk', 'DESC');
        return $builder->get()->getResult();
    }

    /**
     * Get rad status text
     *
     * @param int $status
     * @return string
     */
    public function getStatusText($status)
    {
        $statusList = [
            0 => 'Pending',
            1 => 'Proses',
            2 => 'Diterima',
            3 => 'Ditolak',
            4 => 'Farmasi',
            5 => 'Farmasi Proses'
        ];

        return $statusList[$status] ?? 'Unknown';
    }
} 