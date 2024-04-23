<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Debug\Toolbar\Collectors\Views;
use CodeIgniter\HTTP\ResponseInterface;

class AdminPageController extends BaseController
{
    public function login()
    {
        return view('admin/login');
    }

    public function dashboard()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/admin/login')->with('error', 'Unauthorized access');
        }
        return view('admin/dashboard');
    }
}
