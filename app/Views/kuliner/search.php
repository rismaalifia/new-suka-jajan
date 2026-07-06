<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container py-4">
    <h3 class="mb-4"><i class="bi bi-search"></i> Cari Kuliner</h3>

    <form action="/search" method="get" class="mb-4">
        <div class="input-group" style="max-width: 500px;">
            <input type="text" name="q" class="form-control" value="<?= esc($keyword) ?>" placeholder="Cari nama atau alamat...">
            <button class="btn btn-sj" type="submit"><i class="bi bi-search"></i> Cari</button>
        </div>
    </form>

    <?php if ($keyword): ?>
    <p class="text-muted">Menampilkan hasil untuk: <strong>"<?= esc($keyword) ?>"</strong> (<?= count($kuliners) ?> ditemukan)</p>
    <?php endif; ?>

    <?php if (!empty($kuliners)): ?>
    <div class="row g-3">
        <?php foreach ($kuliners as $k): ?>
        <div class="col-md-4">
            <div class="card card-kuliner h-100">
                <img src="<?= $k['foto_utama'] ? '/uploads/thumbnails/' . esc($k['foto_utama']) : 'https://via.placeholder.com/300x200?text=No+Image' ?>"
                     class="card-img-top" style="height: 160px; object-fit: cover;">
                <div class="card-body">
                    <span class="badge badge-category mb-1"><?= esc($k['category_nama']) ?></span>
                    <h6 class="card-title mt-1"><?= esc($k['nama']) ?></h6>
                    <p class="text-muted small"><i class="bi bi-geo-alt"></i> <?= esc(substr($k['alamat'], 0, 60)) ?></p>
                    <div class="rating-stars">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <i class="bi bi-star<?= $i <= round($k['avg_rating']) ? '-fill' : '' ?>"></i>
                        <?php endfor; ?>
                    </div>
                    <a href="/kuliner/<?= esc($k['slug']) ?>" class="btn btn-sm btn-sj mt-2 w-100">Detail</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php elseif ($keyword): ?>
    <div class="alert alert-info">Tidak ditemukan hasil untuk "<?= esc($keyword) ?>".</div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>
