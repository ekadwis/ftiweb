<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
       return view('');
    }

    public function pengajuanSurat()
    {
        return view('admin/data_pengajuan_surat_dekanat');
    }
}
