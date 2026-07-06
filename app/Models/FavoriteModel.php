<?php

namespace App\Models;

use CodeIgniter\Model;

class FavoriteModel extends Model
{
    protected $table = 'favorites';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = ['user_id', 'kuliner_id', 'created_at'];

    protected $beforeInsert = ['addTimestamp'];

    protected function addTimestamp(array $data): array
    {
        $data['data']['created_at'] = date('Y-m-d H:i:s');
        return $data;
    }

    public function getUserFavorites(int $userId)
    {
        return $this->select('favorites.*, kuliners.nama, kuliners.slug, kuliners.foto_utama, kuliners.avg_rating, categories.nama as category_nama')
                    ->join('kuliners', 'kuliners.id = favorites.kuliner_id')
                    ->join('categories', 'categories.id = kuliners.category_id')
                    ->where('favorites.user_id', $userId)
                    ->findAll();
    }

    public function isFavorited(int $userId, int $kulinerId): bool
    {
        return $this->where(['user_id' => $userId, 'kuliner_id' => $kulinerId])->first() !== null;
    }

    public function toggleFavorite(int $userId, int $kulinerId): bool
    {
        $existing = $this->where(['user_id' => $userId, 'kuliner_id' => $kulinerId])->first();
        if ($existing) {
            $this->delete($existing['id']);
            return false;
        }
        $this->insert(['user_id' => $userId, 'kuliner_id' => $kulinerId]);
        return true;
    }
}
