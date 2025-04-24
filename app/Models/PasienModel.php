<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Pasien Model
 */
class PasienModel extends Model
{
    protected $table            = 'tbl_m_pasien';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_gelar',
        'id_kategori',
        'id_pekerjaan',
        'id_user',
        'tgl_simpan',
        'tgl_modif',
        'kode',
        'kode_dpn',
        'nik',
        'nama',
        'nama_pgl',
        'no_telp',
        'no_hp',
        'no_rmh',
        'tmp_lahir',
        'tgl_lahir',
        'alamat',
        'alamat_dom',
        'kel',
        'instansi',
        'instansi_alamat',
        'kec',
        'kota',
        'file_name',
        'file_name_id',
        'file_type',
        'file_ext',
        'file_base64',
        'alergi',
        'jns_klm',
        'status',
        'status_pas',
        'sp'
    ];
} 