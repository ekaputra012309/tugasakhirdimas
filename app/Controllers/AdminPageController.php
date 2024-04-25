<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AdminPageController extends BaseController
{
    public function login()
    {
        $data = array(
            'title' => 'Admin Login | AdminLTE',
        );
        return view('admin/login', $data);
    }

    public function dashboard()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/admin/login')->with('error', 'Unauthorized access');
        }
        $data = array(
            'title' => 'Dashboard | AdminLTE',
        );
        return view('admin/dashboard', $data);
    }

    // admin
    public function admin()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/admin/login')->with('error', 'Unauthorized access');
        }
        $data = array(
            'title' => 'Table Admin | AdminLTE',
        );
        return view('admin/admin/admin', $data);
    }
    public function addAdmin()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/admin/login')->with('error', 'Unauthorized access');
        }
        $jabatanModel = new \App\Models\JabatanModel();
        $jabatan = $jabatanModel->findAll();
        $data = array(
            'title' => 'Add Admin | AdminLTE',
            'jabatan' => $jabatan,
        );
        // dd($data);
        return view('admin/admin/add', $data);
    }
    public function editadmin()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/admin/login')->with('error', 'Unauthorized access');
        }
        $encodedId = $this->request->getGet('id');
        $jabatanModel = new \App\Models\JabatanModel();
        $jabatan = $jabatanModel->findAll();
        $data = array(
            'title' => 'Edit Admin | AdminLTE',
            'jabatan' => $jabatan,
            'id' => base64_decode($encodedId),
        );
        return view('admin/admin/edit', $data);
    }

    // jabatan
    public function jabatan()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/jabatan/login')->with('error', 'Unauthorized access');
        }
        $data = array(
            'title' => 'Table Jabatan | AdminLTE',
        );
        return view('admin/jabatan/jabatan', $data);
    }
    public function addjabatan()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/jabatan/login')->with('error', 'Unauthorized access');
        }
        $data = array(
            'title' => 'Add Jabatan | AdminLTE',
        );
        return view('admin/jabatan/add', $data);
    }
    public function editjabatan()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/jabatan/login')->with('error', 'Unauthorized access');
        }
        $encodedId = $this->request->getGet('id');
        $data = array(
            'title' => 'Edit Jabatan | AdminLTE',
            'id' => base64_decode($encodedId),
        );
        return view('admin/jabatan/edit', $data);
    }
}
