<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f8f9fa;
        }

        .profile-card {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.2s ease-in-out;
        }

        .profile-card:hover {
            transform: translateY(-5px);
        }

        .profile-card img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            margin-bottom: 15px;
        }

        .profile-card .btn-secondary {
            width: 100%;
            margin-top: 10px;
            font-size: 18px;
            transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out;
        }

        .profile-card .btn-secondary:hover {
            background-color: #B00B0B;
            color: white;
        }

        .form-section {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
        }

        .form-section:hover {
            transform: translateY(-5px);
        }

        .form-section .btn-primary {
            background-color: #B00B0B;
            color: white;
            width: 100%;
            margin-top: 20px;
            font-size: 18px;
            transition: background-color 0.2s ease-in-out;
        }

        .form-section .btn-primary:hover {
            background-color: #900909;
        }

        .form-section .btn-secondary {
            background-color: white;
            color: #B00B0B;
            border: 1px solid #B00B0B;
            width: 100%;
            margin-top: 20px;
            font-size: 18px;
            transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out;
        }

        .form-section .btn-secondary:hover {
            background-color: #B00B0B;
            color: white;
        }

        .btn-back {
            background-color: transparent;
            color: #B00B0B;
            border: none;
            font-size: 18px;
            transition: color 0.2s ease-in-out;
        }

        .btn-back:hover {
            color: #900909;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row mb-3">
            <div class="col-12">
                <button class="btn-back" onclick="window.location.href='<?php echo base_url('user/'); ?>'">
                    <span>&#x2190; Kembali</span>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="profile-card">
                    <?php
                    $profile_image = isset($user['foto']) && !empty($user['foto']) ? base_url('assets/img/' . $user['foto']) : base_url('assets/img/user.png');
                    ?>
                    <img src="<?php echo $profile_image; ?>" alt="User Avatar">
                    <h3><?php echo isset($user['Nama']) ? $user['Nama'] : 'Nama tidak tersedia'; ?></h3>
                    <?php if (isset($user['google_email'])) : ?>
                        <p><?php echo isset($user['google_email']) ? $user['google_email'] : 'Email tidak tersedia'; ?></p>
                    <?php else : ?>
                        <p><?php echo isset($user['Email']) ? $user['Email'] : 'Email tidak tersedia'; ?></p>
                    <?php endif; ?>
                    <p><?php echo isset($user['Nomor_Telepon']) ? $user['Nomor_Telepon'] : 'Nomor telepon tidak tersedia'; ?></p>
                    <form action="<?php echo base_url('user/upload_photo'); ?>" method="post" enctype="multipart/form-data">
                        <input type="file" name="userfile" size="20" class="form-control mb-3" />
                        <button type="submit" class="btn btn-secondary">Ubah Foto</button>
                    </form>
                </div>


            </div>
            <div class="col-md-8">
                <div class="form-section">
                    <h2>Edit Profile</h2>
                    <form action="<?php echo base_url('user/edit_profile'); ?>" method="post" onsubmit="return validateForm()">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" value="<?php echo $this->session->userdata('username'); ?>" name="username" placeholder="Masukan username baru" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" value="<?php echo isset($user['Nama']) ? $user['Nama'] : ''; ?>" name="Nama" placeholder="Masukan nama baru" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <?php if (isset($user['google_email'])) : ?>
                                <input type="email" class="form-control" id="email" name="google_email" value="<?php echo $user['google_email']; ?>" disabled>
                            <?php else : ?>
                                <input type="email" class="form-control" id="email" name="Email" placeholder="Masukan email baru" value="<?php echo isset($user['Email']) ? $user['Email'] : ''; ?>" required>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">No. Telpon</label>
                            <input type="text" class="form-control" id="phone" value="<?php echo isset($user['Nomor_Telepon']) ? $user['Nomor_Telepon'] : ''; ?>" name="Nomor_Telepon" placeholder="Masukan no. telpon baru" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
                        <button type="button" class="btn btn-secondary" onclick="window.location.href='<?php echo base_url('user/'); ?>'">Kembali</button>
                    </form>
                    <?php if ($this->session->flashdata('success')) : ?>
                        <div class="alert alert-success mt-3">
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('error')) : ?>
                        <div class="alert alert-danger mt-3">
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function validateForm() {
            const nama = document.getElementById('nama').value;
            const email = document.getElementById('email').value;
            const phone = document.getElementById('phone').value;

            if (nama === '' || email === '' || phone === '') {
                alert('Semua kolom harus diisi.');
                return false;
            }
            if (!validateEmail(email)) {
                alert('Email tidak valid.');
                return false;
            }
            if (!/^\d{10,}$/.test(phone)) {
                alert('Nomor telepon harus valid.');
                return false;
            }
            return true;
        }

        function validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }
    </script>
</body>

</html>