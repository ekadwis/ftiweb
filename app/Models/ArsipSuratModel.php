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
    protected $allowedFields    = ['id_permohonan', 'id_surat', 'id_dekanat', 'id_dosen', 'tanggal', 'kode_surat', 'perihal', 'jenis_surat', 'tujuan', 'prodi', 'nama_dosen', 'nik_dosen', 'kegiatan_keperluan', 'periode_awal', 'periode_akhir', 'sifat', 'tembusan', 'catatan', 'lampiran', 'no_urut', 'status'];

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
}
