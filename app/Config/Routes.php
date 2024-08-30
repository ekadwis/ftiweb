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
$routes->get('admin/download/(:segment)', 'AdminController::downloadFile/$1');
$routes->group('admin', ['filter' => 'role:administrator'], function ($routes) {
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
    $routes->get('deleteuser/(:any)', 'AdminController::deleteuser/$1');
    $routes->get('detail_pengajuan_surat/(:any)', 'AdminController::detail_pengajuan_surat/$1');
    $routes->get('approved_pengajuan_surat/(:any)', 'AdminController::approved_pengajuan_surat/$1');
    $routes->get('revisi_pengajuan_surat/(:any)', 'AdminController::revisi_pengajuan_surat/$1');
    $routes->get('detail_permohonan_ttd/(:any)', 'AdminController::detail_permohonan_ttd/$1');
    $routes->post('edit_permohonan_ttd', 'AdminController::edit_permohonan_ttd');
    $routes->post('approved_permohonan_ttd', 'AdminController::approved_permohonan_ttd');
    $routes->post('submit_revisi_pengajuan_surat', 'AdminController::submit_revisi_pengajuan_surat');
    $routes->post('surat_masuk_keputusan', 'AdminController::surat_masuk_keputusan');
    $routes->post('surat_masuk_tugas', 'AdminController::surat_masuk_tugas');
});

// Users 
$routes->group('user', ['filter' => 'role:user'], function ($routes) {
    $routes->get('dashboard', 'UserController::dashboard');
    $routes->get('chart-data', 'UserController::chartSurat');
    $routes->get('surat-data', 'UserController::suratData');
    $routes->get('surat-dosen', 'UserController::suratDosen');
    $routes->get('surat-detail', 'UserController::bebanKerjaDetail');
    $routes->get('publikasi-detail', 'UserController::publikasiKerjaDetail');
    $routes->get('kegiatan-detail', 'UserController::kegiatanData');
    $routes->get('chart-detail', 'UserController::chartDetail');
    $routes->get('dosen-detail', 'UserController::dosenDetail');
    $routes->get('pengajuan_surat', 'UserController::pengajuan_surat');
    $routes->get('pengajuansurat_keputusan', 'UserController::pengajuansurat_keputusan');
    $routes->get('pengajuansurat_tugas', 'UserController::pengajuansurat_tugas');
    $routes->get('pengajuansurat_formal', 'UserController::pengajuansurat_formal');
    $routes->get('daftarsurat', 'UserController::daftar_surat');
    $routes->get('daftardosen', 'UserController::daftar_dosen');
    $routes->get('detail', 'UserController::detail');
    $routes->get('revisi/(:any)', 'UserController::revisi/$1');
    $routes->post('tambahdosen', 'UserController::tambahdosen');
    $routes->post('submit_pengajuansurat_tugas', 'SuratController::submit_pengajuansurat_tugas');
    $routes->post('submit_pengajuansurat_keputusan', 'SuratController::submit_pengajuansurat_keputusan');
    $routes->post('submit_pengajuansurat_formal', 'SuratController::submit_pengajuansurat_formal');
});
