<?php

namespace App\Controllers;

use App\Models\ReviewModel;
use App\Models\KulinerModel;

class Review extends BaseController
{
    public function store()
    {
        $rules = [
            'kuliner_id' => 'required|integer',
            'rating'     => 'required|integer|greater_than[0]|less_than[6]',
            'komentar'   => 'required|min_length[10]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
        }

        $reviewModel = new ReviewModel();
        $kulinerId = $this->request->getPost('kuliner_id');

        $existing = $reviewModel->where([
            'kuliner_id' => $kulinerId,
            'user_id'    => session()->get('user_id'),
        ])->first();

        if ($existing) {
            return redirect()->back()->with('error', 'Anda sudah memberikan review untuk tempat ini.');
        }

        $reviewModel->insert([
            'kuliner_id' => $kulinerId,
            'user_id'    => session()->get('user_id'),
            'rating'     => $this->request->getPost('rating'),
            'komentar'   => $this->request->getPost('komentar'),
        ]);

        $kulinerModel = new KulinerModel();
        $kulinerModel->updateRating($kulinerId);

        return redirect()->back()->with('success', 'Review berhasil ditambahkan!');
    }

    public function update($id)
    {
        $reviewModel = new ReviewModel();

        if (!$reviewModel->canEdit($id, session()->get('user_id'))) {
            return redirect()->back()->with('error', 'Anda tidak bisa mengedit review ini (batas 24 jam).');
        }

        $rules = [
            'rating'   => 'required|integer|greater_than[0]|less_than[6]',
            'komentar' => 'required|min_length[10]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
        }

        $review = $reviewModel->find($id);
        $reviewModel->update($id, [
            'rating'   => $this->request->getPost('rating'),
            'komentar' => $this->request->getPost('komentar'),
        ]);

        $kulinerModel = new KulinerModel();
        $kulinerModel->updateRating($review['kuliner_id']);

        return redirect()->back()->with('success', 'Review berhasil diupdate!');
    }
}
