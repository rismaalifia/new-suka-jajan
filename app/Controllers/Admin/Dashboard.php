<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KulinerModel;
use App\Models\ReviewModel;
use App\Models\UserModel;
use App\Models\CategoryModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $kulinerModel = new KulinerModel();
        $reviewModel = new ReviewModel();
        $userModel = new UserModel();
        $categoryModel = new CategoryModel();

        $totalKuliner = $kulinerModel->where('status', 'approved')->countAllResults(false);
        $pendingKuliner = $kulinerModel->where('status', 'pending')->countAllResults(false);
        $totalReviews = $reviewModel->countAllResults(false);
        $totalUsers = $userModel->where('role', 'contributor')->countAllResults(false);

        $topRated = $kulinerModel->getWithCategory()
            ->where('kuliners.status', 'approved')
            ->orderBy('avg_rating', 'DESC')
            ->findAll(5);

        $recentReviews = $reviewModel->select('reviews.*, users.username, kuliners.nama as kuliner_nama')
            ->join('users', 'users.id = reviews.user_id')
            ->join('kuliners', 'kuliners.id = reviews.kuliner_id')
            ->orderBy('reviews.created_at', 'DESC')
            ->findAll(5);

        return view('admin/dashboard', [
            'title'          => 'Dashboard',
            'totalKuliner'   => $totalKuliner,
            'pendingKuliner' => $pendingKuliner,
            'totalReviews'   => $totalReviews,
            'totalUsers'     => $totalUsers,
            'topRated'       => $topRated,
            'recentReviews'  => $recentReviews,
        ]);
    }
}
