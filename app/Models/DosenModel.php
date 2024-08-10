<?php

namespace App\Models;

use CodeIgniter\Model;

class DosenModel extends Model
{
    protected $table            = 'dosen';
    protected $primaryKey       = 'id_dosen';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_dosen', 'nik_dosen', 'prodi_dosen', 'no_telp_dosen', 'email_dosen'];

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

    public function getNamaDosen($id_dosen)
    {
        return $this->where('id_dosen', $id_dosen)
        ->findColumn('nama_dosen');
    }

    public function getNikDosen($id_dosen)
    {
        return $this->where('id_dosen', $id_dosen)
        ->findColumn('nik_dosen');
    }

    public function getProdiDosen($id_dosen)
    {
        return $this->where('id_dosen', $id_dosen)
        ->findColumn('prodi_dosen');
    }
}
