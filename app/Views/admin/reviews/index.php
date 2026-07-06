<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<h3 class="mb-4">Moderasi Review</h3>

<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-hover">
            <thead><tr><th>#</th><th>User</th><th>Tempat</th><th>Rating</th><th>Komentar</th><th>Tanggal</th><th>Aksi</th></tr></thead>
            <tbody>
            <?php foreach ($reviews as $i => $r): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= esc($r['username']) ?></td>
                <td><?= esc($r['kuliner_nama']) ?></td>
                <td>
                    <span class="text-warning">
                    <?php for ($j = 1; $j <= 5; $j++): ?>
                        <i class="bi bi-star<?= $j <= $r['rating'] ? '-fill' : '' ?>"></i>
                    <?php endfor; ?>
                    </span>
                </td>
                <td><?= esc(substr($r['komentar'], 0, 80)) ?>...</td>
                <td><?= date('d M Y', strtotime($r['created_at'])) ?></td>
                <td>
                    <form action="/admin/reviews/delete/<?= $r['id'] ?>" method="post" class="d-inline"
                          onsubmit="return confirm('Hapus review ini?')">
                        <?= csrf_field() ?>
                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Hapus</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
