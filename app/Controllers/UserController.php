<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ArsipSuratModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DosenModel;
use App\Models\SuratModel;
use App\Models\MergedSurat;

class UserController extends BaseController
{

    protected $DosenModel;
    protected $SuratModel;
    protected $MergedSurat;
    protected $ArsipModel;

    public function __construct()
    {
        $this->DosenModel = new DosenModel();
        $this->SuratModel = new SuratModel();
        $this->MergedSurat = new MergedSurat();
        $this->ArsipModel = new ArsipSuratModel();
    }

    public function dashboard()
    {
        $data['prodi'] = $this->ArsipModel->distinct()->findColumn('prodi');

        return view('user/new_dashboard_user', $data);
    }

    public function pengajuan_surat()
    {
        return view('user/pengajuan_surat');
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
        $id_dekanat = user()->id;
        $data['surat'] = $this->MergedSurat->where('id_dekanat', $id_dekanat)->findAll();
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
        $data['prodi'] = $this->ArsipModel->distinct()->findColumn('prodi');
        $data['detail'] =  $this->ArsipModel->findBySection($section);;

        if (! $data['detail']) {
            return view('not_found');
        }

        return view('user/detail', $data);
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
        return redirect()->to('/user/daftardosen')->with('msg-dosen', 'Dosen baru berhasil ditambahkan.');
    }

    public function revisi($id_merged)
    {
        $revisi = $this->MergedSurat->getRevisi($id_merged);
        $data['revisi'] = $revisi[0];

        return view('user/revisi', $data);
    }
    public function chartSurat()
    {
        $request = \Config\Services::request();
        $startDate = $request->getVar('startDate');
        $endDate = $request->getVar('endDate');
        $prodi = $request->getVar('prodi');

        $data = $this->ArsipModel->chartSurat($startDate, $endDate, $prodi);

        return $this->response->setJSON($data);
    }

    public function suratData()
    {
        $request = \Config\Services::request();
        $startDate = $request->getVar('startDate');
        $endDate = $request->getVar('endDate');
        $prodi = $request->getVar('prodi');

        $data = $this->ArsipModel->getPerihalDosen($startDate, $endDate, $prodi);

        return $this->response->setJSON($data);
    }

    public function suratDosen()
    {
        $request = \Config\Services::request();
        $type = $request->getVar('type');
        $startDate = $request->getVar('startDate');
        $endDate = $request->getVar('endDate');
        $prodi = $request->getVar('prodi');

        $data = $this->ArsipModel->getSuratDosen($type, $startDate, $endDate, $prodi);

        return $this->response->setJSON($data);
    }
}
