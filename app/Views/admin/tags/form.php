<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<h3 class="mb-4"><?= $tag ? 'Edit' : 'Tambah' ?> Tag</h3>

<div class="card" style="max-width: 500px;">
    <div class="card-body">
        <form action="<?= $tag ? '/admin/tags/update/' . $tag['id'] : '/admin/tags/store' ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label class="form-label">Nama Tag</label>
                <input type="text" name="nama" class="form-control" value="<?= esc($tag['nama'] ?? '') ?>" required>
            </div>
            <button type="submit" class="btn btn-primary"><i class="bi bi-check"></i> Simpan</button>
            <a href="/admin/tags" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
