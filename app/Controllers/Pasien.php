<?php

namespace App\Controllers;

use App\Models\MedDaftarModel;
use App\Models\MedAntrianModel;
use App\Models\MedAntrianPoliModel;
use App\Models\MedLabModel;
use App\Models\MedRadModel;
use App\Models\MedFileModel;
use App\Models\PengaturanModel;
use App\Models\GelarModel;
use App\Models\PenjaminModel;
use App\Models\PoliModel;
use App\Models\JenisKerjaModel;
use App\Models\PasienModel;
use App\Models\VDokterModel;
use ReCaptcha\ReCaptcha;
use CodeIgniter\Controller;

/**
 * Pasien Controller
 * 
 * @author Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * @date 2025-04-23
 */
class Pasien extends BaseController
{
    protected $model;
    protected $pengaturan;
    protected $recaptcha;

    public function __construct()
    {
        $this->model        = new MedDaftarModel();
        $this->antrian      = new MedAntrianModel();
        $this->antrian_poli = new MedAntrianPoliModel();
        $this->lab          = new MedLabModel();
        $this->rad          = new MedRadModel();
        $this->file         = new MedFileModel();
        $this->gelar        = new GelarModel();
        $this->penjamin     = new PenjaminModel();
        $this->poli         = new PoliModel();
        $this->jenisKerja   = new JenisKerjaModel();
        $this->dokter       = new VDokterModel();
        $this->pasien       = new PasienModel();
        $pengaturanModel    = new PengaturanModel();
        $this->pengaturan   = $pengaturanModel->first();

        $this->recaptcha    = new ReCaptcha(config('Recaptcha')->secretKey);
    }

    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index()
    {
        $data = [
            'title' => 'Daftar Pasien',
            'data' => $this->model->findAll(),
            'Pengaturan' => $this->pengaturan
        ];
        return view('admin-lte-2/pasien/index', $data);
    }

    /**
     * Show the form for patient registration.
     *
     * @return mixed
     */
    public function daftar()
    {
        if ($this->ionAuth->loggedIn()) {
            $id_user    = $this->ionAuth->user()->row()->id;
            $pasien     = $this->pasien->where('id_user', $id_user)->first();
            
            // Get patient's registration history
            $riwayat = $this->model->getPendaftaran($id_user);

            $data = [
                'title'         => 'Pendaftaran',
                'subtitle'      => 'Pasien',
                'gelar'         => $this->gelar->findAll(),
                'penjamin'      => $this->penjamin->where('status', '1')->findAll(),
                'poli'          => $this->poli->where('status', '1')->findAll(),
                'jenisKerja'    => $this->jenisKerja->findAll(),
                'Pengaturan'    => $this->pengaturan,
                'user'          => $this->ionAuth->user()->row(),
                'pasien'        => $pasien,
                'riwayat'       => $riwayat
            ];
            
            return view('admin-lte-2/pasien/daftar', $data);
        }else{
            return redirect()->to(base_url())
                             ->with('error', message: 'Authentifikasi gagal, silahkan login ulang !!');
        }
    }

    /**
     * Show the form for patient registration.
     *
     * @return mixed
     */
    public function set_daftar()    {
        if ($this->ionAuth->loggedIn()) {
            // Get form data
            $nik        = $this->request->getVar('nik');
            $gelar      = $this->request->getVar('gelar');
            $nama       = $this->request->getVar('nama');
            $jns_klm    = $this->request->getVar('jns_klm');
            $tmp_lahir  = $this->request->getVar('tmp_lahir');
            $tgl_lahir  = $this->request->getVar('tgl_lahir');
            $no_hp      = $this->request->getVar('no_hp');
            $no_rmh     = $this->request->getVar('no_rmh');
            $alamat     = $this->request->getVar('alamat');
            $alamat_dom = $this->request->getVar('alamat_dom');
            $pekerjaan  = $this->request->getVar('pekerjaan');
            $platform   = $this->request->getVar('platform');
            $poli       = $this->request->getVar('poli');
            $dokter     = $this->request->getVar('dokter');
            $alergi     = $this->request->getVar('alergi');
            $tgl_masuk  = $this->request->getVar('tgl_masuk');
            $jam_prks   = $this->request->getVar('jam_periksa');
            $captcha    = $this->request->getVar('recaptcha_response');

            // Validation rules
            $validation = \Config\Services::validation();
            $rules = [
                'nik' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'NIK harus diisi'
                    ]
                ],
                'gelar' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Gelar harus dipilih'
                    ]
                ],
                'nama' => [
                    'rules'  => 'required|min_length[3]',
                    'errors' => [
                        'required' => 'Nama lengkap harus diisi',
                        'min_length' => 'Nama terlalu pendek'
                    ]
                ],
                'jns_klm' => [
                    'rules'  => 'required|in_list[L,P]',
                    'errors' => [
                        'required' => 'Jenis kelamin harus dipilih',
                        'in_list' => 'Jenis kelamin tidak valid'
                    ]
                ],
                'tmp_lahir' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Tempat lahir harus diisi'
                    ]
                ],
                'tgl_lahir' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Tanggal lahir harus diisi'
                    ]
                ],
                'no_hp' => [
                    'rules'  => 'required|numeric|min_length[10]|max_length[15]',
                    'errors' => [
                        'required' => 'Nomor HP harus diisi',
                        'numeric' => 'Nomor HP harus berupa angka',
                        'min_length' => 'Nomor HP terlalu pendek',
                        'max_length' => 'Nomor HP terlalu panjang'
                    ]
                ],
                'alamat' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Alamat harus diisi'
                    ]
                ],
                'platform' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Penjamin harus dipilih'
                    ]
                ],
                'poli' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Poli harus dipilih'
                    ]
                ]
            ];

            $validation->setRules($rules);
            if (!$validation->run($this->request->getPost())) {
                return redirect()->back()
                               ->withInput()
                               ->with('errors', $validation->getErrors());
            }

            $id_user    = $this->ionAuth->user()->row()->id;
            $sql_glr    = $this->gelar->find($gelar);
            $sql_poli   = $this->antrian_poli->where('id_poli', $poli)->first();
            $sql_pas    = $this->pasien->where('id_user', $id_user)->first();

            try {
                // Get next number for this poli and date
                $no_urut    = $this->model->getNextNoUrut($poli, $tgl_masuk);
                
                // Generate antrian number
                $no_antrian = $this->antrian->getNextQueueNumber($tgl_masuk, $sql_poli->kode);
                $uuid       = generate_uuid();

                $data = [
                    'uuid'          => $uuid,
                    'tgl_simpan'    => date('Y-m-d H:i:s'),
                    'tgl_masuk'     => tgl_indo_sys($tgl_masuk).' '.date('H:i:s', strtotime($jam_prks)),
                    'id_ant'        => 0,
                    'id_gelar'      => (!empty($gelar) ? $gelar : '0'),
                    'id_poli'       => (!empty($poli) ? $poli : '0'),
                    'id_dokter'     => (!empty($dokter) ? $dokter : '0'),
                    'id_pekerjaan'  => (!empty($pekerjaan) ? $pekerjaan : '0'),
                    'id_referall'   => 0,
                    'id_pasien'     => $id_user,
                    'no_urut'       => $no_antrian,
                    'no_antrian'    => $no_urut,
                    'nik'           => $nik,
                    'nama'          => stripslashes(strtoupper(strtolower($nama))),
                    'nama_pgl'      => stripslashes(strtoupper($sql_glr->gelar.' '.$nama)),
                    'tmp_lahir'     => (!empty($tmp_lahir) ? strtoupper($tmp_lahir) : ''),
                    'tgl_lahir'     => (!empty($tgl_lahir) ? tgl_indo_sys($tgl_lahir) : '0000-00-00'),
                    'jns_klm'       => (!empty($jns_klm) ? $jns_klm : 0),
                    'kontak'        => $no_hp,
                    'kontak_rmh'    => $no_rmh,
                    'alamat'        => strtoupper(strtolower($alamat)),
                    'alamat_dom'    => strtoupper(strtolower($alamat_dom)),
                    'alergi'        => $alergi,
                    'tipe'          => 0,
                    'tipe_bayar'    => (!empty($platform) ? $platform : '0'),
                    'tipe_rawat'    => '2',
                    'status'        => '1',
                    'status_akt'    => '0',
                    'status_hdr'    => '0',
                    'status_dft'    => '2',
                    'status_hps'    => '0'
                ];

                if (!$this->model->insert($data)) {
                    throw new \RuntimeException('Gagal menyimpan data pendaftaran');
                }

                $id_daftar = $this->model->getLastInsertId();

                $data_antrian = [
                    'id_view'       => $sql_poli->id_view,
                    'id_medcheck'   => 0,
                    'id_dft'        => $id_daftar,
                    'ddate'         => date('Y-m-d', strtotime($tgl_masuk)),
                    'cnoro'         => $sql_poli->kode,
                    'ncount'        => $no_antrian,
                    'ccustsrv'      => 'CUSTOMER',
                    'cnote'         => 'PRINT',
                    'csflagqu'      => $sql_poli->kode,
                    'csflaghd'      => '00',
                    'ddatestart'    => date('Y-m-d H:i:s'),
                    'ddatepross'    => date('Y-m-d H:i:s'),
                    'ddateend'      => date('Y-m-d H:i:s'),
                    'cUser'         => session()->get('username') ?? ''
                ];

                if (!$this->antrian->insert($data_antrian)) {
                    throw new \RuntimeException('Gagal menyimpan data pendaftaran');
                }

                return redirect()->to(base_url('pasien/pendaftaran.php?id='.$uuid))
                            ->with('success', 'Pendaftaran berhasil. No. Antrian: ' . $no_antrian);        
            } catch (\Exception $e) {
                return redirect()->back()
                            ->withInput()
                            ->with('error', $e->getMessage());
            }
        }else{
            return redirect()->to(base_url())
                             ->with('error', 'Authentifikasi gagal, silahkan login ulang !!');
        }
    }

    /**
     * Cancel patient registration
     * 
     * @return \CodeIgniter\HTTP\Response
     */
    public function set_daftar_batal()
    {
        if (!$this->ionAuth->loggedIn()) {
            return redirect()->to(base_url())
                           ->with('error', 'Authentifikasi gagal, silahkan login ulang !!');
        }

        $uuid = $this->request->getGet('uuid');
        if (empty($uuid)) {
            return redirect()->back()
                           ->with('error', 'UUID tidak valid');
        }

        try {
            // Get registration data
            $daftar = $this->model->where('uuid', $uuid)->first();
            if (!$daftar) {
                throw new \RuntimeException('Data pendaftaran tidak ditemukan');
            }

            // Check if registration can be cancelled
            if ($daftar->status_dft != '2') {
                throw new \RuntimeException('Pendaftaran tidak dapat dibatalkan karena status tidak sesuai');
            }

            // Delete antrian if exists
            if (!empty($daftar->id_ant)) {
                if (!$this->antrian->delete($daftar->id_ant)) {
                    throw new \RuntimeException('Gagal menghapus data antrian');
                }
            }

            // Delete registration
            if (!$this->model->where('uuid', $uuid)->delete()) {
                throw new \RuntimeException('Gagal menghapus data pendaftaran');
            }

            return redirect()->back()
                           ->with('success', 'Pendaftaran berhasil dibatalkan');
        } catch (\Exception $e) {
            return redirect()->back()
                           ->with('error', $e->getMessage());
        }
    }

    /**
     * Display patient's lab history
     * 
     * @return mixed
     */
    public function riwayat_lab()
    {
        if ($this->ionAuth->loggedIn()) {
            $id_user = $this->ionAuth->user()->row()->id;
            $pasien = $this->pasien->where('id_user', $id_user)->first();
            
            if (!$pasien) {
                return redirect()->to(base_url())
                                ->with('error', 'Data pasien tidak ditemukan');
            }
            
            // Get lab history for the patient
            $riwayat_lab = $this->lab->getLabByPatient($pasien->id);
            
            $data = [
                'title'      => 'Pemeriksaaan',
                'subtitle'   => 'Laboratorium',
                'Pengaturan' => $this->pengaturan,
                'user'       => $this->ionAuth->user()->row(),
                'pasien'     => $pasien,
                'riwayat'    => $riwayat_lab
            ];
            
            return view('admin-lte-2/pasien/riwayat_lab', $data);
        } else {
            return redirect()->to(base_url())
                            ->with('error', 'Authentifikasi gagal, silahkan login ulang !!');
        }
    }

    /**
     * Display patient's radiology history
     * 
     * @return mixed
     */
    public function riwayat_rad()
    {
        if ($this->ionAuth->loggedIn()) {
            $id_user = $this->ionAuth->user()->row()->id;
            $pasien = $this->pasien->where('id_user', $id_user)->first();
            
            if (!$pasien) {
                return redirect()->to(base_url())
                                ->with('error', 'Data pasien tidak ditemukan');
            }
            
            // Get radiology history for the patient
            $riwayat_rad = $this->rad->getRadByPatient($pasien->id);
            
            $data = [
                'title'      => 'Pemeriksaaan',
                'subtitle'   => 'Radiologi',
                'Pengaturan' => $this->pengaturan,
                'user'       => $this->ionAuth->user()->row(),
                'pasien'     => $pasien,
                'riwayat'    => $riwayat_rad
            ];
            
            return view('admin-lte-2/pasien/riwayat_rad', $data);
        } else {
            return redirect()->to(base_url())
                            ->with('error', 'Authentifikasi gagal, silahkan login ulang !!');
        }
    }

    /**
     * Display patient's document history
     * 
     * @return mixed
     */
    public function riwayat_berkas()
    {
        if ($this->ionAuth->loggedIn()) {
            $id_user = $this->ionAuth->user()->row()->id;
            $pasien = $this->pasien->where('id_user', $id_user)->first();
            
            if (!$pasien) {
                return redirect()->to(base_url())
                                ->with('error', 'Data pasien tidak ditemukan');
            }
            
            // Get document history for the patient
            $riwayat_berkas = $this->file->getFilesByPatient($pasien->id);
            
            $data = [
                'title'      => 'Riwayat',
                'subtitle'   => 'Berkas',
                'Pengaturan' => $this->pengaturan,
                'user'       => $this->ionAuth->user()->row(),
                'pasien'     => $pasien,
                'riwayat'    => $riwayat_berkas
            ];
            
            return view('admin-lte-2/pasien/riwayat_berkas', $data);
        } else {
            return redirect()->to(base_url())
                            ->with('error', 'Authentifikasi gagal, silahkan login ulang !!');
        }
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return mixed
     */
    public function daftar_baru()
    {
        $data = [
            'title'         => 'Pendaftaran',
            'gelar'         => $this->gelar->findAll(),
            'penjamin'      => $this->penjamin->where('status', '1')->findAll(),
            'poli'          => $this->poli->where('status', '1')->findAll(),
            'jenisKerja'    => $this->jenisKerja->findAll(),
            'Pengaturan'    => $this->pengaturan
        ];
        return view('admin-lte-2/pasien/daftar_baru', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return mixed
     */
    public function set_daftar_baru()
    {
        if ($this->ionAuth->loggedIn()) {
            // Get form data
            $nik        = $this->request->getVar('nik');
            $gelar      = $this->request->getVar('gelar');
            $nama       = $this->request->getVar('nama');
            $jns_klm    = $this->request->getVar('jns_klm');
            $tmp_lahir  = $this->request->getVar('tmp_lahir');
            $tgl_lahir  = $this->request->getVar('tgl_lahir');
            $no_hp      = $this->request->getVar('no_hp');
            $no_rmh     = $this->request->getVar('no_rmh');
            $alamat     = $this->request->getVar('alamat');
            $alamat_dom = $this->request->getVar('alamat_dom');
            $pekerjaan  = $this->request->getVar('pekerjaan');
            $platform   = $this->request->getVar('platform');
            $poli       = $this->request->getVar('poli');
            $dokter     = $this->request->getVar('dokter');
            $alergi     = $this->request->getVar('alergi');
            $tgl_masuk  = $this->request->getVar('tgl_masuk');
            $captcha    = $this->request->getVar('recaptcha_response');

            # Verify reCAPTCHA
            $recaptcha = $this->recaptcha->setExpectedHostname($_SERVER['SERVER_NAME'])
                                        ->setScoreThreshold(config('Recaptcha')->score)
                                        ->verify($captcha, $_SERVER['REMOTE_ADDR']);

            if (!$recaptcha->isSuccess()) {
                session()->setFlashdata('toastr', [
                    'type' => 'error',
                    'message' => 'reCAPTCHA verification failed'
                ]);
                return redirect()->back()
                               ->withInput()
                               ->with('error', 'reCAPTCHA verification failed');
            }

            // Validation rules
            $validation = \Config\Services::validation();
            $rules = [
                'nik' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'NIK harus diisi'
                    ]
                ],
                'gelar' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Gelar harus dipilih'
                    ]
                ],
                'nama' => [
                    'rules'  => 'required|min_length[3]',
                    'errors' => [
                        'required' => 'Nama lengkap harus diisi',
                        'min_length' => 'Nama terlalu pendek'
                    ]
                ],
                'jns_klm' => [
                    'rules'  => 'required|in_list[L,P]',
                    'errors' => [
                        'required' => 'Jenis kelamin harus dipilih',
                        'in_list' => 'Jenis kelamin tidak valid'
                    ]
                ],
                'tmp_lahir' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Tempat lahir harus diisi'
                    ]
                ],
                'tgl_lahir' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Tanggal lahir harus diisi'
                    ]
                ],
                'no_hp' => [
                    'rules'  => 'required|numeric|min_length[10]|max_length[15]',
                    'errors' => [
                        'required' => 'Nomor HP harus diisi',
                        'numeric' => 'Nomor HP harus berupa angka',
                        'min_length' => 'Nomor HP terlalu pendek',
                        'max_length' => 'Nomor HP terlalu panjang'
                    ]
                ],
                'alamat' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Alamat harus diisi'
                    ]
                ],
                'platform' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Penjamin harus dipilih'
                    ]
                ],
                'poli' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Poli harus dipilih'
                    ]
                ],            
                'tgl_masuk' => [
                    'rules'  => 'required|valid_date[d-m-Y]',
                    'errors' => [
                        'required' => 'Tanggal periksa harus diisi',
                        'valid_date' => 'Format tanggal tidak valid'
                    ]
                ],
                'recaptcha_response' => 'required'
            ];

            $validation->setRules($rules);
            if (!$validation->run($this->request->getPost())) {
                return redirect()->back()
                               ->withInput()
                               ->with('errors', $validation->getErrors());
            }

            $sql_glr    = $this->gelar->find($gelar);
            $sql_poli   = $this->antrian_poli->where('id_poli', $poli)->first();

            try {
                $cek_nik = $this->model->cekNIK($nik);

                if (!$cek_nik) {
                    throw new \RuntimeException('NIK sudah terdaftar, silahkan login dan daftar kembali.');
                }

                // Get next number for this poli and date
                $no_urut    = $this->model->getNextNoUrut($poli, $tgl_masuk);
                
                // Generate antrian number
                $no_antrian = $this->antrian->getNextQueueNumber($tgl_masuk, $sql_poli->kode);
                $uuid       = generate_uuid();

                $data = [
                    'uuid'          => $uuid,
                    'tgl_simpan'    => date('Y-m-d H:i:s'),
                    'tgl_masuk'     => tgl_indo_sys($tgl_masuk).' '.date('H:i:s'),
                    'id_ant'        => 0,
                    'id_gelar'      => (!empty($gelar) ? $gelar : '0'),
                    'id_poli'       => (!empty($poli) ? $poli : '0'),
                    'id_dokter'     => (!empty($dokter) ? $dokter : '0'),
                    'id_pekerjaan'  => (!empty($pekerjaan) ? $pekerjaan : '0'),
                    'id_referall'   => 0,
                    'no_urut'       => $no_antrian,
                    'no_antrian'    => $no_urut,
                    'nik'           => $nik,
                    'nama'          => stripslashes(strtoupper(strtolower($nama))),
                    'nama_pgl'      => stripslashes(strtoupper($sql_glr->gelar.' '.$nama)),
                    'tmp_lahir'     => (!empty($tmp_lahir) ? strtoupper($tmp_lahir) : ''),
                    'tgl_lahir'     => (!empty($tgl_lahir) ? tgl_indo_sys($tgl_lahir) : '0000-00-00'),
                    'jns_klm'       => (!empty($jns_klm) ? $jns_klm : 0),
                    'kontak'        => $no_hp,
                    'kontak_rmh'    => $no_rmh,
                    'alamat'        => strtoupper(strtolower($alamat)),
                    'alamat_dom'    => strtoupper(strtolower($alamat_dom)),
                    'alergi'        => $alergi,
                    'tipe'          => 0,
                    'tipe_bayar'    => (!empty($platform) ? $platform : '0'),
                    'tipe_rawat'    => '2',
                    'status'        => '2',
                    'status_akt'    => '0',
                    'status_hdr'    => '0',
                    'status_dft'    => '2',
                    'status_hps'    => '0'
                ];

                if (!$this->model->insert($data)) {
                    throw new \RuntimeException('Gagal menyimpan data pendaftaran');
                }

                $id_daftar = $this->model->getLastInsertId();

                $data_antrian = [
                    'id_view'       => $sql_poli->id_view,
                    'id_medcheck'   => 0,
                    'id_dft'        => $id_daftar,
                    'ddate'         => date('Y-m-d', strtotime($tgl_masuk)),
                    'cnoro'         => $sql_poli->kode,
                    'ncount'        => $no_antrian,
                    'ccustsrv'      => 'CUSTOMER',
                    'cnote'         => 'PRINT',
                    'csflagqu'      => $sql_poli->kode,
                    'csflaghd'      => '00',
                    'ddatestart'    => date('Y-m-d H:i:s'),
                    'ddatepross'    => date('Y-m-d H:i:s'),
                    'ddateend'      => date('Y-m-d H:i:s'),
                    'cUser'         => session()->get('username') ?? ''
                ];

                if (!$this->antrian->insert($data_antrian)) {
                    throw new \RuntimeException('Gagal menyimpan data pendaftaran');
                }

                return redirect()->to(base_url('pasien/pendaftaran_baru.php?id='.$uuid))
                               ->with('success', 'Pendaftaran berhasil. No. Antrian: ' . $no_antrian);        
            } catch (\Exception $e) {
                return redirect()->back()
                               ->withInput()
                               ->with('error', $e->getMessage());
            }
        }else{
            return redirect()->to(base_url())
                             ->with('error', 'Authentifikasi gagal, silahkan login ulang !!');
        }
    }

    /**
     * Get dokter data by poli_id
     * 
     * @return \CodeIgniter\HTTP\Response
     */
    public function data_dokter()
    {
        $poliId = $this->request->getGet('id_poli');
        
        if (!$poliId) {
            echo json_encode([
                'status' => false,
                'message' => 'Poli ID is required',
                'data' => []
            ]);
            return;
        }
        
        $dokter = $this->dokter->getDokterByPoli($poliId);
        
        foreach ($dokter as $d) {
            echo '<option value="' . $d->id . '">' . (!empty($d->nama_dpn) ? $d->nama_dpn.' ' : '').$d->nama.(!empty($d->nama_blk) ? ' '.$d->nama_blk : '') . '</option>';
        }
    }

    /**
     * Generate PDF antrian for POS 58 printer
     * 
     * @return void
     */
    public function pdf_antrian()
    {        
        $uuid = $this->request->getGet('id');
        
        // Get antrian data by UUID
        $antrian = $this->model->where('uuid', $uuid)->first();
        if (!$antrian) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Get poli data
        $poli = $this->antrian_poli->where('id_poli', $antrian->id_poli)->first();
        if (!$poli) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Get dokter data if available
        $dokter = null;
        if (!empty($antrian->id_dokter)) {
            $dokter = $this->dokter->find($antrian->id_dokter);
        }

        // Create new PDF document
        $pdf = new \FPDF('P', 'cm', array(5.8, 10));
        $pdf->AddPage();
        $pdf->SetMargins(0.5, 0.2, 0.5);

        // Blok Judul
        // Center the page content
        $pdf->SetX((5.8 - 4.8) / 2);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->MultiCell(4.8, 0.5, $this->pengaturan->judul, 0, 'C');
        $pdf->Ln(0);
        $pdf->SetX((5.8 - 4.8) / 2);
        $pdf->SetFont('Arial', '', 5);
        $pdf->MultiCell(4.8, 0.5, $this->pengaturan->alamat, 'B', 'C');
        $pdf->Ln();

        // Optional Watermark
        // if (file_exists($watermark_path)) {
        //     $pdf->Image($watermark_path, 1.25, 1, 4, 6);
        // }
        $fill = false;
        $pdf->SetFont('Arial', '', 5);
        
        // Center all content horizontally
        $pdf->SetX((5.8 - 4.8) / 2);
        $pdf->Cell(4.8, 0.25, 'ANTRIAN ONLINE', '', 1, 'C', $fill);
        $pdf->SetX((5.8 - 4.8) / 2);
        $pdf->Cell(4.8, 0.25, $poli->poli, '', 1, 'C', $fill);
        $pdf->Ln(1);

        // Nomor Antrian
        $pdf->SetFont('Arial', 'B', 25);
        $pdf->SetX((5.8 - 4.8) / 2);
        $pdf->Cell(4.8, 0.25, sprintf('%03d', $antrian->no_urut), '', 1, 'C', $fill);
        $pdf->Ln(1);

        // Info Pasien
        $pdf->SetFont('Arial', '', 5);
        $pdf->SetX((5.8 - 4.8) / 2);
        $pdf->Cell(4.8, 0.25, $antrian->nama, '', 1, 'C', $fill);
        
        // Info Dokter
        if ($dokter) {
            $nama_dokter = (!empty($dokter->nama_dpn) ? $dokter->nama_dpn.' ' : '')
                        . $dokter->nama
                        . (!empty($dokter->nama_blk) ? ', '.$dokter->nama_blk : '');
            $pdf->SetX((5.8 - 4.8) / 2);
            $pdf->Cell(4.8, 0.25, $nama_dokter, '', 1, 'C', $fill);
        }
        
        // Tanggal
        $pdf->SetX((5.8 - 4.8) / 2);
        $pdf->Cell(4.8, 0.25, tgl_indo5(date('Y-m-d', strtotime($antrian->tgl_masuk))), '', 1, 'C', $fill);
        
        // Footer
        $pdf->SetX((5.8 - 4.8) / 2);
        $pdf->Cell(4.8, 0.25, 'TERIMAKASIH ATAS KUNJUNGAN ANDA', '', 1, 'C', $fill);
        $pdf->Ln();

        // Set colors for additional styling
        $pdf->SetFillColor(235, 232, 228);
        $pdf->SetTextColor(0);
        $pdf->SetFont('Arial', '', 10);

        // Get output type from URL or default to 'I'
        $type = $this->request->getGet('type') ?? 'I';

        // Clear any output that might have been sent
        ob_end_clean();

        // Output PDF
        $pdf->Output('nomor_'.$antrian->no_urut.'.pdf', $type);
        exit;
    }
} 