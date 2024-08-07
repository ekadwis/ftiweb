<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }
}
