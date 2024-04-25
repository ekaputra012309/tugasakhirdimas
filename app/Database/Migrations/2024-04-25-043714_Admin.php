<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Admin extends Migration
{
    public function up()
    {
        // Define table columns
        $fields = [
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'namakaryawan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'id_jabatan' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true, // Make sure it's unsigned
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ];

        // Add created_at and updated_at timestamps
        $this->forge->addField($fields);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_jabatan', 'jabatan', 'id_jabatan', 'CASCADE', 'CASCADE');
        $this->forge->createTable('admin', true);
    }

    public function down()
    {
        // Drop the table if it exists
        $this->forge->dropTable('admin', true);
    }
}
