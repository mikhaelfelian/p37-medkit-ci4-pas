<?php
/**
 * Dashboard Controller
 * 
 * Created by Mikhael Felian Waskito
 * Created at 2024-01-09
 */

namespace App\Controllers;
use App\Models\VDokterModel;

class Dashboard extends BaseController
{
    protected $medTransModel;

    public function __construct(){
        $this->jadwal = new VDokterModel();
    }
    public function index(){
        if ($this->ionAuth->loggedIn()) {
            $data = [
                'title'         => 'Dashboard',
                'Pengaturan'    => $this->pengaturan,
                'user'          => $this->ionAuth->user()->row(),
                'jadwal'        => $this->jadwal->getJadwalDokter(),
                'total_users'   => 1
            ];
    
            return view($this->theme->getThemePath() . '/dashboard', $data);
        }else{
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Authentifikasi gagal, silahkan login ulang !!');
        }
    }
} 