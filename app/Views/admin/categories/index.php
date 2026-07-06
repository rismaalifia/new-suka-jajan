<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Kelola Kategori</h3>
    <a href="/admin/categories/create" class="btn btn-primary"><i class="bi bi-plus"></i> Tambah Kategori</a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead><tr><th>#</th><th>Nama</th><th>Slug</th><th>Aksi</th></tr></thead>
            <tbody>
            <?php foreach ($categories as $i => $cat): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= esc($cat['nama']) ?></td>
                <td><code><?= esc($cat['slug']) ?></code></td>
                <td>
                    <a href="/admin/categories/edit/<?= $cat['id'] ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                    <form action="/admin/categories/delete/<?= $cat['id'] ?>" method="post" class="d-inline"
                          onsubmit="return confirm('Hapus kategori ini?')">
                        <?= csrf_field() ?>
                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
