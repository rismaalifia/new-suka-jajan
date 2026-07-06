<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container py-4">
    <h3 class="mb-4"><i class="bi bi-heart-fill" style="color: var(--sj-red);"></i> Tempat Favorit Saya</h3>

    <?php if (empty($favorites)): ?>
    <div class="alert alert-info">Belum ada tempat favorit. <a href="/kuliner">Jelajahi kuliner</a> dan simpan yang Anda suka!</div>
    <?php else: ?>
    <div class="row g-3">
        <?php foreach ($favorites as $f): ?>
        <div class="col-md-4">
            <div class="card card-kuliner h-100">
                <img src="<?= $f['foto_utama'] ? '/uploads/thumbnails/' . esc($f['foto_utama']) : 'https://via.placeholder.com/300x200?text=No+Image' ?>"
                     class="card-img-top" style="height: 160px; object-fit: cover;">
                <div class="card-body">
                    <span class="badge badge-category mb-1"><?= esc($f['category_nama']) ?></span>
                    <h6 class="card-title mt-1"><?= esc($f['nama']) ?></h6>
                    <div class="rating-stars">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <i class="bi bi-star<?= $i <= round($f['avg_rating']) ? '-fill' : '' ?>"></i>
                        <?php endfor; ?>
                    </div>
                    <div class="d-flex gap-2 mt-2">
                        <a href="/kuliner/<?= esc($f['slug']) ?>" class="btn btn-sm btn-sj flex-fill">Detail</a>
                        <form action="/favorite/toggle/<?= $f['kuliner_id'] ?>" method="post" class="d-inline">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-heart-fill"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>
