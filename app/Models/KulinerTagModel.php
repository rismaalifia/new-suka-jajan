<?php

namespace App\Models;

use CodeIgniter\Model;

class KulinerTagModel extends Model
{
    protected $table = 'kuliner_tags';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = ['kuliner_id', 'tag_id'];

    public function getTagsByKuliner(int $kulinerId): array
    {
        return $this->select('tags.*')
                    ->join('tags', 'tags.id = kuliner_tags.tag_id')
                    ->where('kuliner_id', $kulinerId)
                    ->findAll();
    }

    public function syncTags(int $kulinerId, array $tagIds)
    {
        $this->where('kuliner_id', $kulinerId)->delete();
        foreach ($tagIds as $tagId) {
            $this->insert([
                'kuliner_id' => $kulinerId,
                'tag_id'     => $tagId,
            ]);
        }
    }
}
