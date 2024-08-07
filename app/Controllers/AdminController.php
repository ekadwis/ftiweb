<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProfileModel;

class AdminController extends BaseController
{

    protected $ProfileModel;

    public function __construct()
    {
        $this->ProfileModel = new ProfileModel();
    }

    public function index()
    {
       return view('admin/dashboard_admin');
    }

    public function pengajuanSurat()
    {
        return view('admin/data_pengajuan_surat_dekanat');
    }

    public function permohonanttd()
    {
        return view('admin/permohonan_ttd');
    }

    public function arsip()
    {
        return view('admin/arsip_surat');
    }

    public function daftarpengguna_dekanat()
    {
        return view('admin/daftarpengguna_dekanat');
    }
    public function daftarpengguna_dosen()
    {
        return view('admin/daftarpengguna_dosen');
    }
    public function daftarpengguna_mahasiswa()
    {
        return view('admin/daftarpengguna_mahasiswa');
    }

    public function detailpengajuandekanat()
    {
        return view('admin/detail_pengajuan_surat_dekanat');
    }

    public function detailpermohonanttd()
    {
        return view('admin/detail_permohonan_ttd');
    }

    public function surattugas()
    {
        return view('admin/surat_tugas');
    }

    public function suratkeputusan()
    {
        return view('admin/surat_keputusan');
    }
    
    public function profiladministrator()
    {
        return view('admin/profil_administrator');
    }

    public function ubahprofile()
    {
        $data = [
            'id' => $this->request->getVar('id'),
            'nama_user' => $this->request->getVar('nama_user'),
            'email' => $this->request->getVar('email'),
            'telp_user' => $this->request->getVar('telp_user'),
            'jeniskelamin_user' => $this->request->getVar('jeniskelamin_user'),
        ];

        $this->ProfileModel->save($data);

        return redirect()->to('/admin/profiladministrator');

    }
}
