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

        $jumlahRow = 1;
        $perihal = $this->request->getVar('perihal');

        for ($k = 1; $k <= 10; $k++) {
            $cekdosen = $this->request->getVar('dosen' . $k);
            $dosen1 = $this->request->getVar('dosen1');
            if (empty($dosen1)) {
                return redirect()->to('user/pengajuansurat_tugas')->with('msg-failed', 'Dosen belum terisi');
            }
            if ($cekdosen == "" || $cekdosen == null) {
                $jumlahRow = $k - 1;
                break; // Keluar dari loop ketika dosen kosong ditemukan
            }
        }
        for ($i = 1; $i <= $jumlahRow; $i++) {
            $id_dosen = $this->request->getVar('dosen' . $i);

            // Lewati iterasi jika $id_dosen kosong
            if (empty($id_dosen)) {
                continue;
            }

            // Mendapatkan data dosen dari database
            $nik_dosen = $this->DosenModel->getNikDosen($id_dosen);
            $nama_dosen = $this->DosenModel->getNamaDosen($id_dosen);
            $prodi_dosen = $this->DosenModel->getProdiDosen($id_dosen);

            $perihal = $this->request->getVar('perihal');
            $jenis_publikasi = $this->request->getVar('jenis_publikasi');
            $keputusan = $this->request->getVar('keputusan');

            // Cek apakah data dosen ditemukan
            if ($nik_dosen && $nama_dosen && $prodi_dosen) {
                $data = [
                    'id_dekanat' => user()->id,
                    'id_dosen' => $id_dosen,
                    'tanggal' => date('d-m-Y'),
                    'kode_surat' => $formatted_no_urut . "/" . $kode_surat[0],
                    'perihal' => $perihal,
                    'jenis_publikasi' => $jenis_publikasi,
                    'keputusan' => $keputusan,
                    'jenis_surat' => $jenis_surat,
                    'prodi' => $prodi_dosen[0],
                    'nama_dosen' => $nama_dosen[0],
                    'nik_dosen' => $nik_dosen[0],
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

        $jenis_surat = 'Surat Keputusan';
        $no_urut = $this->KodeSuratModel->getNoUrutByJenis($jenis_surat);

        $new_no_urut = $no_urut + 1;
        $formatted_no_urut = str_pad($new_no_urut, 3, '0', STR_PAD_LEFT);

        $kode_surat = $this->KodeSuratModel->getKodeSuratByJenis($jenis_surat);
        $jumlahRow = 1;
        $perihal = $this->request->getVar('perihal');

        for ($k = 1; $k <= 10; $k++) {
            if ($perihal == "Pengajaran") {
                $jumlahRow = 1;
                break;
            } else {
                $cekdosen = $this->request->getVar('dosen' . $k);
                if ($cekdosen == "" || $cekdosen == null) {
                    $jumlahRow = $k - 1;
                    break; // Keluar dari loop ketika dosen kosong ditemukan
                }
            }
        }

        for ($i = 1; $i <= $jumlahRow; $i++) {
            $id_dosen = $this->request->getVar('dosen' . $i);

            $jenis_publikasi = $this->request->getVar('jenis_publikasi');
            $keputusan = $this->request->getVar('keputusan');

            // Lewati iterasi jika $id_dosen kosong
            if (empty($id_dosen)) {
                if ($perihal == "Pengajaran") {
                    $i = 10;
                    $id_dosen = 0;
                    $nik_dosen = 0;
                    $nama_dosen = "";
                    $prodi_dosen = "";

                    $data = [
                        'id_dekanat' => user()->id,
                        'id_dosen' => $id_dosen,
                        'tanggal' => date('d-m-Y'),
                        'kode_surat' => $formatted_no_urut . "/" . $kode_surat[0],
                        'perihal' => $perihal,
                        'jenis_publikasi' => $jenis_publikasi,
                        'keputusan' => $keputusan,
                        'jenis_surat' => $jenis_surat,
                        'prodi' => $prodi_dosen,
                        'nama_dosen' => $nama_dosen,
                        'nik_dosen' => $nik_dosen,
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

                    return redirect()->to('/user/daftarsurat')->with('msg-surat', 'Surat baru berhasil ditambahkan.');
                } else {
                    return redirect()->to('user/pengajuansurat_keputusan')->with('msg-failed', 'Dosen belum terisi');
                }
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
                    'kode_surat' => $formatted_no_urut . "/" . $kode_surat[0],
                    'perihal' => $perihal,
                    'jenis_publikasi' => $jenis_publikasi,
                    'keputusan' => $keputusan,
                    'jenis_surat' => $jenis_surat,
                    'prodi' => $prodi_dosen[0],
                    'nama_dosen' => $nama_dosen[0],
                    'nik_dosen' => $nik_dosen[0],
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
                continue;
            }
        }

        return redirect()->to('/user/daftarsurat')->with('msg-surat', 'Surat baru berhasil ditambahkan.');
    }

    public function submit_pengajuansurat_formal()
    {
        // Handle file upload
        $file = $this->request->getFile('lampiran');
        $lampiran_path = null;

        /*if ($file->isValid() && !$file->hasMoved()) {
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
        }*/

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
        $jenis_publikasi = "";
        $keputusan = "";


        // Cek apakah data dosen ditemukan
        if ($nik_dosen && $nama_dosen && $prodi_dosen) {
            $data = [
                'id_dekanat' => user()->id,
                'id_dosen' => $id_dosen,
                'tanggal' => date('d-m-Y'),
                'kode_surat' => "00/00",
                'perihal' => $this->request->getVar('perihal'),
                'jenis_publikasi' => $jenis_publikasi,
                'keputusan' => $keputusan,
                'jenis_surat' => $jenis_surat,
                'prodi' => $prodi_dosen[0],
                'nama_dosen' => $nama_dosen[0],
                'nik_dosen' => $nik_dosen[0],
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
