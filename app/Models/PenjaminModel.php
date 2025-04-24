<?php
/**
 * Created by:
 * Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * 2025-01-13
 * 
 * Penjamin Model
 * 
 * Model for managing insurance/guarantor (penjamin) data
 * Handles CRUD operations and data validation
 * 
 * Table contains payment guarantors such as:
 * - UMUM (Cash paying patients)
 * - ASURANSI (Insurance patients like Mandiri InHealth, ManuLife, etc)
 * - BPJS (National health insurance)
 */

namespace App\Models;

use CodeIgniter\Model;

/**
 * PenjaminModel
 * 
 * Handles database operations for penjamin (insurance/guarantor) data
 * 
 * @author    Mikhael Felian Waskito <mikhaelfelian@gmail.com>
 * @date      2025-02-06
 */
class PenjaminModel extends Model
{
    protected $table            = 'tbl_m_penjamin';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'tgl_simpan',
        'kode',
        'penjamin',
        'persen',
        'status'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'tgl_simpan';
    protected $updatedField  = '';

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    /**
     * Generate unique code for penjamin
     * Format: PJMyymmXXX where XXX is sequential number
     * 
     * @return string
     */
    public function generateKode()
    {
        $prefix = 'PJM' . date('ym');
        $lastCode = $this->select('kode')
            ->like('kode', $prefix, 'after')
            ->orderBy('kode', 'DESC')
            ->first();

        if ($lastCode) {
            $lastNumber = (int) substr($lastCode->kode, -3);
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '001';
        }

        return $prefix . $newNumber;
    }
} 