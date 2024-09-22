<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratModel extends Model
{
    protected $table            = 'surat';
    protected $primaryKey       = 'id_surat';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_dekanat', 'id_dosen', 'tanggal', 'kode_surat', 'perihal', 'jenis_surat', 'tujuan', 'prodi', 'nama_dosen', 'nik_dosen', 'kegiatan_keperluan', 'periode_awal', 'periode_akhir', 'sifat', 'tembusan', 'catatan', 'lampiran', 'no_urut', 'status', 'jenis_publikasi', 'keputusan'];

    
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

    public function getKodeSurat($id_surat)
    {
        return $this->where('id_surat', $id_surat)
                    ->findColumn('kode_surat');
    }

    public function getDosenByKodeSurat($kode_surat)
    {
        return $this->select('nama_dosen, nik_dosen, prodi')
                    ->where('kode_surat', $kode_surat)
                    ->findAll();
    }

    public function updateRevisiByKodeSurat($kode_surat, $revisi)
    {
        return $this->set('revisi', $revisi)
                    ->where('kode_surat', $kode_surat)
                    ->update();
    }
}
