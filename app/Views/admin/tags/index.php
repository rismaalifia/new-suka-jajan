<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Kelola Tags</h3>
    <a href="/admin/tags/create" class="btn btn-primary"><i class="bi bi-plus"></i> Tambah Tag</a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead><tr><th>#</th><th>Nama</th><th>Slug</th><th>Aksi</th></tr></thead>
            <tbody>
            <?php foreach ($tags as $i => $tag): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= esc($tag['nama']) ?></td>
                <td><code><?= esc($tag['slug']) ?></code></td>
                <td>
                    <a href="/admin/tags/edit/<?= $tag['id'] ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                    <form action="/admin/tags/delete/<?= $tag['id'] ?>" method="post" class="d-inline"
                          onsubmit="return confirm('Hapus tag ini?')">
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
