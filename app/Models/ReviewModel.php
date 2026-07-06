<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model
{
    protected $table = 'reviews';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = ['kuliner_id', 'user_id', 'rating', 'komentar'];

    protected $validationRules = [
        'rating'   => 'required|integer|greater_than[0]|less_than[6]',
        'komentar' => 'required|min_length[10]',
    ];

    public function getByKuliner(int $kulinerId)
    {
        return $this->select('reviews.*, users.username')
                    ->join('users', 'users.id = reviews.user_id')
                    ->where('kuliner_id', $kulinerId)
                    ->orderBy('reviews.created_at', 'DESC')
                    ->findAll();
    }

    public function canEdit(int $reviewId, int $userId): bool
    {
        $review = $this->find($reviewId);
        if (!$review || $review['user_id'] != $userId) {
            return false;
        }
        $created = strtotime($review['created_at']);
        return (time() - $created) < 86400;
    }
}
