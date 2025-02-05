<?php

namespace App\Models;

use CodeIgniter\Model;

class ArsipSuratModel extends Model
{
    protected $table            = 'arsip_surat';
    protected $primaryKey       = 'id_arsip';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_permohonan', 'id_surat', 'id_dekanat', 'id_dosen', 'tanggal', 'kode_surat', 'perihal', 'jenis_surat', 'tujuan', 'prodi', 'nama_dosen', 'nik_dosen', 'keputusan', 'periode_awal', 'periode_akhir', 'sifat', 'tembusan', 'catatan', 'lampiran', 'no_urut', 'status', 'revisi', 'author', 'jenis_publikasi', 'keputusan', 'jumlah_matkul'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    public function getSuratDosen($type, $startDate, $endDate, $prodi, $beban)
    {
        // Ambil NIK dari user yang sedang login
        $nikUser = user()->nik_user;

        // Tentukan arah pengurutan berdasarkan parameter
        $order = ($type === 'most') ? 'DESC' : 'ASC';

        // Query dasar
        $builder = $this->db->table('arsip_surat')
            ->select('dosen.nama_dosen, arsip_surat.jumlah_matkul, dosen.nik_dosen, COUNT(arsip_surat.id_arsip) as jumlah_surat, arsip_surat.perihal')
            ->join('dosen', 'arsip_surat.id_dosen = dosen.id_dosen')
            ->where('arsip_surat.periode_awal >=', $startDate)
            ->where('arsip_surat.periode_akhir <=', $endDate)
            ->like('arsip_surat.prodi', $prodi)
            ->like('arsip_surat.perihal', $beban)
            ->groupBy('dosen.nama_dosen, dosen.nik_dosen')
            ->orderBy('arsip_surat.jumlah_matkul', $order)
            ->limit(5);

        // Tambahkan filter untuk NIK jika ada
        if (!empty($nikUser)) {
            $builder->where('dosen.nik_dosen !=', $nikUser);
        }

        // Eksekusi query
        $result = $builder->get()->getResultArray();

        // Cek jika hasil kosong, beri default output
        if (empty($result)) {
            $result = array(
                array(
                    "nama_dosen" => "Data Tidak ada",
                    "jumlah_surat" => "0"
                )
            );
        }

        return $result;
    }
    public function getSuratPerihalDosen($startDate, $endDate, $prodi)
    {
        return $this->select('arsip_surat.*') // Mengambil semua kolom dari arsip_surat
            ->where('arsip_surat.periode_awal >=', $startDate)
            ->where('arsip_surat.periode_akhir <=', $endDate)
            ->like('arsip_surat.prodi', $prodi)
            ->findAll();
    }

    public function getPerihalDosen($startDate, $endDate, $prodi)
    {
        return $this->select('*, arsip_surat.periode_akhir, COUNT(id_arsip) as jumlah_surat, arsip_surat.periode_akhir, COUNT(DISTINCT id_dosen) as jumlah_dosen')
            ->where('arsip_surat.periode_awal >=', $startDate)
            ->where('arsip_surat.periode_akhir <=', $endDate)
            ->like('arsip_surat.prodi', $prodi)
            ->groupBy(['arsip_surat.perihal', 'arsip_surat.periode_awal', 'arsip_surat.periode_akhir'])
            ->findAll();
    }

    public function findBySection($section)
    {
        return $this->select('arsip_surat.perihal, arsip_surat.nama_dosen, arsip_surat.keputusan, arsip_surat.periode_awal, arsip_surat.periode_akhir')
            ->like('arsip_surat.perihal', $section)
            ->findAll();
    }
    public function findDosenByProdi($prodi, $section)
    {
        return $this->select('arsip_surat.nama_dosen')
            ->like('arsip_surat.perihal', $section)
            ->like('arsip_surat.prodi', $prodi)
            ->groupBy('arsip_surat.id_dosen')
            ->orderBy("arsip_surat.nama_dosen")
            ->findAll();
    }

    public function chartSurat($startDate, $endDate, $prodi)
    {
        $perihalDosen = $this->getPerihalDosen($startDate, $endDate, $prodi);
        $groupedSurat = [];
        $categories = [];

        $startYear = date('Y', strtotime($startDate));
        $endYear = date('Y', strtotime($endDate));

        for ($year = $startYear; $year <= $endYear; $year++) {
            $categories[] = $year . '/' . ($year + 1) . ' <br> Gasal';
            $categories[] = $year . '/' . ($year + 1) . ' <br> Genap';
        }

        $categoriesMap = array_fill_keys($categories, 0);

        foreach ($perihalDosen as $item) {
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

            if (!isset($groupedSurat[$key])) {
                $groupedSurat[$key] = $categoriesMap;
            }

            $periode = date('Y', strtotime($item['periode_awal'])) . '/' . (date('Y', strtotime($item['periode_awal'])) + 1);
            $semester = (date('m', strtotime($item['periode_awal'])) <= 6) ? 'Genap' : 'Gasal';
            $category = $periode . ' <br> ' . $semester;

            if (isset($groupedSurat[$key][$category])) {
                $groupedSurat[$key][$category] += (int) $item['jumlah_surat'];
            }
        }

        $series = [];
        foreach ($groupedSurat as $key => $data) {
            $series[] = [
                'name' => $key,
                'data' => array_values($data)
            ];
        }
        if (empty($series)) {
            $series[] = [
                'name' => 'No Data',
                'data' => array_fill(0, count($categories), 0)
            ];
        }

        return [
            'series' => $series,
            'categories' => $categories
        ];
    }
    public function getBebanKerjaDetail($section, $startDate, $endDate, $prodi, $dosen)
    {
        return $this->select('arsip_surat.perihal, arsip_surat.keputusan, arsip_surat.jenis_publikasi, arsip_surat.jumlah_matkul, arsip_surat.periode_awal, arsip_surat.periode_akhir, COUNT(id_arsip) as jumlah_surat')
            ->like('arsip_surat.perihal', $section)
            ->where('arsip_surat.periode_awal >=', $startDate)
            ->where('arsip_surat.periode_akhir <=', $endDate)
            ->like('arsip_surat.prodi', $prodi)
            ->like('arsip_surat.nama_dosen', $dosen)
            ->groupBy('arsip_surat.perihal, arsip_surat.jenis_publikasi, arsip_surat.jumlah_matkul, arsip_surat.keputusan, arsip_surat.periode_awal, arsip_surat.periode_akhir')
            ->findAll();
    }

    public function chartDetailSurat($section, $startDate, $endDate, $prodi, $dosen)
    {
        $datas = $this->getBebanKerjaDetail($section, $startDate, $endDate, $prodi, $dosen);
        $categories = [];

        $startYear = date('Y', strtotime($startDate));
        $endYear = date('Y', strtotime($endDate));

        for ($year = $startYear; $year <= $endYear; $year++) {
            $categories[] = $year . '/' . ($year + 1) . ' <br> Gasal';
            $categories[] = $year . '/' . ($year + 1) . ' <br> Genap';
        }

        // Inisialisasi maps untuk jumlah surat dan jumlah matkul
        $categoriesMap = array_fill_keys($categories, ['jumlah_surat' => 0, 'jumlah_matkul' => 0]);

        $seriesData = [];

        foreach ($datas as $item) {
            $perihal = $item['perihal'];

            if (!isset($seriesData[$perihal])) {
                $seriesData[$perihal] = $categoriesMap; // Inisialisasi grup baru untuk perihal
            }

            $periode = date('Y', strtotime($item['periode_awal'])) . '/' . (date('Y', strtotime($item['periode_awal'])) + 1);
            $semester = (date('m', strtotime($item['periode_awal'])) <= 6) ? 'Genap' : 'Gasal';
            $category = $periode . ' <br> ' . $semester;

            if (isset($seriesData[$perihal][$category])) {
                // Tambahkan jumlah surat
                $seriesData[$perihal][$category]['jumlah_surat'] += (int) $item['jumlah_surat'];
                // Tambahkan jumlah matkul (asumsikan ada field 'jumlah_matkul' dalam item)
                $seriesData[$perihal][$category]['jumlah_matkul'] += (int) $item['jumlah_matkul']; // Pastikan item memiliki field ini
            }
        }

        $series = [];
        foreach ($seriesData as $perihal => $data) {
            $series[] = [
                'name' => $perihal,
                'data_jumlah_surat' => array_column($data, 'jumlah_surat'), // Ambil data jumlah surat
                'data_jumlah_matkul' => array_column($data, 'jumlah_matkul')  // Ambil data jumlah matkul
            ];
        }

        if (empty($series)) {
            $series[] = [
                'name' => 'No Data',
                'data_jumlah_surat' => array_fill(0, count($categories), 0),
                'data_jumlah_matkul' => array_fill(0, count($categories), 0)
            ];
        }

        return [
            'series' => $series,
            'categories' => $categories
        ];
    }

    public function getYearFilter()
    {
        // Mengambil tahun terkecil dari periode_awal dan tahun terbesar dari periode_akhir
        return $this->select('MIN(YEAR(periode_awal)) as startYear, MAX(YEAR(periode_akhir)) as endYear')
            ->get()
            ->getRow();
    }
    public function getAllGroupBeban()
    {
        return $this->select('arsip_surat.perihal')
            ->findAll();
    }
}
