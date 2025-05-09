<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * TrDaftar Model
 * 
 * @author Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * @date 2025-04-23
 */
class MedDaftarModel extends Model
{
    protected $table            = 'tbl_pendaftaran';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $allowedFields = [
        'uuid',
        'id_gelar',
        'id_pasien',
        'id_poli',
        'id_platform',
        'id_dokter',
        'id_pekerjaan',
        'id_ant',
        'id_instansi',
        'id_referall',
        'tgl_simpan',
        'tgl_modif',
        'tgl_masuk',
        'no_urut',
        'no_antrian',
        'nik',
        'nama',
        'nama_pgl',
        'tmp_lahir',
        'tgl_lahir',
        'jns_klm',
        'kontak',
        'kontak_rmh',
        'alamat',
        'alamat_dom',
        'instansi',
        'instansi_alamat',
        'alergi',
        'file_base64',
        'file_base64_id',
        'tipe_bayar',
        'tipe_rawat',
        'tipe',
        'status',
        'status_akt',
        'status_hdr',
        'status_gc',
        'status_dft',
        'status_hps'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'tgl_simpan';
    protected $updatedField  = 'tgl_modif';
    protected $skipValidation       = false;
    protected $cleanValidationRules = false;

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
     * Check if a NIK already exists in the database
     * 
     * @param string $nik The NIK to check
     * @return bool|object Returns false if NIK doesn't exist, or the patient record if it does
     */
    public function cekNIK($nik)
    {
        if (empty($nik)) {
            return false;
        }
        
        $result = $this->where('nik', $nik)
                      ->where('status_hps', '0')
                      ->countAllResults();
                      
        return $result > 0 ? false : true;
    }

    /**
     * Get the next number for a specific poli and date
     * Uses transaction and row locking to prevent race conditions
     * 
     * @param int $id_poli The poli ID
     * @param string $tgl_masuk The date in d-m-Y format
     * @return int The next available number
     * @throws \RuntimeException If transaction fails
     */
    public function getNextNoUrut($id_poli, $tgl_masuk)
    {
        // Convert date to Y-m-d format
        $date = date('Y-m-d', strtotime($tgl_masuk));
        
        // Start transaction
        $this->db->transStart();
        
        try {
            // Get the last number for this poli and date
            $lastNumber = $this->select('no_urut')
                ->where('id_poli', $id_poli)
                ->where('DATE(tgl_masuk)', $date)
                ->orderBy('no_urut', 'DESC')
                ->first();

            // If no records exist, start with 1
            if (!$lastNumber) {
                $nextNumber = 1;
            } else {
                // Otherwise increment the last number
                $nextNumber = $lastNumber->no_urut + 1;
            }

            // Verify the number is within valid range
            if ($nextNumber > 9999) {
                throw new \RuntimeException('Nomor antrian telah mencapai batas maksimum (9999)');
            }

            // Commit the transaction
            $this->db->transComplete();

            return $nextNumber;

        } catch (\Exception $e) {
            // Rollback on error
            $this->db->transRollback();
            throw new \RuntimeException('Gagal mendapatkan nomor antrian: ' . $e->getMessage());
        }
    }

    /**
     * Generate antrian number based on date and number
     * Format: YYMMDD-XXXX where XXXX is the number padded with zeros
     * 
     * @param int $no_urut The number
     * @param string $tgl_masuk The date in d-m-Y format
     * @return string The formatted antrian number
     */
    public function generateAntrian($no_urut, $tgl_masuk)
    {
        // Convert date to YYMMDD format
        $date = date('ymd', strtotime($tgl_masuk));
        
        // Pad number with zeros to 4 digits
        $number = str_pad($no_urut, 4, '0', STR_PAD_LEFT);
        
        // Combine date and number
        return $date . '-' . $number;
    }

    /**
     * Get the last insert ID from the database
     * 
     * @return int The last insert ID
     */
    public function getLastInsertId()
    {
        return $this->db->insertID();
    }

    /**
     * Get pendaftaran data with joined poli and dokter information
     * 
     * @param array $where Optional where conditions
     * @return array Result of the query
     */
    public function getPendaftaran($where = null)
    {
        $builder = $this->db->table('tbl_pendaftaran');
        
        // Join with poli table
        $builder->join('tbl_m_poli', 'tbl_m_poli.id = tbl_pendaftaran.id_poli', 'left');
        
        // Join with karyawan table for dokter information
        $builder->join('tbl_m_karyawan', 'tbl_m_karyawan.id = tbl_pendaftaran.id_dokter', 'left');
        
        // Select only specific fields: id, dokter, and poli
        $builder->select('tbl_pendaftaran.id, tbl_pendaftaran.uuid, tbl_pendaftaran.tgl_simpan, tbl_pendaftaran.tgl_masuk, tbl_pendaftaran.status_akt as status, tbl_m_poli.lokasi as poli, tbl_m_karyawan.nama_dpn, tbl_m_karyawan.nama, tbl_m_karyawan.nama_blk');
        // Add where conditions if provided
        if ($where !== null) {
            $builder->where('id_pasien', (string)$where);
        }
        
        return $builder->get()->getResult();
    }
} 