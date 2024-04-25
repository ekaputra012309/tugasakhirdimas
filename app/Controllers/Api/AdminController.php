<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\AdminModel;

class AdminController extends BaseController
{
    use ResponseTrait;

    protected $model;

    public function __construct()
    {
        $this->model = new AdminModel();
    }

    public function index()
    {
        $admins = $this->model->getAdminsWithJabatan();
        return $this->respond($admins);
    }

    public function show($id = null)
    {
        $admin = $this->model->getAdminsWithJabatan($id);
        return $this->respond($admin);
    }

    public function create()
    {
        $data = $this->request->getJSON();
        $hashedPassword = password_hash($data->password, PASSWORD_DEFAULT);
        $data->password = $hashedPassword;
        $this->model->insert($data);
        return $this->respondCreated(['message' => 'Admin created successfully']);
    }


    public function update($id = null)
    {
        $data = $this->request->getJSON();
        $this->model->update($id, $data);
        return $this->respond(['message' => 'Admin updated successfully']);
    }

    public function delete($id = null)
    {
        $this->model->delete($id);
        return $this->respond(['message' => 'Admin deleted successfully']);
    }
}
