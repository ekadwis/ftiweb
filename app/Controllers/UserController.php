<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ArsipSuratModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DosenModel;
use App\Models\SuratModel;

class UserController extends BaseController
{

    protected $DosenModel;
    protected $SuratModel;
    protected $ArsipModel;

    public function __construct()
    {
        $this->DosenModel = new DosenModel();
        $this->SuratModel = new SuratModel();
        $this->ArsipModel = new ArsipSuratModel();
    }

    public function dashboard()
    {
        $data['surat_terbanyak'] = $this->ArsipModel->getSuratDosen('most');
        $data['surat_tersedikit'] = $this->ArsipModel->getSuratDosen('less');
        return view('user/new_dashboard_user', $data);
    }

    public function pengajuansurat_keputusan()
    {
        $data['dosen'] = $this->DosenModel->findAll();
        return view('user/pengajuansurat_keputusan', $data);
    }
    
    public function pengajuansurat_tugas()
    {
        $data['dosen'] = $this->DosenModel->findAll();
        return view('user/pengajuansurat_tugas', $data);
    }
    
    public function pengajuansurat_formal()
    {
        $data['dosen'] = $this->DosenModel->findAll();
        return view('user/pengajuansurat_formal', $data);
    }
    

    public function daftar_surat()
    {
        $data['surat'] = $this->SuratModel->findAll();
        return view('user/daftar_surat', $data);
    }
    
    public function daftar_dosen()
    {
        $data['dosen'] = $this->DosenModel->findAll();
        return view('user/daftar_dosen', $data);
    }

    public function detail()
    {
        $request = \Config\Services::request();
        $section = $request->getVar('section');
        $arrKeja = ["pengabdian", "pengajaran", "penelitian", "penunjang"];

        if (!in_array($section, $arrKeja)) {
            return view('not_found');
        }

        return view('user/detail', ['section' => $section]);
    }

    public function tambahdosen()
    {
        $data = [
            'nama_dosen' => $this->request->getVar('nama_dosen'),
            'nik_dosen' => $this->request->getVar('nik_dosen'),
            'prodi_dosen' => $this->request->getVar('prodi_dosen'),
            'no_telp_dosen' => $this->request->getVar('no_telp_dosen'),
            'email_dosen' => $this->request->getVar('email_dosen'),
        ];

        $this->DosenModel->insert($data);
        return redirect()->to('/user/daftardosen');
    }
}
