<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<h3 class="mb-4">Dashboard</h3>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card stat-card text-white" style="background: var(--sj-navy);">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6>Total Kuliner</h6>
                    <h2 class="mb-0" style="color:#fff;"><?= $totalKuliner ?></h2>
                </div>
                <i class="bi bi-shop stat-icon"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card text-dark" style="background: var(--sj-yellow);">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6>Menunggu Approval</h6>
                    <h2 class="mb-0"><?= $pendingKuliner ?></h2>
                </div>
                <i class="bi bi-hourglass-split stat-icon"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card text-white" style="background: var(--sj-cyan);">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6>Total Review</h6>
                    <h2 class="mb-0" style="color:#fff;"><?= $totalReviews ?></h2>
                </div>
                <i class="bi bi-chat-dots stat-icon"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card text-white" style="background: var(--sj-red);">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6>User Aktif</h6>
                    <h2 class="mb-0" style="color:#fff;"><?= $totalUsers ?></h2>
                </div>
                <i class="bi bi-people stat-icon"></i>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><h5 class="mb-0"><i class="bi bi-star-fill rating-stars"></i> Rating Tertinggi</h5></div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead><tr><th>Nama</th><th>Kategori</th><th>Rating</th></tr></thead>
                    <tbody>
                    <?php foreach ($topRated as $k): ?>
                    <tr>
                        <td><?= esc($k['nama']) ?></td>
                        <td><span class="badge" style="background: var(--sj-cyan);"><?= esc($k['category_nama']) ?></span></td>
                        <td>
                            <span class="rating-stars">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                <i class="bi bi-star<?= $i <= round($k['avg_rating']) ? '-fill' : '' ?>"></i>
                                <?php endfor; ?>
                            </span>
                            <?= number_format($k['avg_rating'], 1) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><h5 class="mb-0"><i class="bi bi-chat-dots"></i> Review Terbaru</h5></div>
            <div class="card-body">
                <?php foreach ($recentReviews as $r): ?>
                <div class="border-bottom pb-2 mb-2">
                    <strong><?= esc($r['username']) ?></strong> memberi
                    <span class="rating-stars"><?= $r['rating'] ?><i class="bi bi-star-fill"></i></span>
                    untuk <em><?= esc($r['kuliner_nama']) ?></em>
                    <br><small class="text-muted"><?= date('d M Y H:i', strtotime($r['created_at'])) ?></small>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
