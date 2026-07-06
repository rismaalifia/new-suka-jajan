<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KulinerModel;
use App\Models\CategoryModel;
use App\Models\TagModel;
use App\Models\KulinerTagModel;

class Kuliner extends BaseController
{
    public function index()
    {
        $model = new KulinerModel();
        $status = $this->request->getGet('status') ?? 'all';

        $builder = $model->getWithCategory()
            ->join('users', 'users.id = kuliners.user_id')
            ->select('users.username as submitter');

        if ($status !== 'all') {
            $builder->where('kuliners.status', $status);
        }

        $kuliners = $builder->orderBy('kuliners.created_at', 'DESC')->findAll();

        return view('admin/kuliners/index', [
            'title'    => 'Kelola Kuliner',
            'kuliners' => $kuliners,
            'status'   => $status,
        ]);
    }

    public function create()
    {
        $categoryModel = new CategoryModel();
        $tagModel = new TagModel();

        return view('admin/kuliners/form', [
            'title'      => 'Tambah Kuliner',
            'kuliner'    => null,
            'categories' => $categoryModel->findAll(),
            'tags'       => $tagModel->findAll(),
            'selectedTags' => [],
        ]);
    }

    public function store()
    {
        $model = new KulinerModel();
        $nama = $this->request->getPost('nama');
        $slug = url_title($nama, '-', true);

        if ($model->where('slug', $slug)->first()) {
            $slug .= '-' . time();
        }

        $fotoUtama = null;
        $foto = $this->request->getFile('foto_utama');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $newName = $foto->getRandomName();
            $foto->move(FCPATH . 'uploads/kuliner', $newName);

            $image = \Config\Services::image();
            $image->withFile(FCPATH . 'uploads/kuliner/' . $newName)
                  ->resize(800, 600, true, 'width')
                  ->save(FCPATH . 'uploads/kuliner/' . $newName);
            $image->withFile(FCPATH . 'uploads/kuliner/' . $newName)
                  ->resize(300, 200, true, 'width')
                  ->save(FCPATH . 'uploads/thumbnails/' . $newName);
            $fotoUtama = $newName;
        }

        $kulinerId = $model->insert([
            'user_id'     => session()->get('user_id'),
            'category_id' => $this->request->getPost('category_id'),
            'nama'        => $nama,
            'slug'        => $slug,
            'alamat'      => $this->request->getPost('alamat'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'latitude'    => $this->request->getPost('latitude') ?: null,
            'longitude'   => $this->request->getPost('longitude') ?: null,
            'foto_utama'  => $fotoUtama,
            'status'      => 'approved',
        ]);

        $tags = $this->request->getPost('tags') ?? [];
        if (!empty($tags)) {
            $kulinerTagModel = new KulinerTagModel();
            $kulinerTagModel->syncTags($kulinerId, $tags);
        }

        return redirect()->to('/admin/kuliners')->with('success', 'Kuliner berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $model = new KulinerModel();
        $kuliner = $model->find($id);
        if (!$kuliner) {
            return redirect()->to('/admin/kuliners')->with('error', 'Kuliner tidak ditemukan.');
        }

        $categoryModel = new CategoryModel();
        $tagModel = new TagModel();
        $kulinerTagModel = new KulinerTagModel();

        $selectedTags = array_column($kulinerTagModel->where('kuliner_id', $id)->findAll(), 'tag_id');

        return view('admin/kuliners/form', [
            'title'        => 'Edit Kuliner',
            'kuliner'      => $kuliner,
            'categories'   => $categoryModel->findAll(),
            'tags'         => $tagModel->findAll(),
            'selectedTags' => $selectedTags,
        ]);
    }

    public function update($id)
    {
        $model = new KulinerModel();
        $data = [
            'category_id' => $this->request->getPost('category_id'),
            'nama'        => $this->request->getPost('nama'),
            'alamat'      => $this->request->getPost('alamat'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'latitude'    => $this->request->getPost('latitude') ?: null,
            'longitude'   => $this->request->getPost('longitude') ?: null,
        ];

        $foto = $this->request->getFile('foto_utama');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $newName = $foto->getRandomName();
            $foto->move(FCPATH . 'uploads/kuliner', $newName);

            $image = \Config\Services::image();
            $image->withFile(FCPATH . 'uploads/kuliner/' . $newName)
                  ->resize(800, 600, true, 'width')
                  ->save(FCPATH . 'uploads/kuliner/' . $newName);
            $image->withFile(FCPATH . 'uploads/kuliner/' . $newName)
                  ->resize(300, 200, true, 'width')
                  ->save(FCPATH . 'uploads/thumbnails/' . $newName);
            $data['foto_utama'] = $newName;
        }

        $model->update($id, $data);

        $tags = $this->request->getPost('tags') ?? [];
        $kulinerTagModel = new KulinerTagModel();
        $kulinerTagModel->syncTags($id, $tags);

        return redirect()->to('/admin/kuliners')->with('success', 'Kuliner berhasil diupdate.');
    }

    public function delete($id)
    {
        $model = new KulinerModel();
        $model->delete($id);
        return redirect()->to('/admin/kuliners')->with('success', 'Kuliner berhasil dihapus.');
    }

    public function approve($id)
    {
        $model = new KulinerModel();
        $model->update($id, ['status' => 'approved']);
        return redirect()->back()->with('success', 'Kuliner berhasil diapprove.');
    }

    public function reject($id)
    {
        $model = new KulinerModel();
        $model->update($id, ['status' => 'rejected']);
        return redirect()->back()->with('success', 'Kuliner berhasil direject.');
    }
}
