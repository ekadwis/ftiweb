<?php

namespace App\Models;

use CodeIgniter\Model;

class KodeSuratModel extends Model
{
    protected $table            = 'kode_surat';
    protected $primaryKey       = 'id_surat';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kode_surat', 'jenis_surat', 'no_urut'];

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

    public function getNoUrutByJenis($jenisSurat)
    {
         // Mengambil satu hasil sebagai integer
         return $this->where('jenis_surat', $jenisSurat)
         ->findColumn('no_urut')[0] ?? null; // Mengambil nilai no_urut pertama, jika ada
    }

    public function getKodeSuratByJenis($jenisSurat)
    {
        return $this->where('jenis_surat', $jenisSurat)
                    ->findColumn('kode_surat');
    }

    public function update_no_urut($kode_surat, $no_urut) {
        return $this->set('no_urut', $no_urut)
                    ->where('kode_surat', $kode_surat)
                    ->update();
    }
    
}

