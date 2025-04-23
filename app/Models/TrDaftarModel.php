<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * TrDaftar Model
 * 
 * @author Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * @date 2025-04-23
 */
class TrDaftarModel extends Model
{
    protected $table = 'tbl_pendaftaran';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
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
        $data['data']['tgl_modif']  = date('Y-m-d H:i:s');
        return $data;
    }
} 