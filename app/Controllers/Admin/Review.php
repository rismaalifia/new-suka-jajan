<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ReviewModel;
use App\Models\KulinerModel;

class Review extends BaseController
{
    public function index()
    {
        $model = new ReviewModel();
        $reviews = $model->select('reviews.*, users.username, kuliners.nama as kuliner_nama')
            ->join('users', 'users.id = reviews.user_id')
            ->join('kuliners', 'kuliners.id = reviews.kuliner_id')
            ->orderBy('reviews.created_at', 'DESC')
            ->findAll();

        return view('admin/reviews/index', [
            'title'   => 'Moderasi Review',
            'reviews' => $reviews,
        ]);
    }

    public function delete($id)
    {
        $model = new ReviewModel();
        $review = $model->find($id);

        if ($review) {
            $model->delete($id);
            $kulinerModel = new KulinerModel();
            $kulinerModel->updateRating($review['kuliner_id']);
        }

        return redirect()->to('/admin/reviews')->with('success', 'Review berhasil dihapus.');
    }
}
