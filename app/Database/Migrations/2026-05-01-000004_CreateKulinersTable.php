<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKulinersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'user_id' => ['type' => 'INT', 'unsigned' => true],
            'category_id' => ['type' => 'INT', 'unsigned' => true],
            'nama' => ['type' => 'VARCHAR', 'constraint' => 200],
            'slug' => ['type' => 'VARCHAR', 'constraint' => 200],
            'alamat' => ['type' => 'TEXT'],
            'deskripsi' => ['type' => 'TEXT', 'null' => true],
            'latitude' => ['type' => 'DECIMAL', 'constraint' => '10,7', 'null' => true],
            'longitude' => ['type' => 'DECIMAL', 'constraint' => '10,7', 'null' => true],
            'foto_utama' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'status' => ['type' => 'ENUM', 'constraint' => ['pending', 'approved', 'rejected'], 'default' => 'pending'],
            'is_closed' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'avg_rating' => ['type' => 'DECIMAL', 'constraint' => '3,2', 'default' => 0],
            'total_reviews' => ['type' => 'INT', 'unsigned' => true, 'default' => 0],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('slug');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('category_id', 'categories', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('kuliners');
    }

    public function down()
    {
        $this->forge->dropTable('kuliners');
    }
}
