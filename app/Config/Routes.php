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
* Pasien Baru Routes
*/
$routes->group('pasien', function ($routes) {
    $routes->get('/', 'Pasien::index');
    $routes->get('pendaftaran_baru.php', 'Pasien::daftar_baru');
    $routes->post('set_daftar_baru.php', 'Pasien::set_daftar_baru');
    $routes->get('data_dokter', 'Pasien::data_dokter');
});
?>