<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProfileModel;
use App\Models\DataPenggunaModel;
use App\Models\SuratModel;

class AdminController extends BaseController
{

    protected $ProfileModel;
    protected $DataPenggunaModel;
    protected $SuratModel;

    public function __construct()
    {
        $this->ProfileModel = new ProfileModel();
        $this->DataPenggunaModel = new DataPenggunaModel();
        $this->SuratModel = new SuratModel();
    }

    public function index()
    {
       return view('admin/dashboard_admin');
    }

    public function pengajuanSurat()
    {
        $data['surat'] = $this->SuratModel->findAll();
        return view('admin/data_pengajuan_surat_dekanat', $data);
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
        $data['users'] = $this->DataPenggunaModel->findAll();
        return view('admin/daftarpengguna_dekanat', $data);
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
        // ambil data profile dan simpan di $data
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

    public function deleteuser($user_id)
    {
        $this->ProfileModel->delete($user_id);
        return redirect()->to('/admin/daftarpengguna_dekanat');
    }

    public function downloadFile($fileName)
{
    $path = WRITEPATH . 'uploads/lampiran_files/' . $fileName;

    // Cek apakah file ada
    if (file_exists($path)) {
        return $this->response->download($path, null)->setFileName($fileName);
    } else {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("File tidak ditemukan.");
    }
}

}
