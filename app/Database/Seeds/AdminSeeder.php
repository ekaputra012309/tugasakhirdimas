<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Load the Model
        $adminModel = model('AdminModel');

        // Data to insert
        $data = [
            'email' => 'admin@gmail.com',
            'namakaryawan' => 'John Park',
            'id_jabatan' => '1',
            'username' => 'johnpark',
            'password' => password_hash('password123', PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // Insert data
        $adminModel->insert($data);
    }
}
