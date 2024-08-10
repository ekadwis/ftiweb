<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DosenModel;
use App\Models\SuratModel;

class UserController extends BaseController
{

    protected $DosenModel;
    protected $SuratModel;

    public function __construct()
    {
        $this->DosenModel = new DosenModel();
        $this->SuratModel = new SuratModel();
    }

    public function dashboard()
    {
        return view('user/new_dashboard_user');
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
}
