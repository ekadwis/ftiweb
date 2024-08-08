<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SuratModel;

class SuratController extends BaseController
{
    protected $SuratModel;


    function __construct()
    {
        $this->SuratModel = new SuratModel();
    }
    public function submit_pengajuansurat_tugas()
    {
        $kode_surat = '1';
        $data = [
            'kode_surat' => $kode_surat,
            // 'perihal' => $this->request->getVar('perihal'),
            'jenis_surat' => $this->request->getVar('jenis_surat'),
            // 'tujuan' => $this->request->getVar('tujuan'), 
            // 'prodi' => $this->request->getVar('prodi'),
            // 'nama' => $this->request->getVar('nama'),
            // 'nik' => $this->request->getVar('nik'),
            // 'kegiatan_keperluan' => $this->request->getVar('keperluan_penugasan'),
            // 'periode_awal' => $this->request->getVar('periode_awal'),
            // 'periode_akhir' => $this->request->getVar('periode_akhir'),
            // 'sifat' => $this->request->getVar('sifat'),
            // 'tembusan' => $this->request->getVar('tembusan'),
            // 'catatan' => $this->request->getVar('catatan'),
            // 'lampiran' => $this->request->getVar('lampiran'),
            'no_urut' => $this->request->getVar('no_urut')
        ];

        $this->SuratModel->save($data);

        return redirect()->to('/admin/profiladministrator');
    }
}
