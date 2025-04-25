<?php

use CodeIgniter\Router\RouteCollection;
$routes->setAutoRoute(true);

/**
 * @var RouteCollection $routes
 */
$routes->get('/', to: 'Auth::index');

// Auth routes
$routes->group('auth', function ($routes) {
    $routes->get('/', 'Auth::index');
    $routes->match(['get', 'post'], 'login', 'Auth::login');
    $routes->post('cek_login', 'Auth::cek_login');
    $routes->get('logout', 'Auth::logout');
    $routes->match(['get', 'post'], 'forgot_password', 'Auth::forgot_password');
});

$routes->get('/dashboard', 'Dashboard::index', ['namespace' => 'App\Controllers', 'filter' => 'auth']);

/*
* Pasien Baru Routes no auth
*/
$routes->group('pasien', function ($routes) {
    $routes->get('/', 'Pasien::index');
    $routes->get('pendaftaran_baru.php', 'Pasien::daftar_baru');
    $routes->get('pendaftaran.php', 'Pasien::daftar');
    $routes->post('set_daftar.php', 'Pasien::set_daftar');
    $routes->post('set_daftar_baru.php', 'Pasien::set_daftar_baru');
    $routes->get('pdf_print.php', 'Pasien::pdf_antrian');
    $routes->get('data_dokter', 'Pasien::data_dokter');
    $routes->get('data_kamar.php', 'Home::data_kamar');
    $routes->get('data_kamar_json.php', 'Home::json_data_kamar');
    $routes->get('riwayat_lab.php', 'Pasien::riwayat_lab');
    $routes->get('riwayat_rad.php', 'Pasien::riwayat_rad');
    $routes->get('riwayat_berkas.php', 'Pasien::riwayat_berkas');
});
?>