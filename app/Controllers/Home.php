<?php

namespace App\Controllers;

use App\Models\KulinerModel;
use App\Models\CategoryModel;

class Home extends BaseController
{
    public function index()
    {
        $kulinerModel = new KulinerModel();
        $categoryModel = new CategoryModel();

        $topRated = $kulinerModel->getWithCategory()
            ->where('kuliners.status', 'approved')
            ->orderBy('avg_rating', 'DESC')
            ->findAll(8);

        $latest = $kulinerModel->getWithCategory()
            ->where('kuliners.status', 'approved')
            ->orderBy('kuliners.created_at', 'DESC')
            ->findAll(8);

        $categories = $categoryModel->findAll();

        return view('home', [
            'title'      => 'Beranda',
            'topRated'   => $topRated,
            'latest'     => $latest,
            'categories' => $categories,
        ]);
    }
}
