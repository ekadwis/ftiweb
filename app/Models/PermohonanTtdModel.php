<?php

namespace App\Models;

use CodeIgniter\Model;

class PermohonanTtdModel extends Model
{
    protected $table            = 'permohonan_ttd';
    protected $primaryKey       = 'id_permohonan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_surat', 'id_dekanat', 'id_dosen', 'tanggal', 'kode_surat', 'perihal', 'jenis_surat', 'tujuan', 'prodi', 'nama_dosen', 'nik_dosen', 'kegiatan_keperluan', 'periode_awal', 'periode_akhir', 'sifat', 'tembusan', 'catatan', 'lampiran', 'no_urut', 'status', 'jenis_publikasi', 'keputusan'];


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

    public function getKodeSurat($id_permohonan)
    {
        return $this->where('id_permohonan', $id_permohonan)
            ->findColumn('kode_surat');
    }

    public function getNoUrut($id_permohonan)
    {
        return $this->where('id_permohonan', $id_permohonan)
            ->findColumn('no_urut');
    }

    public function getDosenByKodeSurat($kode_surat)
    {
        return $this->select('nama_dosen, nik_dosen, prodi')
            ->where('kode_surat', $kode_surat)
            ->findAll();
    }

    public function updateKodeSurat($old_kode_surat, $new_kode_surat)
    {
        return $this->set('kode_surat', $new_kode_surat)
            ->where('kode_surat', $old_kode_surat)
            ->update();
    }

    public function updateJenisSurat($kode_surat, $jenis_surat)
    {
        return $this->set('jenis_surat', $jenis_surat)
            ->where('kode_surat', $kode_surat)
            ->update();
    }

    public function deleteById($id_permohonan)
    {
        return $this->where('id_permohonan', $id_permohonan)
            ->delete();
    }

    public function getPerihalById($id_permohonan)
    {
        return $this->where('id_permohonan', $id_permohonan)
            ->findColumn('perihal');
    }
}
