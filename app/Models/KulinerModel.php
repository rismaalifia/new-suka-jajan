<?php

namespace App\Models;

use CodeIgniter\Model;

class KulinerModel extends Model
{
    protected $table = 'kuliners';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'user_id', 'category_id', 'nama', 'slug', 'alamat',
        'deskripsi', 'latitude', 'longitude', 'foto_utama',
        'status', 'is_closed', 'avg_rating', 'total_reviews',
    ];

    protected $validationRules = [
        'nama'        => 'required|max_length[200]',
        'alamat'      => 'required',
        'category_id' => 'required|integer',
    ];

    public function getWithCategory()
    {
        return $this->select('kuliners.*, categories.nama as category_nama')
                    ->join('categories', 'categories.id = kuliners.category_id');
    }

    public function updateRating(int $kulinerId)
    {
        $db = \Config\Database::connect();
        $result = $db->table('reviews')
                     ->select('AVG(rating) as avg_rating, COUNT(*) as total_reviews')
                     ->where('kuliner_id', $kulinerId)
                     ->get()
                     ->getRowArray();

        $this->update($kulinerId, [
            'avg_rating'    => round($result['avg_rating'] ?? 0, 2),
            'total_reviews' => $result['total_reviews'] ?? 0,
        ]);
    }

    public function findNearby(float $lat, float $lng, float $radiusKm = 5)
    {
        $haversine = "(6371 * acos(cos(radians($lat)) * cos(radians(latitude)) * cos(radians(longitude) - radians($lng)) + sin(radians($lat)) * sin(radians(latitude))))";

        return $this->select("kuliners.*, categories.nama as category_nama, $haversine AS distance")
                    ->join('categories', 'categories.id = kuliners.category_id')
                    ->where('status', 'approved')
                    ->where("$haversine <=", $radiusKm, false)
                    ->orderBy('distance', 'ASC');
    }
}
