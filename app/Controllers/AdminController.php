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
use App\Models\DosenModel;

class AdminController extends BaseController
{

    protected $ProfileModel;
    protected $DataPenggunaModel;
    protected $SuratModel;
    protected $PermohonanTtdModel;
    protected $KodeSuratModel;
    protected $ArsipSuratModel;
    protected $DosenModel;

    public function __construct()
    {
        $this->ProfileModel = new ProfileModel();
        $this->DataPenggunaModel = new DataPenggunaModel();
        $this->SuratModel = new SuratModel();
        $this->PermohonanTtdModel = new PermohonanTtdModel();
        $this->KodeSuratModel = new KodeSuratModel();
        $this->ArsipSuratModel = new ArsipSuratModel();
        $this->DosenModel = new DosenModel();
    }

    public function index()
    {
        $total_surat = $this->SuratModel->query('SELECT COUNT(*) AS total_surat FROM surat;')->getRow();
        $total_permohonan_ttd = $this->PermohonanTtdModel->query('SELECT COUNT(*) AS total_permohonan_ttd FROM permohonan_ttd;')->getRow();
        $total_arsip = $this->ArsipSuratModel->query('SELECT COUNT(*) AS total_arsip FROM arsip_surat;')->getRow();
        
        $data = [
            'total_surat' => $total_surat->total_surat,
            'total_permohonan_ttd' => $total_permohonan_ttd->total_permohonan_ttd,
            'total_arsip' => $total_arsip->total_arsip,
        ];

        return view('admin/dashboard_admin', $data);
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
        $data['dosen'] = $this->DosenModel->findAll();
        return view('admin/surat_tugas', $data);
    }

    public function suratkeputusan()
    {

        $data['dosen'] = $this->DosenModel->findAll();
        return view('admin/surat_keputusan', $data);
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
                'status' => "Proses",
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


    public function surat_masuk_keputusan()
    {
        // Handle file upload
        $file = $this->request->getFile('lampiran');
        $lampiran_path = null;

        if ($file->isValid() && !$file->hasMoved()) {
            // Generate random 32 characters filename
            $newFileName = bin2hex(random_bytes(16)) . '.' . $file->getExtension();

            // Define the path to save the file
            $path = WRITEPATH . 'uploads/lampiran_files/';

            // Make sure directory exists
            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }

            // Move the file to the new location
            $file->move($path, $newFileName);

            // Get the file name only (without path)
            $lampiran_path = $newFileName;
        }

        for ($i = 1; $i <= 10; $i++) {
            $id_dosen = $this->request->getVar('dosen' . $i);
            // Mendapatkan data dosen dari database
            $nik_dosen = $this->DosenModel->getNikDosen($id_dosen);
            $nama_dosen = $this->DosenModel->getNamaDosen($id_dosen);
            $prodi_dosen = $this->DosenModel->getProdiDosen($id_dosen);

            if ($nik_dosen && $nama_dosen && $prodi_dosen) {
                $data = [
                    'id_permohonan' => 0,
                    'id_surat' => 0,
                    'id_dekanat' => user()->id,
                    'id_dosen' => $id_dosen,
                    'tanggal' => date('d-m-Y'),
                    'kode_surat' => $this->request->getVar('kode_surat'),
                    'perihal' => $this->request->getVar('perihal'),
                    'jenis_surat' => 'Surat Keputusan',
                    'tujuan' => "",
                    'prodi' => $prodi_dosen[0],
                    'nama_dosen' => $nama_dosen[0],
                    'nik_dosen' => $nik_dosen[0],
                    'kegiatan_keperluan' => $this->request->getVar('kegiatan_keperluan'),
                    'periode_awal' => $this->request->getVar('periode_awal'),
                    'periode_akhir' => $this->request->getVar('periode_akhir'),
                    'sifat' => "Urgent",
                    'tembusan' => "",
                    'catatan' => "",
                    'lampiran' => $lampiran_path,
                    'no_urut' => 0,
                    'status' => "Download",
                    'author' => user()->nama_user,
                    'revisi' => "",
                ];

                // Insert pengajuan ke table arsip
                $this->ArsipSuratModel->insert($data);
            } else {
                continue;
            }
        }

        return redirect()->to('admin/arsipsurat');
    }

    public function surat_masuk_tugas()
    {
        // Handle file upload
        $file = $this->request->getFile('lampiran');
        $lampiran_path = null;

        if ($file->isValid() && !$file->hasMoved()) {
            // Generate random 32 characters filename
            $newFileName = bin2hex(random_bytes(16)) . '.' . $file->getExtension();

            // Define the path to save the file
            $path = WRITEPATH . 'uploads/lampiran_files/';

            // Make sure directory exists
            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }

            // Move the file to the new location
            $file->move($path, $newFileName);

            // Get the file name only (without path)
            $lampiran_path = $newFileName;
        }

        for ($i = 1; $i <= 10; $i++) {
            $id_dosen = $this->request->getVar('dosen' . $i);
            // Mendapatkan data dosen dari database
            $nik_dosen = $this->DosenModel->getNikDosen($id_dosen);
            $nama_dosen = $this->DosenModel->getNamaDosen($id_dosen);
            $prodi_dosen = $this->DosenModel->getProdiDosen($id_dosen);

            if ($nik_dosen && $nama_dosen && $prodi_dosen) {
                $data = [
                    'id_permohonan' => 0,
                    'id_surat' => 0,
                    'id_dekanat' => user()->id,
                    'id_dosen' => $id_dosen,
                    'tanggal' => date('d-m-Y'),
                    'kode_surat' => $this->request->getVar('kode_surat'),
                    'perihal' => $this->request->getVar('perihal'),
                    'jenis_surat' => 'Surat Tugas',
                    'tujuan' => "",
                    'prodi' => $prodi_dosen[0],
                    'nama_dosen' => $nama_dosen[0],
                    'nik_dosen' => $nik_dosen[0],
                    'kegiatan_keperluan' => $this->request->getVar('kegiatan_keperluan'),
                    'periode_awal' => $this->request->getVar('periode_awal'),
                    'periode_akhir' => $this->request->getVar('periode_akhir'),
                    'sifat' => "Urgent",
                    'tembusan' => "",
                    'catatan' => "",
                    'lampiran' => $lampiran_path,
                    'no_urut' => 0,
                    'status' => "Download",
                    'author' => user()->nama_user,
                    'revisi' => "",
                ];

                // Insert pengajuan ke table arsip
                $this->ArsipSuratModel->insert($data);
            } else {
                continue;
            }
        }

        return redirect()->to('admin/arsipsurat');
    }
}
