<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'slug'];

    protected $validationRules = [
        'nama' => 'required|max_length[100]',
        'slug' => 'required|max_length[100]|is_unique[categories.slug,id,{id}]',
    ];
}
