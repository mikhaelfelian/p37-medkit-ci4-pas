<?php
/**
 * Created by:
 * Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * 2025-04-22
 * 
 * Home Controller
 */

namespace App\Controllers;

use App\Models\VKamarModel;
use App\Models\VDokterModel;
use App\Models\PengaturanModel;

class Home extends BaseController
{
    protected $kamar;
    protected $pengaturan;

    public function __construct()
    {
        $this->kamar        = new VKamarModel();
        $this->pengaturan   = new PengaturanModel();
        $this->jadwal       = new VDokterModel();
    }
    public function data_dokter(){
            $data = [
                'title'         => 'Informasi Jadwal Dokter',
                'subtitle'      => $this->pengaturan->judul,
                'Pengaturan'    => $this->pengaturan,
                'user'          => $this->ionAuth->user()->row(),
                'jadwal'        => $this->jadwal->getJadwalDokter(),
                'total_users'   => 1
            ];
    
            return view($this->theme->getThemePath() . '/frontend/data_dokter', $data);
    }

    /**
     * Display kamar data view
     */
    public function data_kamar()
    {
        $data = [
            'title'         => 'INFORMASI KETERSEDIAAN KAMAR',
            'Pengaturan'    => $this->pengaturan,
            'kamar'         => $this->kamar
        ];
        
        return view('admin-lte-2/frontend/data_kamar', $data);
    }

    /**
     * Get kamar data as JSON
     * 
     * @return \CodeIgniter\HTTP\Response
     */
    public function json_data_kamar()
    {
        $data = $this->kamar->getKamarData();
        $kamar = [];
        $no = 1;

        foreach ($data as $hsl) {
            $kamar[] = [
                'kapasitas' => $hsl->jml_max,
                'kelas'     => $hsl->kamar,
                'sisa'      => $hsl->sisa,
                'terpakai'  => $hsl->jml,
                'no'        => $no++,
            ];
        }

        return $this->response->setJSON($kamar);
    }
} 