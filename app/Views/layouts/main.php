<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'SukaJajan' ?> - SukaJajan Semarang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --sj-cyan: #12BFE2;
            --sj-red: #EB2132;
            --sj-yellow: #F8CD0E;
            --sj-navy: #102C53;
            --sj-navy-light: #1a3d6e;
            --sj-cyan-soft: rgba(17, 191, 225, 0.1);
            --sj-red-soft: rgba(234, 33, 49, 0.08);
        }
        body {
            font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif;
            background: #ffffff;
            color: #333;
        }
        .navbar-sukajajan {
            background: var(--sj-navy);
            box-shadow: 0 2px 20px rgba(16, 44, 83, 0.15);
            padding: 12px 0;
        }
        .navbar-sukajajan .navbar-brand {
            color: #fff !important;
            font-weight: 800;
            letter-spacing: -0.5px;
        }
        .navbar-sukajajan .navbar-brand i { color: var(--sj-cyan); }
        .navbar-sukajajan .nav-link { color: rgba(255,255,255,0.85) !important; font-weight: 500; transition: color 0.2s; }
        .navbar-sukajajan .nav-link:hover { color: var(--sj-cyan) !important; }
        .navbar-sukajajan .navbar-toggler { border-color: rgba(255,255,255,0.3); }
        .navbar-sukajajan .navbar-toggler-icon { filter: invert(1); }

        .btn-sj {
            background: var(--sj-red);
            color: #fff;
            border: none;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.2s;
        }
        .btn-sj:hover { background: #d01a29; color: #fff; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(234,33,49,0.3); }
        .btn-sj-outline {
            border: 2px solid var(--sj-navy);
            color: var(--sj-navy);
            background: transparent;
            font-weight: 600;
            border-radius: 20px;
            transition: all 0.2s;
        }
        .btn-sj-outline:hover { background: var(--sj-navy); color: #fff; transform: translateY(-1px); }

        .card-kuliner {
            transition: all 0.3s ease;
            border: none;
            border-radius: 16px;
            box-shadow: 0 2px 15px rgba(16, 44, 83, 0.06);
            overflow: hidden;
            background: #fff;
        }
        .card-kuliner:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 30px rgba(16, 44, 83, 0.12);
        }
        .card-kuliner .card-body { padding: 1.2rem; }

        .rating-stars { color: var(--sj-yellow); }
        .badge-category {
            background: var(--sj-cyan);
            color: #fff;
            font-weight: 600;
            border-radius: 6px;
            padding: 4px 10px;
            font-size: 0.75rem;
        }
        .badge-tag {
            background: var(--sj-navy);
            color: #fff;
            font-weight: 500;
            border-radius: 6px;
            padding: 4px 10px;
        }

        .hero-section {
            background: linear-gradient(135deg, var(--sj-navy) 0%, var(--sj-navy-light) 50%, var(--sj-cyan) 100%);
            color: white;
            padding: 100px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(17,191,225,0.2) 0%, transparent 70%);
            border-radius: 50%;
        }
        .hero-section::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(248,205,14,0.15) 0%, transparent 70%);
            border-radius: 50%;
        }
        .hero-section .container { position: relative; z-index: 1; }
        .hero-section h1 { font-weight: 800; letter-spacing: -1px; }
        .hero-section p { opacity: 0.9; font-size: 1.15rem; }

        footer {
            background: var(--sj-navy);
            color: rgba(255,255,255,0.8);
            padding: 40px 0;
            margin-top: 60px;
        }
        footer p { font-weight: 600; color: #fff; }
        footer small { color: rgba(255,255,255,0.5); }

        .star-input { cursor: pointer; font-size: 1.5rem; color: #ddd; transition: color 0.15s; }
        .star-input.active, .star-input:hover { color: var(--sj-yellow); }

        #map { height: 400px; border-radius: 12px; border: 2px solid rgba(17,191,225,0.2); }
        .foto-thumb {
            width: 100px; height: 100px;
            object-fit: cover;
            border-radius: 10px;
            cursor: pointer;
            border: 2px solid transparent;
            transition: border-color 0.2s;
        }
        .foto-thumb:hover { border-color: var(--sj-cyan); }

        .card { border-radius: 14px; border: none; }
        .form-control:focus, .form-select:focus {
            border-color: var(--sj-cyan);
            box-shadow: 0 0 0 3px rgba(17, 191, 225, 0.15);
        }
        a { color: var(--sj-cyan); }
        a:hover { color: var(--sj-navy); }

        .alert-success { background: rgba(17,191,225,0.1); border-color: var(--sj-cyan); color: var(--sj-navy); }
        .alert-danger { background: var(--sj-red-soft); border-color: var(--sj-red); color: var(--sj-navy); }

        .breadcrumb-item a { color: var(--sj-cyan); font-weight: 500; }
        .breadcrumb-item.active { color: var(--sj-navy); }

        h3, h4, h5 { color: var(--sj-navy); font-weight: 700; }

        .dropdown-menu { border-radius: 12px; border: none; box-shadow: 0 8px 30px rgba(16,44,83,0.12); }
        .dropdown-item:hover { background: var(--sj-cyan-soft); color: var(--sj-navy); }

        .pagination { display: flex; gap: 8px; list-style: none; padding: 0; justify-content: center; }
        .pagination li a {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 8px;
            background: #fff;
            color: var(--sj-navy);
            text-decoration: none;
            font-weight: 600;
            border: 2px solid #e0e0e0;
            transition: all 0.2s;
        }
        .pagination li a:hover { background: var(--sj-cyan-soft); border-color: var(--sj-cyan); color: var(--sj-cyan); }
        .pagination li.active a { background: var(--sj-cyan); color: #fff; border-color: var(--sj-cyan); }
    </style>
    <?= $this->renderSection('styles') ?>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-sukajajan sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="/">
                <i class="bi bi-geo-alt-fill"></i> SukaJajan
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/kuliner"><i class="bi bi-shop"></i> Jelajahi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/search"><i class="bi bi-search"></i> Cari</a>
                    </li>
                    <?php if (session()->get('logged_in')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/kuliner/submit"><i class="bi bi-plus-circle"></i> Tambah Tempat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/favorites"><i class="bi bi-heart"></i> Favorit</a>
                    </li>
                    <?php endif; ?>
                </ul>
                <ul class="navbar-nav">
                    <?php if (session()->get('logged_in')): ?>
                        <?php if (session()->get('role') === 'admin'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin"><i class="bi bi-speedometer2"></i> Dashboard</a>
                        </li>
                        <?php endif; ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle"></i> <?= esc(session()->get('username')) ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="/logout"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/login"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/register"><i class="bi bi-person-plus"></i> Register</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <?php if (session()->getFlashdata('success')): ?>
    <div class="container mt-3">
        <div class="alert alert-success alert-dismissible fade show">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
    <div class="container mt-3">
        <div class="alert alert-danger alert-dismissible fade show">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')): ?>
    <div class="container mt-3">
        <div class="alert alert-danger alert-dismissible fade show">
            <ul class="mb-0">
            <?php foreach (session()->getFlashdata('errors') as $err): ?>
                <li><?= esc($err) ?></li>
            <?php endforeach; ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
    <?php endif; ?>

    <?= $this->renderSection('content') ?>

    <footer>
        <div class="container text-center">
            <p class="mb-1 fw-bold"><i class="bi bi-geo-alt-fill"></i> SukaJajan - Platform Kuliner Semarang</p>
            <small>Powered by CodeIgniter 4, Leaflet.js & OpenStreetMap Nominatim</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>
