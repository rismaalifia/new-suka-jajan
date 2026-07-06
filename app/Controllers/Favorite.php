<?php

namespace App\Controllers;

use App\Models\FavoriteModel;

class Favorite extends BaseController
{
    public function index()
    {
        $favoriteModel = new FavoriteModel();
        $favorites = $favoriteModel->getUserFavorites(session()->get('user_id'));

        return view('favorites/index', [
            'title'     => 'Tempat Favorit Saya',
            'favorites' => $favorites,
        ]);
    }

    public function toggle($kulinerId)
    {
        $favoriteModel = new FavoriteModel();
        $added = $favoriteModel->toggleFavorite(session()->get('user_id'), $kulinerId);

        $message = $added ? 'Ditambahkan ke favorit!' : 'Dihapus dari favorit.';
        return redirect()->back()->with('success', $message);
    }
}
