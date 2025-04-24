<?php
/**
 * Created by:
 * Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * 2025-01-13
 * 
 * Poli Model
 * 
 * Model for managing clinic/department (poli) data
 * Handles CRUD operations and data validation
 */

namespace App\Models;

use CodeIgniter\Model;

class PoliModel extends Model
{
    protected $table            = 'tbl_m_poli';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'kode',
        'lokasi',
        'keterangan',
        'warna',
        'post_location',
        'tipe',
        'status',
        'status_online',
        'status_ant'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'tgl_simpan';
    protected $updatedField  = 'tgl_modif';

} 