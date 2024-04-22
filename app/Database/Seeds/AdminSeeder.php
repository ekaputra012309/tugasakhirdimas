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
            'username' => 'johnpark',
            'password' => password_hash('password123', PASSWORD_DEFAULT),
            'namakaryawan' => 'John Park',
            'email' => 'admin@gmail.com',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // Insert data
        $adminModel->insert($data);
    }
}
