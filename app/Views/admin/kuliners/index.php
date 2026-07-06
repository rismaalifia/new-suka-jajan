<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Kelola Kuliner</h3>
    <a href="/admin/kuliners/create" class="btn btn-primary"><i class="bi bi-plus"></i> Tambah Kuliner</a>
</div>

<ul class="nav nav-tabs mb-3">
    <li class="nav-item"><a class="nav-link <?= $status === 'all' ? 'active' : '' ?>" href="/admin/kuliners?status=all">Semua</a></li>
    <li class="nav-item"><a class="nav-link <?= $status === 'pending' ? 'active' : '' ?>" href="/admin/kuliners?status=pending">Pending</a></li>
    <li class="nav-item"><a class="nav-link <?= $status === 'approved' ? 'active' : '' ?>" href="/admin/kuliners?status=approved">Approved</a></li>
    <li class="nav-item"><a class="nav-link <?= $status === 'rejected' ? 'active' : '' ?>" href="/admin/kuliners?status=rejected">Rejected</a></li>
</ul>

<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-hover">
            <thead><tr><th>#</th><th>Nama</th><th>Kategori</th><th>Submitter</th><th>Rating</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
            <?php foreach ($kuliners as $i => $k): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td>
                    <?= esc($k['nama']) ?>
                    <?php if ($k['is_closed']): ?><span class="badge bg-secondary">Tutup</span><?php endif; ?>
                </td>
                <td><span class="badge bg-primary"><?= esc($k['category_nama']) ?></span></td>
                <td><?= esc($k['submitter']) ?></td>
                <td><?= number_format($k['avg_rating'], 1) ?></td>
                <td>
                    <?php
                    $badgeClass = match($k['status']) {
                        'approved' => 'bg-success',
                        'pending'  => 'bg-warning text-dark',
                        'rejected' => 'bg-danger',
                        default    => 'bg-secondary',
                    };
                    ?>
                    <span class="badge <?= $badgeClass ?>"><?= ucfirst($k['status']) ?></span>
                </td>
                <td>
                    <div class="btn-group btn-group-sm">
                        <?php if ($k['status'] === 'pending'): ?>
                        <form action="/admin/kuliners/approve/<?= $k['id'] ?>" method="post" class="d-inline">
                            <?= csrf_field() ?>
                            <button class="btn btn-success" title="Approve"><i class="bi bi-check-lg"></i></button>
                        </form>
                        <form action="/admin/kuliners/reject/<?= $k['id'] ?>" method="post" class="d-inline">
                            <?= csrf_field() ?>
                            <button class="btn btn-danger" title="Reject"><i class="bi bi-x-lg"></i></button>
                        </form>
                        <?php endif; ?>
                        <a href="/admin/kuliners/edit/<?= $k['id'] ?>" class="btn btn-warning"><i class="bi bi-pencil"></i></a>
                        <form action="/admin/kuliners/delete/<?= $k['id'] ?>" method="post" class="d-inline"
                              onsubmit="return confirm('Hapus kuliner ini?')">
                            <?= csrf_field() ?>
                            <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
