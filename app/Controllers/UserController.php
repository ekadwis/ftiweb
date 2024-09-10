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
        $prodi = $request->getVar('prodi');
        $data['dosen_prodi'] =  $this->ArsipModel
            ->distinct()
            ->select('nama_dosen')
            ->where('arsip_surat.prodi', $prodi)
            ->like('perihal', $section)
            ->findColumn('nama_dosen');
        $data['detail'] =  $this->ArsipModel->findBySection($section);
        $data['beban_group'] =  $this->ArsipModel->getAllGroupBeban();
        $data['detail_page'] =  $section;
        $data['prodi'] =  $prodi;

        if (!$data['detail']) {
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
        $beban = $request->getVar('beban');

        $data = $this->ArsipModel->getSuratDosen($type, $startDate, $endDate, $prodi, $beban);

        return $this->response->setJSON($data);
    }

    public function bebanKerjaDetail()
    {
        $request = \Config\Services::request();
        $section = $request->getVar('section');
        $startDate = $request->getVar('startDate');
        $endDate = $request->getVar('endDate');
        $dosen = $request->getVar('dosen');
        $prodi = $request->getVar('prodi');

        $data = $this->ArsipModel->getBebanKerjaDetail($section, $startDate, $endDate, $prodi, $dosen);

        $groupedData = [];

        foreach ($data as $item) {
            if (stripos($item['perihal'], 'Penelitian') !== false) {
                $key = 'Penelitian';
            } elseif (stripos($item['perihal'], 'Pengabdian') !== false) {
                $key = 'Pengabdian';
            } elseif (stripos($item['perihal'], 'Pengajaran') !== false) {
                $key = 'Pengajaran';
            } elseif (stripos($item['perihal'], 'Penunjang') !== false) {
                $key = 'Penunjang';
            } else {
                $key = 'Lainnya';
            }

            if (!isset($groupedData[$key])) {
                $groupedData[$key] = [
                    'perihal' => $key,
                    'kegiatan_keperluan' => $item['kegiatan_keperluan'],
                    'periode_awal' => $item['periode_awal'],
                    'periode_akhir' => $item['periode_akhir'],
                    'jumlah_surat' => (int) $item['jumlah_surat'],
                ];
            } else {
                $groupedData[$key]['jumlah_surat'] += (int) $item['jumlah_surat'];
            }
        }

        return $this->response->setJSON(array_values($groupedData));
    }

    public function publikasiKerjaDetail()
    {
        $request = \Config\Services::request();
        $section = $request->getVar('section');
        $startDate = $request->getVar('startDate');
        $endDate = $request->getVar('endDate');
        $dosen = $request->getVar('dosen');
        $prodi = $request->getVar('prodi');

        $data = $this->ArsipModel->getBebanKerjaDetail($section, $startDate, $endDate, $prodi, $dosen);

        return $this->response->setJSON($data);
    }
    public function chartDetail()
    {
        $request = \Config\Services::request();
        $section = $request->getVar('section');
        $startDate = $request->getVar('startDate');
        $endDate = $request->getVar('endDate');
        $dosen = $request->getVar('dosen');
        $prodi = $request->getVar('prodi');

        $data = $this->ArsipModel->chartDetailSurat($section, $startDate, $endDate, $prodi, $dosen);

        return $this->response->setJSON($data);
    }
    public function dosenDetail()
    {
        $request = \Config\Services::request();
        $prodi = $request->getVar('prodi');
        $section = $request->getVar('section');

        $data = $this->ArsipModel->findDosenByProdi($prodi, $section);

        return $this->response->setJSON($data);
    }

    public function kegiatanData()
    {
        $request = \Config\Services::request();
        $section = $request->getVar('section');
        $startDate = $request->getVar('startDate');
        $endDate = $request->getVar('endDate');
        $dosen = $request->getVar('dosen');
        $prodi = $request->getVar('prodi');

        $data = $this->ArsipModel->getBebanKerjaDetail($section, $startDate, $endDate, $prodi, $dosen);

        return $this->response->setJSON($data);
    }

    public function getYear()
    {

        $data = $this->ArsipModel->getYearFilter();

        return $this->response->setJSON($data);
    }
}
