<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * JenisKerja Model
 * 
 * @author Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * @date 2025-04-23
 */
class JenisKerjaModel extends Model
{
    protected $table = 'tbl_m_jenis_kerja';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'jenis',
        'ket'
    ];
} 