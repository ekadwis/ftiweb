<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProfileModel;
use App\Models\DataPenggunaModel;
use App\Models\SuratModel;
use App\Models\PermohonanTtdModel;
use App\Models\KodeSuratModel;
use App\Models\ArsipSuratModel;

class AdminController extends BaseController
{

    protected $ProfileModel;
    protected $DataPenggunaModel;
    protected $SuratModel;
    protected $PermohonanTtdModel;
    protected $KodeSuratModel;
    protected $ArsipSuratModel;

    public function __construct()
    {
        $this->ProfileModel = new ProfileModel();
        $this->DataPenggunaModel = new DataPenggunaModel();
        $this->SuratModel = new SuratModel();
        $this->PermohonanTtdModel = new PermohonanTtdModel();
        $this->KodeSuratModel = new KodeSuratModel();
        $this->ArsipSuratModel = new ArsipSuratModel();
    }

    public function index()
    {
        return view('admin/dashboard_admin');
    }

    public function pengajuanSurat()
    {
        // Ambil data dari model dengan kondisi status 'Pending' atau 'Proses'
        $data['surat'] = $this->SuratModel->whereIn('status', ['Pending', 'Proses'])->findAll();

        /*
        // Menulis query SQL langsung untuk status 'Pending'
        $sql = "SELECT * FROM surat WHERE status = 'Pending'";
        $data['surat'] = $this->db->query($sql)->getResultArray(); 
        */
        return view('admin/data_pengajuan_surat_dekanat', $data);
    }

    public function permohonanttd()
    {
        $data['surat'] = $this->PermohonanTtdModel->findAll();
        return view('admin/permohonan_ttd', $data);
    }

    public function arsip()
    {
        $result =  $this->ArsipSuratModel->findAll();
        $data = [
            'surat' => $result,
        ];
        return view('admin/arsip_surat', $data);
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

    public function detail_pengajuan_surat($id_surat)
    {
        $kode_surat = $this->SuratModel->getKodeSurat($id_surat);

        if ($kode_surat) {
            // Ambil data berdasarkan kode_surat
            $dosenData = $this->SuratModel->getDosenByKodeSurat($kode_surat[0]); // Mengambil data dosen untuk kode_surat pertama
        } else {
            $dosenData = [];
        }
        $data = [
            'title' => 'Detail',
            'result' => $this->SuratModel->find($id_surat),
            'listDosen' => $dosenData,
        ];

        return view('admin/detail_pengajuan_surat_dekanat', $data);
    }

    public function revisi_pengajuan_surat($id_surat)
    {

        $kode_surat = $this->SuratModel->getKodeSurat($id_surat);

        $data = [
            'kode_surat' => $kode_surat,
        ];

        return view('admin/revisi_pengajuan_dekanat', $data);
    }

    public function submit_revisi_pengajuan_surat()
    {
        $kode_surat = $this->request->getVar('kode_surat');
        $revisi = $this->request->getVar('revisi');

        $kode_surat = $this->SuratModel->escape($kode_surat); // Melarikan karakter khusus untuk mencegah SQL Injection
        $revisi = $this->SuratModel->escape($revisi);

        $this->SuratModel->query("UPDATE surat
        SET revisi = $revisi,
            status = 'Revisi'
        WHERE kode_surat = $kode_surat");

        return redirect()->to('/admin/pengajuansurat');
    }

    public function approved_pengajuan_surat($id_surat)
    {
        $kode_surat = $this->SuratModel->getKodeSurat($id_surat);

        $result = $this->SuratModel->where('kode_surat', $kode_surat)->findAll();

        // Menyiapkan data untuk dimasukkan ke dalam PermohonanTtdModel
        foreach ($result as $data) {
            // Sesuaikan dengan struktur tabel permohonan_ttd
            $this->PermohonanTtdModel->insert([
                'id_surat' => $data['id_surat'],
                'id_dekanat' => $data['id_dekanat'],
                'id_dosen' => $data['id_dosen'],
                'tanggal' => date('d-m-Y'),
                'kode_surat' => $data['kode_surat'],
                'perihal' => $data['perihal'],
                'jenis_surat' => $data['jenis_surat'],
                'tujuan' => $data['tujuan'],
                'prodi' => $data['prodi'],
                'nama_dosen' => $data['nama_dosen'],
                'nik_dosen' => $data['nik_dosen'],
                'kegiatan_keperluan' => $data['kegiatan_keperluan'],
                'periode_awal' => $data['periode_awal'],
                'periode_akhir' => $data['periode_akhir'],
                'sifat' => $data['sifat'],
                'tembusan' => $data['tembusan'],
                'catatan' => $data['catatan'],
                'lampiran' => $data['lampiran'],
                'no_urut' => $data['no_urut'],
                'status' => $data['status'],
                'revisi' => $data['revisi']
            ]);
        }

        $this->SuratModel->where(array('kode_surat' => $kode_surat))->delete();


        return redirect()->to('/admin/pengajuansurat');
    }

    public function detail_permohonan_ttd($id_permohonan)
    {
        $kode_surat = $this->PermohonanTtdModel->getKodeSurat($id_permohonan);

        if ($kode_surat) {
            // Ambil data berdasarkan kode_surat
            $dosenData = $this->PermohonanTtdModel->getDosenByKodeSurat($kode_surat[0]); // Mengambil data dosen untuk kode_surat pertama
        } else {
            $dosenData = [];
        }
        $data = [
            'title' => 'Detail',
            'result' => $this->PermohonanTtdModel->find($id_permohonan),
            'listDosen' => $dosenData,
            'kodeSurat' => $this->KodeSuratModel->findAll(),
        ];

        return view('admin/detail_permohonan_ttd', $data);
    }

    public function edit_permohonan_ttd()
    {
        $id_permohonan = $this->request->getVar('id_permohonan');
        $jenis_surat = $this->request->getVar('jenis_surat');
        $tingkat = $this->request->getVar('tingkat');
        $tahun = $this->request->getVar('tahun');

        if ($jenis_surat === "Surat Keputusan" || $jenis_surat === "Surat Tugas") {
            $kode_surat = $this->request->getVar('kode_surat');
            $kode_surat = $kode_surat . "/" . $tingkat . "/" . $tahun;
            $kode_surat_awal = $this->PermohonanTtdModel->getKodeSurat($id_permohonan);

            $get_no_urut = $this->PermohonanTtdModel->getNoUrut($id_permohonan);
            $new_no_urut = $get_no_urut[0];

            $result = $this->PermohonanTtdModel->where('kode_surat', $kode_surat_awal)->findAll();

            $this->PermohonanTtdModel->updateKodeSurat($kode_surat_awal, $kode_surat);
        } else {

            $no_urut = $this->KodeSuratModel->getNoUrutByJenis($jenis_surat);

            $new_no_urut = $no_urut + 1;
            $formatted_no_urut = str_pad($new_no_urut, 3, '0', STR_PAD_LEFT);

            $kode_surat_permohonan = $this->PermohonanTtdModel->getKodeSurat($id_permohonan);
            $kode_surat_awal = $this->KodeSuratModel->getKodeSuratByJenis($jenis_surat);
            $kode_surat = $kode_surat_awal[0] . "/" . $formatted_no_urut;
            $kode_surat = $kode_surat . "/" . $tingkat . "/" . $tahun;
            $result = $this->PermohonanTtdModel->where('kode_surat', $kode_surat_permohonan)->findAll();

            $this->PermohonanTtdModel->updateKodeSurat($kode_surat_permohonan, $kode_surat);
            $this->PermohonanTtdModel->updateJenisSurat($kode_surat, $jenis_surat);
            // Update no_urut di table kode_surat
            $this->KodeSuratModel->update_no_urut($kode_surat_awal[0], $new_no_urut);
        }



        return redirect()->to('/admin/permohonanttd');
    }

    public function approved_permohonan_ttd($id_permohonan)
    {
        $kode_surat = $this->PermohonanTtdModel->getKodeSurat($id_permohonan);
        $result = $this->PermohonanTtdModel->where('kode_surat', $kode_surat)->findAll();

        foreach ($result as $data) {
            // Sesuaikan dengan struktur tabel permohonan_ttd
            $this->ArsipSuratModel->insert([
                'id_permohonan' => $data['id_permohonan'],
                'id_surat' => $data['id_surat'],
                'id_dekanat' => $data['id_dekanat'],
                'id_dosen' => $data['id_dosen'],
                'tanggal' => date('d-m-Y'),
                'kode_surat' => $data['kode_surat'],
                'perihal' => $data['perihal'],
                'jenis_surat' => $data['jenis_surat'],
                'tujuan' => $data['tujuan'],
                'prodi' => $data['prodi'],
                'nama_dosen' => $data['nama_dosen'],
                'nik_dosen' => $data['nik_dosen'],
                'kegiatan_keperluan' => $data['kegiatan_keperluan'],
                'periode_awal' => $data['periode_awal'],
                'periode_akhir' => $data['periode_akhir'],
                'sifat' => $data['sifat'],
                'tembusan' => $data['tembusan'],
                'catatan' => $data['catatan'],
                'lampiran' => $data['lampiran'],
                'no_urut' => $data['no_urut'],
                'status' => 'Download',
                'revisi' => $data['revisi'],
                'author' => user()->nama_user,
            ]);
        }

        $this->PermohonanTtdModel->where(array('kode_surat' => $kode_surat))->delete();

        return redirect()->to('admin/arsipsurat');
    }
}
