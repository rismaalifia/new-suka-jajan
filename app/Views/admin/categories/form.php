<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<h3 class="mb-4"><?= $category ? 'Edit' : 'Tambah' ?> Kategori</h3>

<div class="card" style="max-width: 500px;">
    <div class="card-body">
        <form action="<?= $category ? '/admin/categories/update/' . $category['id'] : '/admin/categories/store' ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label class="form-label">Nama Kategori</label>
                <input type="text" name="nama" class="form-control" value="<?= esc($category['nama'] ?? '') ?>" required>
            </div>
            <button type="submit" class="btn btn-primary"><i class="bi bi-check"></i> Simpan</button>
            <a href="/admin/categories" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
