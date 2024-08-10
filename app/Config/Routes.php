<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Auth

// $routes->get('/login', 'AuthController::login');
// $routes->get('/register', 'AuthController::register');

// Administrator
$routes->get('/', 'AdminController::index', ['filter' => 'role:administrator']);
$routes->post('/ubahprofile', 'AdminController::ubahprofile');
$routes->group('admin', ['filter' => 'role:administrator'], function($routes) {
    $routes->get('/', 'AdminController::index');
    $routes->get('pengajuansurat', 'AdminController::pengajuanSurat');
    $routes->get('permohonanttd', 'AdminController::permohonanttd');
    $routes->get('arsipsurat', 'AdminController::arsip');
    $routes->get('daftarpengguna_dekanat', 'AdminController::daftarpengguna_dekanat');
    $routes->get('daftarpengguna_dosen', 'AdminController::daftarpengguna_dosen');
    $routes->get('daftarpengguna_mahasiswa', 'AdminController::daftarpengguna_mahasiswa');
    $routes->get('detailpengajuandekanat', 'AdminController::detailpengajuandekanat');
    $routes->get('detailpermohonanttd', 'AdminController::detailpermohonanttd');
    $routes->get('surattugas', 'AdminController::surattugas');
    $routes->get('suratkeputusan', 'AdminController::suratkeputusan');
    $routes->get('profiladministrator', 'AdminController::profiladministrator');
});

// Users 
$routes->group('user', ['filter' => 'role:user'], function($routes) {
    $routes->get('dashboard', 'UserController::dashboard');
    $routes->get('pengajuansurat_keputusan', 'UserController::pengajuansurat_keputusan');
    $routes->get('pengajuansurat_tugas', 'UserController::pengajuansurat_tugas');
    $routes->get('pengajuansurat_formal', 'UserController::pengajuansurat_formal');
    $routes->get('daftarsurat', 'UserController::daftar_surat');
    $routes->get('daftardosen', 'UserController::daftar_dosen');
    $routes->get('detail', 'UserController::detail');
    $routes->get('detail', 'UserController::detail');
    $routes->post('tambahdosen', 'UserController::tambahdosen');
    $routes->post('submit_pengajuansurat_tugas', 'SuratController::submit_pengajuansurat_tugas');
    $routes->post('submit_pengajuansurat_keputusan', 'SuratController::submit_pengajuansurat_keputusan');
    $routes->post('submit_pengajuansurat_formal', 'SuratController::submit_pengajuansurat_formal');
});
