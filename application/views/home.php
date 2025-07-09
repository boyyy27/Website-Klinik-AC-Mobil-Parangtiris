<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Parangtritis Klinik AC Mobil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }

        .navbar {
            background-color: #d50000;
        }

        .navbar-nav .nav-link {
            color: #fff !important;
        }

        .navbar-nav .nav-link.btn-outline-light {
            color: #d50000 !important;
            background-color: #fff !important;
            border-color: #fff !important;
        }

        .navbar-nav .nav-link.btn-outline-light:hover {
            color: #fff !important;
            background-color: #d50000 !important;
            border-color: #d50000 !important;
        }

        .header {
            background-color: #d50000;
            color: #fff;
            text-align: center;
            padding: 50px 0;
        }

        .header img {
            max-width: 100%;
        }

        .header h1 {
            color: #d50000;
            text-shadow: -1px -1px 0 #fff, 1px -1px 0 #fff, -1px 1px 0 #fff, 1px 1px 0 #fff;
        }

        .extrabold {
            font-weight: 800;
        }

        .brands {
            background-color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        .brands img {
            max-height: 120px;
            margin: 30px 20px;
        }

        .services {
            background: url('<?php echo base_url("assets/img/background-layanan.png") ?>');
            background-size: cover;
            background-position: center;
            padding: 50px 0;
            color: #B00B0B;
        }

        .services .card {
            background-color: rgba(255, 255, 255, 0.8);
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            flex-direction: row;
            padding: 20px;
            margin-bottom: 20px;
            min-height: 250px;
        }

        .services .card img {
            border-radius: 15px;
            max-width: 150px;
            margin-right: 15px;
        }

        .services .card .card-body {
            flex: 1;
            padding: 15px;
            color: #B00B0B;
        }

        .services .card-title,
        .services .card-text {
            color: #B00B0B;
            text-align: justify;
        }

        .about {
            padding: 50px 0;
        }

        .about h2 {
            color: #B00B0B;
        }

        .about p {
            color: #4D4D4D;
        }

        .about .card img {
            border-radius: 15px;
        }

        .footer {
            background-color: #d50000;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }

        .footer p {
            margin: 0;
        }

        .footer .contact-info {
            margin-top: 10px;
        }

        .footer .contact-info a {
            color: #fff;
            text-decoration: none;
            margin-right: 15px;
        }

        .footer .contact-info a:hover {
            text-decoration: underline;
        }

        .footer .social-icons a {
            color: #fff;
            margin: 0 10px;
            font-size: 1.5em;
        }

        .footer .social-icons a:hover {
            color: #ccc;
        }

        .navbar .dropdown-menu {
            background-color: #d50000;
            border: none;
            width: 150px;
        }

        .navbar .dropdown-menu .dropdown-item {
            color: white;
        }

        .navbar .dropdown-menu .dropdown-item:hover {
            background-color: #d40000;
        }

        .navbar .nav-link.dropdown-toggle {
            background-color: transparent;
            color: white;
            border: none;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#" style="color: white;">PARANGTRITIS KLINIK AC MOBIL</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Layanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Tentang</a>
                </li>
                <?php if ($this->session->userdata('logged_in')) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php
                            if (isset($user['Nama'])) {
                                echo $user['Nama'];
                            } else {
                                $username = $this->session->userdata('username');
                                echo $username ? $username : 'Nama tidak tersedia';
                            }
                            ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo site_url('user'); ?>">Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?php echo site_url('auth/logout'); ?>">Logout</a>
                        </div>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('auth/login'); ?>">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <header class="header">
        <div class="container">
            <h1 class="extrabold">SPESIALIS SERVIS AC MOBIL <br>SERVIS MESIN RINGAN</h1>
            <img src="<?php echo base_url("assets/img/mobil.png") ?>" alt="Mobil">
        </div>
    </header>

    <section class="brands">
        <div class="container">
            <img src="<?php echo base_url("assets/img/logo-mobil.png") ?>" alt="Logo Mobil">
        </div>
    </section>

    <section class="services">
        <div class="container">
            <div class="row text-center mb-4">
                <div class="col">
                    <h2>Layanan Kami</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card flex-row align-items-center">
                        <img src="<?php echo base_url("assets/img/AC.png") ?>" alt="Servis AC Mobil">
                        <div class="card-body">
                            <h5 class="card-title">Servis AC Mobil</h5>
                            <p class="card-text">Servis AC mobil adalah perawatan dan perbaikan sistem pendingin udara (AC) kendaraan, isi ulang freon, termasuk pemeriksaan kebocoran dan penggantian filter kabin untuk kenyamanan pengemudi dan penumpang.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card flex-row align-items-center">
                        <img src="<?php echo base_url("assets/img/tune-up.png") ?>" alt="Tune Up">
                        <div class="card-body">
                            <h5 class="card-title">Tune Up</h5>
                            <p class="card-text">Tune up mobil adalah pemeriksaan dan perawatan rutin untuk menjaga kinerja optimal mesin dan komponen terkait. Ini meliputi pembersihan, penggantian, dan penyesuaian komponen mesin.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card flex-row align-items-center">
                        <img src="<?php echo base_url("assets/img/Oli.png") ?>" alt="Ganti Oli">
                        <div class="card-body">
                            <h5 class="card-title">Ganti Oli</h5>
                            <p class="card-text">Ganti oli mobil adalah mengganti oli lama dengan yang baru untuk kinerja optimal mesin. Oli melumasi, mendinginkan, dan membersihkan komponen mesin, sehingga menjaga performa mesin lebih optimal.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card flex-row align-items-center">
                        <img src="<?php echo base_url("assets/img/servis-mesin.png") ?>" alt="Servis Mesin Ringan">
                        <div class="card-body">
                            <h5 class="card-title">Servis Mesin Ringan</h5>
                            <p class="card-text">Servis mesin ringan adalah pemeriksaan dan perawatan rutin pada bagian utama mesin kendaraan untuk kinerja optimal. Ini mencakup pemeriksaan oli, pembersihan filter udara, dan penyetelan komponen mesin.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about">
        <div class="container">
            <div class="row text-center mb-4">
                <div class="col">
                    <h2>Tentang Kami</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <img src=" <?php echo base_url("assets/img/gambar-truk.png") ?>" class="img-fluid" alt="Tentang Kami">
                </div>
                <div class="col-md-6">
                    <p>Parangtritis Klinik AC Mobil adalah penyedia layanan servis AC mobil yang berkomitmen untuk memberikan kenyamanan berkendara terbaik bagi Anda. Dengan pengalaman bertahun-tahun dalam industri otomotif, kami menawarkan layanan perawatan dan perbaikan AC mobil yang menyeluruh dan profesional. Tim teknisi kami yang berpengalaman menggunakan peralatan modern untuk memastikan sistem pendingin mobil Anda selalu dalam kondisi prima.</p>
                    <p>Layanan kami mencakup diagnosa sistem AC untuk mendeteksi masalah, pengisian ulang refrigerant sesuai spesifikasi pabrik, pembersihan komponen seperti kondensor dan evaporator, serta pemeriksaan kebocoran menggunakan teknologi canggih. Kami juga mengganti filter kabin untuk menjaga udara dalam mobil tetap bersih dan melakukan pengujian kinerja untuk memastikan AC berfungsi optimal.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <p><strong>PARANGTRITIS KLINIK AC MOBIL</strong></p>
                </div>
                <div class="col-md-4">
                    <p>&copy; 2024 Parangtritis Bengkel AC Mobil</p>
                </div>
                <div class="col-md-4 text-right contact-info">
                    <p><a href="tel:+628176671181"><i class="fas fa-phone"></i> 0817-6671-181</a></p>
                    <p><a href="https://goo.gl/maps/8L5Y2JPdsFQ2"><i class="fas fa-map-marker-alt"></i> Jl. Mekar Sari No.45, RT.006/RW.003, Bekasi Jaya, Kec. Bekasi Timur, Kota Bekasi, Jawa Barat 17112</a></p>
                </div>
            </div>
            <div class="row social-icons">
                <div class="col text-center">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>

</html>