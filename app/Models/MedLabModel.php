<?php

namespace App\Models;

use CodeIgniter\Model;

class MedLabModel extends Model
{
    protected $table            = 'tbl_trans_medcheck_lab';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_medcheck',
        'id_pasien',
        'id_user',
        'id_analis',
        'id_dokter',
        'id_dokter_kirim',
        'id_dokter_pem',
        'tgl_simpan',
        'tgl_modif',
        'tgl_masuk',
        'tgl_keluar',
        'no_lab',
        'no_sample',
        'ket',
        'item',
        'file_name',
        'status',
        'status_cvd',
        'status_lis',
        'status_normal',
        'status_duplo'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'tgl_simpan';
    protected $updatedField  = 'tgl_modif';

    protected $validationMessages = [];
    protected $skipValidation     = false;
    protected $cleanValidationRules = true;

    /**
     * Get lab data with related information
     *
     * @param int|null $id
     * @return object|null
     */
    public function getLabData($id = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('
            tbl_trans_medcheck_lab.*,
            m1.nama AS nama_analis,
            m2.nama AS nama_dokter,
            m3.nama AS nama_dokter_kirim,
            m4.nama AS nama_dokter_pem,
            p.nama AS nama_pasien
        ');
        $builder->join('tbl_master_pegawai m1', 'm1.id = tbl_trans_medcheck_lab.id_analis', 'left');
        $builder->join('tbl_master_pegawai m2', 'm2.id = tbl_trans_medcheck_lab.id_dokter', 'left');
        $builder->join('tbl_master_pegawai m3', 'm3.id = tbl_trans_medcheck_lab.id_dokter_kirim', 'left');
        $builder->join('tbl_master_pegawai m4', 'm4.id = tbl_trans_medcheck_lab.id_dokter_pem', 'left');
        $builder->join('tbl_master_pasien p', 'p.id = tbl_trans_medcheck_lab.id_pasien', 'left');

        if ($id !== null) {
            $builder->where('tbl_trans_medcheck_lab.id', $id);
            return $builder->get()->getRow();
        }

        return $builder->get()->getResult();
    }

    /**
     * Get lab data by medcheck ID
     *
     * @param int $medcheckId
     * @return object|null
     */
    public function getLabByMedcheck($medcheckId)
    {
        return $this->where('id_medcheck', $medcheckId)->first();
    }

    /**
     * Get lab data by patient ID
     *
     * @param int $patientId
     * @return array
     */
    public function getLabByPatient($patientId)
    {
        $builder = $this->db->table($this->table);
        $builder->select('tbl_trans_medcheck_lab.id, tbl_trans_medcheck_lab.tgl_simpan, tbl_trans_medcheck_lab.tgl_masuk, tbl_trans_medcheck_lab.no_lab, tbl_trans_medcheck_lab.no_sample, tbl_trans_medcheck_lab.ket, tbl_trans_medcheck_lab.file_name, tbl_trans_medcheck_lab.status, tbl_trans_medcheck_lab.item, tbl_ion_users.first_name as analis');
        $builder->join('tbl_ion_users', 'tbl_ion_users.id = tbl_trans_medcheck_lab.id_analis', 'left');
        $builder->where('tbl_trans_medcheck_lab.id_pasien', $patientId);
        $builder->orderBy('tbl_trans_medcheck_lab.tgl_masuk', 'DESC');
        return $builder->get()->getResult();
    }

    /**
     * Get lab status text
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

    /**
     * Get CVD status text
     *
     * @param string $status
     * @return string
     */
    public function getCvdStatusText($status)
    {
        $statusList = [
            '0' => 'Tidak',
            '1' => 'Rapid',
            '2' => 'PCR'
        ];

        return $statusList[$status] ?? 'Unknown';
    }
} 