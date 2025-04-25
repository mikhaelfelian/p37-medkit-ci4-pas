<?php

namespace App\Models;

use CodeIgniter\Model;

class MedFileModel extends Model
{
    protected $table            = 'tbl_trans_medcheck_file';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_medcheck',
        'id_medcheck_det',
        'id_berkas',
        'id_medcheck_rsm',
        'id_pasien',
        'id_rad',
        'id_user',
        'tgl_simpan',
        'tgl_masuk',
        'judul',
        'keterangan',
        'file_name_ori',
        'file_name',
        'file_ext',
        'file_type',
        'file_base64',
        'file_base64_foto',
        'status',
        'sp'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'tgl_simpan';
    protected $updatedField  = 'tgl_modif';


    /**
     * Get file data with related information
     *
     * @param int|null $id
     * @return object|null
     */
    public function getFileData($id = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('
            tbl_trans_medcheck_file.*,
            p.nama AS nama_pasien,
            u.first_name AS nama_user
        ');
        $builder->join('tbl_master_pasien p', 'p.id = tbl_trans_medcheck_file.id_pasien', 'left');
        $builder->join('tbl_ion_users u', 'u.id = tbl_trans_medcheck_file.id_user', 'left');

        if ($id !== null) {
            $builder->where('tbl_trans_medcheck_file.id', $id);
            return $builder->get()->getRow();
        }

        return $builder->get()->getResult();
    }

    /**
     * Get files by medcheck ID
     *
     * @param int $medcheckId
     * @return array
     */
    public function getFilesByMedcheck($medcheckId)
    {
        return $this->where('id_medcheck', $medcheckId)->findAll();
    }

    /**
     * Get files by patient ID
     *
     * @param int $patientId
     * @return array
     */
    public function getFilesByPatient($patientId)
    {
        $builder = $this->db->table($this->table);
        $builder->select('tbl_trans_medcheck_file.*, tbl_ion_users.first_name as user_name');
        $builder->join('tbl_ion_users', 'tbl_ion_users.id = tbl_trans_medcheck_file.id_user', 'left');
        $builder->where('tbl_trans_medcheck_file.id_pasien', $patientId);
        $builder->orderBy('tbl_trans_medcheck_file.tgl_masuk', 'DESC');
        return $builder->get()->getResult();
    }

    /**
     * Get files by radiology ID
     *
     * @param int $radId
     * @return array
     */
    public function getFilesByRad($radId)
    {
        return $this->where('id_rad', $radId)->findAll();
    }

    /**
     * Get status text
     *
     * @param string $status
     * @return string
     */
    public function getStatusText($status)
    {
        $statusList = [
            '0' => 'None',
            '1' => 'Berkas Unggah',
            '2' => 'Resume',
            '3' => 'Bukti Bayar'
        ];

        return $statusList[$status] ?? 'Unknown';
    }

    /**
     * Get SP status text
     *
     * @param string $sp
     * @return string
     */
    public function getSpText($sp)
    {
        $spList = [
            '0' => 'None',
            '1' => 'SP 1',
            '2' => 'SP 2'
        ];

        return $spList[$sp] ?? 'Unknown';
    }
} 