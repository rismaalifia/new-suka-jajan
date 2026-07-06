<?php

namespace App\Models;

use CodeIgniter\Model;

class PhotoModel extends Model
{
    protected $table = 'photos';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = ['kuliner_id', 'user_id', 'filename', 'thumbnail', 'created_at'];

    protected $beforeInsert = ['addTimestamp'];

    protected function addTimestamp(array $data): array
    {
        $data['data']['created_at'] = date('Y-m-d H:i:s');
        return $data;
    }

    public function getByKuliner(int $kulinerId): array
    {
        return $this->where('kuliner_id', $kulinerId)->findAll();
    }

    public function countByKuliner(int $kulinerId): int
    {
        return $this->where('kuliner_id', $kulinerId)->countAllResults();
    }
}
