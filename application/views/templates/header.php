<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="icon" href="bola.ico" type="image/x-icon">

    <style>
        .is-invalid {
            border-color: #dc3545 !important;
            /* Red border */
        }

        .error-message,
        .error-messagedua,
        .error-messagetiga {
            color: red;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <!-- Logo -->
            <img src="<?= base_url('assets/logo.png') ?>" alt="" width="30px">
            <!-- Tombol toggle untuk tampilan responsif pada perangkat mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Daftar tombol di navbar -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $judul == "Home" ? 'active' : '' ?>" href="<?= base_url() ?>">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php echo $judul == "Klub" ? 'active' : '' ?>" href="<?= base_url('klub') ?>">Klub</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $judul == "Skor Pertandingan" ? 'active' : '' ?>" href="<?= base_url('pertandingan') ?>">Skor</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $judul == "Klasemen" ? 'active' : '' ?>" href="<?= base_url('klasemen') ?>">Klasemen</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>