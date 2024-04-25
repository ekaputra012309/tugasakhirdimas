<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\JabatanModel;

class JabatanController extends BaseController
{
    use ResponseTrait;

    protected $model;

    public function __construct()
    {
        $this->model = new JabatanModel();
    }

    public function index()
    {
        $jabatans = $this->model->findAll();
        return $this->respond($jabatans);
    }

    public function show($id = null)
    {
        $jabatan = $this->model->find($id);
        return $this->respond($jabatan);
    }

    public function create()
    {
        $data = $this->request->getVar();
        $this->model->insert($data);
        return $this->respondCreated(['message' => 'Jabatan created successfully']);
    }


    public function update($id = null)
    {
        $data = $this->request->getJSON();
        $this->model->update($id, $data);
        return $this->respond(['message' => 'Jabatan updated successfully']);
    }

    public function delete($id = null)
    {
        $this->model->delete($id);
        return $this->respond(['message' => 'Jabatan deleted successfully']);
    }
}
