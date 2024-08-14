<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SuratModel;
use App\Models\KodeSuratModel;
use App\Models\DosenModel;

class SuratController extends BaseController
{
    protected $SuratModel;
    protected $KodeSuratModel;
    protected $DosenModel;

    function __construct()
    {
        $this->SuratModel = new SuratModel();
        $this->KodeSuratModel = new KodeSuratModel();
        $this->DosenModel = new DosenModel();
    }
    public function submit_pengajuansurat_tugas()
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

        $jenis_surat = 'Surat Tugas';
        $no_urut = $this->KodeSuratModel->getNoUrutByJenis($jenis_surat);

        $new_no_urut = $no_urut + 1;
        $formatted_no_urut = str_pad($new_no_urut, 3, '0', STR_PAD_LEFT);

        $kode_surat = $this->KodeSuratModel->getKodeSuratByJenis($jenis_surat);
        for ($i = 1; $i <= 10; $i++) {
            $id_dosen = $this->request->getVar('dosen' . $i);

            // Lewati iterasi jika $id_dosen kosong
            if (empty($id_dosen)) {
                continue;
            }

            // Mendapatkan data dosen dari database
            $nik_dosen = $this->DosenModel->getNikDosen($id_dosen);
            $nama_dosen = $this->DosenModel->getNamaDosen($id_dosen);
            $prodi_dosen = $this->DosenModel->getProdiDosen($id_dosen);

            // Cek apakah data dosen ditemukan
            if ($nik_dosen && $nama_dosen && $prodi_dosen) {
                $data = [
                    'id_dekanat' => user()->id,
                    'id_dosen' => $id_dosen,
                    'tanggal' => date('d-m-Y'),
                    'kode_surat' => $kode_surat[0] . "/" . $formatted_no_urut,
                    'perihal' => $this->request->getVar('perihal'),
                    'jenis_surat' => $jenis_surat,
                    'tujuan' => $this->request->getVar('tujuan'),
                    'prodi' => $prodi_dosen[0],
                    'nama_dosen' => $nama_dosen[0],
                    'nik_dosen' => $nik_dosen[0],
                    'kegiatan_keperluan' => $this->request->getVar('kegiatan_keperluan'),
                    'periode_awal' => $this->request->getVar('periode_awal'),
                    'periode_akhir' => $this->request->getVar('periode_akhir'),
                    'sifat' => $this->request->getVar('sifat'),
                    'tembusan' => $this->request->getVar('tembusan'),
                    'catatan' => $this->request->getVar('catatan'),
                    'lampiran' => $lampiran_path,
                    'no_urut' => $new_no_urut,
                    'status' => "Pending",
                ];

                // Update no_urut di table kode_surat
                $this->KodeSuratModel->update_no_urut($kode_surat, $new_no_urut);

                // Insert pengajuan ke table surat
                $this->SuratModel->insert($data);
            } else {
                // Jika data dosen tidak ditemukan, log kesalahan atau lewati iterasi
                return redirect()->to('/user/pengajuansurat_tugas')->with('msg-failed', 'Dosen belum ditambahkan');
            }
        }

        return redirect()->to('/user/daftarsurat')->with('msg-surat', 'Surat baru berhasil ditambahkan.');
    }

    public function submit_pengajuansurat_keputusan()
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

            // Lewati iterasi jika $id_dosen kosong
            if (empty($id_dosen)) {
                continue;
            }

            $jenis_surat = 'Surat Keputusan';
            $no_urut = $this->KodeSuratModel->getNoUrutByJenis($jenis_surat);

            $new_no_urut = $no_urut + 1;
            $formatted_no_urut = str_pad($new_no_urut, 3, '0', STR_PAD_LEFT);

            $kode_surat = $this->KodeSuratModel->getKodeSuratByJenis($jenis_surat);

            // Mendapatkan data dosen dari database
            $nik_dosen = $this->DosenModel->getNikDosen($id_dosen);
            $nama_dosen = $this->DosenModel->getNamaDosen($id_dosen);
            $prodi_dosen = $this->DosenModel->getProdiDosen($id_dosen);

            // Cek apakah data dosen ditemukan
            if ($nik_dosen && $nama_dosen && $prodi_dosen) {
                $data = [
                    'id_dekanat' => user()->id,
                    'id_dosen' => $id_dosen,
                    'tanggal' => date('d-m-Y'),
                    'kode_surat' => $kode_surat[0] . "/" . $formatted_no_urut,
                    'perihal' => $this->request->getVar('perihal'),
                    'jenis_surat' => $jenis_surat,
                    'tujuan' => $this->request->getVar('tujuan'),
                    'prodi' => $prodi_dosen[0],
                    'nama_dosen' => $nama_dosen[0],
                    'nik_dosen' => $nik_dosen[0],
                    'kegiatan_keperluan' => $this->request->getVar('kegiatan_keperluan'),
                    'periode_awal' => $this->request->getVar('periode_awal'),
                    'periode_akhir' => $this->request->getVar('periode_akhir'),
                    'sifat' => $this->request->getVar('sifat'),
                    'tembusan' => $this->request->getVar('tembusan'),
                    'catatan' => $this->request->getVar('catatan'),
                    'lampiran' => $lampiran_path,
                    'no_urut' => $new_no_urut,
                    'status' => "Pending",
                ];

                // Update no_urut di table kode_surat
                $this->KodeSuratModel->update_no_urut($kode_surat, $new_no_urut);

                // Insert pengajuan ke table surat
                $this->SuratModel->insert($data);
            } else {
                // Jika data dosen tidak ditemukan, log kesalahan atau lewati iterasi
                return redirect()->to('/user/pengajuansurat_keputusan')->with('msg-failed', 'Dosen belum ditambahkan');
                break;
            }
        }

        return redirect()->to('/user/daftarsurat')->with('msg-surat', 'Surat baru berhasil ditambahkan.');
    }

    public function submit_pengajuansurat_formal()
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

        $id_dosen = $this->request->getVar('dosen');


        $jenis_surat = 'Surat Formal';
        $no_urut = $this->KodeSuratModel->getNoUrutByJenis($jenis_surat);
        
        $new_no_urut = $no_urut + 1;
        $formatted_no_urut = str_pad($new_no_urut, 3, '0', STR_PAD_LEFT);

        $kode_surat = $this->KodeSuratModel->getKodeSuratByJenis($jenis_surat);

        // Mendapatkan data dosen dari database
        $nik_dosen = $this->DosenModel->getNikDosen($id_dosen);
        $nama_dosen = $this->DosenModel->getNamaDosen($id_dosen);
        $prodi_dosen = $this->DosenModel->getProdiDosen($id_dosen);


        // Cek apakah data dosen ditemukan
        if ($nik_dosen && $nama_dosen && $prodi_dosen) {
            $data = [
                'id_dekanat' => user()->id,
                'id_dosen' => $id_dosen,
                'tanggal' => date('d-m-Y'),
                'kode_surat' => $kode_surat[0] . "/" . $formatted_no_urut,
                'perihal' => $this->request->getVar('perihal'),
                'jenis_surat' => $jenis_surat,
                'tujuan' => $this->request->getVar('tujuan'),
                'prodi' => $prodi_dosen[0],
                'nama_dosen' => $nama_dosen[0],
                'nik_dosen' => $nik_dosen[0],
                'kegiatan_keperluan' => $this->request->getVar('kegiatan_keperluan'),
                'periode_awal' => $this->request->getVar('periode_awal'),
                'periode_akhir' => $this->request->getVar('periode_akhir'),
                'sifat' => $this->request->getVar('sifat'),
                'tembusan' => $this->request->getVar('tembusan'),
                'catatan' => "",
                'lampiran' => $lampiran_path,
                'no_urut' => $new_no_urut,
                'status' => "Pending",
            ];

            // Update no_urut di table kode_surat
            $this->KodeSuratModel->update_no_urut($kode_surat, $new_no_urut);
            // Insert pengajuan ke table surat
            $this->SuratModel->insert($data);
        } else {
            // Jika data dosen tidak ditemukan, log kesalahan atau lewati iterasi
            return redirect()->to('/user/pengajuansurat_formal')->with('msg-failed', 'Dosen belum ditambahkan');
        }


        return redirect()->to('/user/daftarsurat')->with('msg-surat', 'Surat baru berhasil ditambahkan.');
    }
}
