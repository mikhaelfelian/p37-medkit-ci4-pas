<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Created by:
 * Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * 2024-01-13
 */
class GelarModel extends Model
{
    protected $table = 'tbl_m_gelar';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['gelar', 'ket'];
    protected $useTimestamps = true;
} 