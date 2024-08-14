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
    protected $allowedFields    = ['id_permohonan', 'id_surat', 'id_dekanat', 'id_dosen', 'tanggal', 'kode_surat', 'perihal', 'jenis_surat', 'tujuan', 'prodi', 'nama_dosen', 'nik_dosen', 'kegiatan_keperluan', 'periode_awal', 'periode_akhir', 'sifat', 'tembusan', 'catatan', 'lampiran', 'no_urut', 'status', 'revisi', 'author'];

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


    public function getSuratDosen($params)
    {
        // Ambil NIK dari user yang sedang login
        $nikUser = user()->nik_user;

        // Tentukan arah pengurutan berdasarkan parameter
        $order = ($params === 'most') ? 'DESC' : 'ASC';

        // Query untuk mendapatkan data dosen dengan pengurutan surat sesuai parameter
        $query = $this->select('dosen.nama_dosen, dosen.nik_dosen, COUNT(arsip_surat.id_arsip) as jumlah_surat')
            ->join('dosen', 'arsip_surat.id_dosen = dosen.id_dosen')
            ->groupBy('dosen.nama_dosen, dosen.nik_dosen')
            ->orderBy('jumlah_surat', $order)
            ->limit(5);

        // Jika NIK user ada, tambahkan kondisi untuk mengecualikan data yang cocok
        if ($nikUser) {
            $query->where('dosen.nik_dosen !=', $nikUser);
        }

        // Eksekusi query dan ambil hasilnya
        $result = $query->findAll();

        // Jika tidak ada hasil, ulangi query tanpa kondisi where
        if (empty($result)) {
            $result = $this->select('dosen.nama_dosen, dosen.nik_dosen, COUNT(arsip_surat.id_arsip) as jumlah_surat')
                ->join('dosen', 'arsip_surat.id_dosen = dosen.id_dosen')
                ->groupBy('dosen.nama_dosen, dosen.nik_dosen')
                ->orderBy('jumlah_surat', $order)
                ->limit(5)
                ->findAll();
        }

        return $result;
    }
    public function getPerihalDosen($startDate, $endDate)
    {
        return $this->select('arsip_surat.id_surat, arsip_surat.perihal, arsip_surat.periode_awal, arsip_surat.periode_akhir, COUNT(arsip_surat.id_dosen) as jumlah_dosen, COUNT(arsip_surat.perihal) as jumlah_perihal')
            ->where('arsip_surat.periode_awal >=', $startDate)
            ->where('arsip_surat.periode_akhir <=', $endDate)
            ->groupBy('arsip_surat.perihal')
            ->findAll();
    }
}
