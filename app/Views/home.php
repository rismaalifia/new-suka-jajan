<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="hero-section">
    <div class="container">
        <h1 class="display-4 fw-bold mb-3"><i class="bi bi-geo-alt-fill"></i> SukaJajan</h1>
        <p class="lead mb-4 fw-light">Temukan tempat makan & jajanan terbaik di Semarang!</p>
        <form action="/search" method="get" class="d-flex justify-content-center">
            <div class="input-group" style="max-width: 500px;">
                <input type="text" name="q" class="form-control form-control-lg" placeholder="Cari tempat makan...">
                <button class="btn btn-lg text-dark fw-bold" style="background: var(--sj-yellow);" type="submit"><i class="bi bi-search"></i></button>
            </div>
        </form>
    </div>
</div>

<div class="container py-5">
    <div class="mb-4">
        <h4><i class="bi bi-grid"></i> Kategori</h4>
        <div class="d-flex flex-wrap gap-2 mt-3">
            <?php foreach ($categories as $cat): ?>
            <a href="/kuliner?category=<?= esc($cat['slug']) ?>" class="btn btn-sj-outline rounded-pill">
                <?= esc($cat['nama']) ?>
            </a>
            <?php endforeach; ?>
        </div>
    </div>

    <hr>

    <h4 class="mb-3"><i class="bi bi-star-fill" style="color: var(--sj-yellow);"></i> Rating Tertinggi</h4>
    <div class="row g-4 mb-5">
        <?php foreach ($topRated as $k): ?>
        <div class="col-md-3">
            <div class="card card-kuliner h-100">
                <img src="<?= $k['foto_utama'] ? '/uploads/thumbnails/' . esc($k['foto_utama']) : 'https://via.placeholder.com/300x200?text=No+Image' ?>"
                     class="card-img-top" style="height: 180px; object-fit: cover;">
                <div class="card-body">
                    <span class="badge badge-category mb-2"><?= esc($k['category_nama']) ?></span>
                    <h6 class="card-title"><?= esc($k['nama']) ?></h6>
                    <div class="rating-stars mb-1">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <i class="bi bi-star<?= $i <= round($k['avg_rating']) ? '-fill' : '' ?>"></i>
                        <?php endfor; ?>
                        <small class="text-muted">(<?= $k['total_reviews'] ?>)</small>
                    </div>
                    <a href="/kuliner/<?= esc($k['slug']) ?>" class="btn btn-sm btn-sj mt-2">Lihat Detail</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <h4 class="mb-3"><i class="bi bi-clock"></i> Baru Ditambahkan</h4>
    <div class="row g-4">
        <?php foreach ($latest as $k): ?>
        <div class="col-md-3">
            <div class="card card-kuliner h-100">
                <img src="<?= $k['foto_utama'] ? '/uploads/thumbnails/' . esc($k['foto_utama']) : 'https://via.placeholder.com/300x200?text=No+Image' ?>"
                     class="card-img-top" style="height: 180px; object-fit: cover;">
                <div class="card-body">
                    <span class="badge badge-category mb-2"><?= esc($k['category_nama']) ?></span>
                    <h6 class="card-title"><?= esc($k['nama']) ?></h6>
                    <div class="rating-stars mb-1">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <i class="bi bi-star<?= $i <= round($k['avg_rating']) ? '-fill' : '' ?>"></i>
                        <?php endfor; ?>
                        <small class="text-muted">(<?= $k['total_reviews'] ?>)</small>
                    </div>
                    <a href="/kuliner/<?= esc($k['slug']) ?>" class="btn btn-sm btn-sj mt-2">Lihat Detail</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?= $this->endSection() ?>
