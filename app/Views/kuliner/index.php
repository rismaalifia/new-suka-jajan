<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container py-4">
    <h3 class="mb-4 fw-bold"><i class="bi bi-shop"></i> Jelajahi Kuliner Semarang</h3>

    <div class="row">
        <div class="col-md-3">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h6 class="fw-bold text-uppercase">Filter</h6>
                    <form method="get" action="/kuliner">
                        <div class="mb-3">
                            <label class="form-label small">Kategori</label>
                            <select name="category" class="form-select form-select-sm">
                                <option value="">Semua</option>
                                <?php foreach ($categories as $cat): ?>
                                <option value="<?= esc($cat['slug']) ?>" <?= ($this->request ?? service('request'))->getGet('category') == $cat['slug'] ? 'selected' : '' ?>>
                                    <?= esc($cat['nama']) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Tag</label>
                            <select name="tag" class="form-select form-select-sm">
                                <option value="">Semua</option>
                                <?php foreach ($tags as $tag): ?>
                                <option value="<?= esc($tag['slug']) ?>" <?= ($this->request ?? service('request'))->getGet('tag') == $tag['slug'] ? 'selected' : '' ?>>
                                    <?= esc($tag['nama']) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Rating Minimal</label>
                            <select name="rating" class="form-select form-select-sm">
                                <option value="">Semua</option>
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                <option value="<?= $i ?>" <?= ($this->request ?? service('request'))->getGet('rating') == $i ? 'selected' : '' ?>>
                                    <?= $i ?>+ Bintang
                                </option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Urutkan</label>
                            <select name="sort" class="form-select form-select-sm">
                                <option value="latest" <?= ($this->request ?? service('request'))->getGet('sort') == 'latest' ? 'selected' : '' ?>>Terbaru</option>
                                <option value="rating" <?= ($this->request ?? service('request'))->getGet('sort') == 'rating' ? 'selected' : '' ?>>Rating Tertinggi</option>
                            </select>
                        </div>
                        <hr class="my-2">
                        <div class="mb-3">
                            <label class="form-label small">Jarak</label>
                            <button type="button" id="btn-geolocation" class="btn btn-sm w-100 mb-2" style="background-color: var(--sj-cyan); color: #fff; border: none;">
                                <i class="bi bi-geo-alt-fill"></i> Gunakan Lokasi Saya
                            </button>
                            <div id="geolocation-status" class="small text-muted mb-2" style="display:none;"></div>
                            <select name="radius" id="radius-select" class="form-select form-select-sm" <?= ($this->request ?? service('request'))->getGet('lat') ? '' : 'disabled' ?>>
                                <option value="1" <?= ($this->request ?? service('request'))->getGet('radius') == '1' ? 'selected' : '' ?>>1 km</option>
                                <option value="2" <?= ($this->request ?? service('request'))->getGet('radius') == '2' ? 'selected' : '' ?>>2 km</option>
                                <option value="5" <?= (($this->request ?? service('request'))->getGet('radius') == '5' || !($this->request ?? service('request'))->getGet('radius')) ? 'selected' : '' ?>>5 km</option>
                                <option value="10" <?= ($this->request ?? service('request'))->getGet('radius') == '10' ? 'selected' : '' ?>>10 km</option>
                            </select>
                            <input type="hidden" name="lat" id="input-lat" value="<?= esc(($this->request ?? service('request'))->getGet('lat') ?? '') ?>">
                            <input type="hidden" name="lng" id="input-lng" value="<?= esc(($this->request ?? service('request'))->getGet('lng') ?? '') ?>">
                        </div>
                        <button type="submit" class="btn btn-sj btn-sm w-100">
                            <i class="bi bi-funnel"></i> Terapkan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <?php if (empty($kuliners)): ?>
                <div class="alert alert-info">Belum ada data kuliner.</div>
            <?php else: ?>
            <div class="row g-3">
                <?php foreach ($kuliners as $k): ?>
                <div class="col-md-4">
                    <div class="card card-kuliner h-100">
                        <img src="<?= $k['foto_utama'] ? '/uploads/thumbnails/' . esc($k['foto_utama']) : 'https://via.placeholder.com/300x200?text=No+Image' ?>"
                             class="card-img-top" style="height: 160px; object-fit: cover;">
                        <div class="card-body">
                            <span class="badge badge-category mb-1"><?= esc($k['category_nama']) ?></span>
                            <?php if (!empty($k['is_closed'])): ?>
                                <span class="badge bg-secondary">Tutup Permanen</span>
                            <?php endif; ?>
                            <h6 class="card-title mt-1"><?= esc($k['nama']) ?></h6>
                            <p class="text-muted small mb-1"><i class="bi bi-geo-alt"></i> <?= esc(substr($k['alamat'], 0, 50)) ?>...</p>
                            <div class="rating-stars">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class="bi bi-star<?= $i <= round($k['avg_rating']) ? '-fill' : '' ?>"></i>
                                <?php endfor; ?>
                                <small class="text-muted">(<?= $k['total_reviews'] ?>)</small>
                            </div>
                            <a href="/kuliner/<?= esc($k['slug']) ?>" class="btn btn-sm btn-sj mt-2 w-100">Detail</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="mt-4">
                <?= $pager->links() ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var btnGeo = document.getElementById('btn-geolocation');
    var inputLat = document.getElementById('input-lat');
    var inputLng = document.getElementById('input-lng');
    var radiusSelect = document.getElementById('radius-select');
    var geoStatus = document.getElementById('geolocation-status');

    // If lat/lng already set from previous request, show active state
    if (inputLat.value && inputLng.value) {
        btnGeo.innerHTML = '<i class="bi bi-geo-alt-fill"></i> Lokasi Aktif';
        btnGeo.style.opacity = '0.85';
        geoStatus.style.display = 'block';
        geoStatus.textContent = 'Lokasi terdeteksi. Klik lagi untuk memperbarui.';
    }

    btnGeo.addEventListener('click', function() {
        if (!navigator.geolocation) {
            geoStatus.style.display = 'block';
            geoStatus.textContent = 'Browser tidak mendukung geolokasi.';
            geoStatus.className = 'small text-danger mb-2';
            return;
        }

        btnGeo.disabled = true;
        btnGeo.innerHTML = '<i class="bi bi-arrow-repeat"></i> Mencari lokasi...';
        geoStatus.style.display = 'block';
        geoStatus.textContent = 'Mengambil lokasi...';
        geoStatus.className = 'small text-muted mb-2';

        navigator.geolocation.getCurrentPosition(
            function(position) {
                inputLat.value = position.coords.latitude;
                inputLng.value = position.coords.longitude;
                radiusSelect.disabled = false;

                btnGeo.disabled = false;
                btnGeo.innerHTML = '<i class="bi bi-geo-alt-fill"></i> Lokasi Aktif';
                geoStatus.textContent = 'Lokasi berhasil diambil!';
                geoStatus.className = 'small text-success mb-2';
            },
            function(error) {
                btnGeo.disabled = false;
                btnGeo.innerHTML = '<i class="bi bi-geo-alt-fill"></i> Gunakan Lokasi Saya';
                geoStatus.style.display = 'block';
                geoStatus.className = 'small text-danger mb-2';

                switch(error.code) {
                    case error.PERMISSION_DENIED:
                        geoStatus.textContent = 'Izin lokasi ditolak.';
                        break;
                    case error.POSITION_UNAVAILABLE:
                        geoStatus.textContent = 'Lokasi tidak tersedia.';
                        break;
                    case error.TIMEOUT:
                        geoStatus.textContent = 'Permintaan lokasi timeout.';
                        break;
                    default:
                        geoStatus.textContent = 'Gagal mendapatkan lokasi.';
                }
            },
            { enableHighAccuracy: true, timeout: 10000, maximumAge: 300000 }
        );
    });
});
</script>
<?= $this->endSection() ?>
