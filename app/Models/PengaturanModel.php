<?php

namespace App\Models;
use CodeIgniter\Model;

class PengaturanModel extends Model
{
    protected $table = 'tbl_pengaturan';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'id_pengaturan', 'id_app', 'website', 'judul', 'judul_app', 'url_app', 'logo', 
        'logo_header', 'logo_header_kop', 'deskripsi', 'deskripsi_pendek', 'notifikasi', 
        'alamat', 'kota', 'email', 'pesan', 'tlp', 'fax', 'url_antrian', 'ss_org_id', 
        'ss_client_id', 'ss_client_secret', 'kode_surat_sht', 'kode_surat_skt', 
        'kode_surat_rnp', 'kode_surat_kntrl', 'kode_surat_lahir', 'kode_surat_mati', 
        'kode_surat_covid', 'kode_surat_rujukan', 'kode_surat_tht', 'kode_surat', 
        'kode_resep', 'kode_rad', 'kode_periksa', 'kode_pasien', 'ppn', 'ppn_tot', 
        'jml_ppn', 'jml_item', 'jml_limit_stok', 'jml_limit_tempo', 'jml_poin', 
        'jml_poin_nom', 'tahun_poin', 'status_app'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = '';
    protected $updatedField = 'updated_at';
    protected $deletedField = '';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    /**
     * Get settings as single row
     */
    public function getSettings() {
        return $this->first();
    }

    /**
     * Update settings
     */
    public function updateSettings($data) {
        $settings = $this->first();
        if ($settings) {
            return $this->update($settings['id'], $data);
        }
        return false;
    }
}