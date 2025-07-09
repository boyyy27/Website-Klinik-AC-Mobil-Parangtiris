<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Profile and Points Redemption</title>
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
        }

        .profile-card .btn-primary {
            background-color: #B00B0B;
            color: white;
            width: 100%;
            margin-bottom: 10px;
            font-size: 18px;
            transition: background-color 0.2s ease-in-out;
        }

        .profile-card .btn-primary:hover {
            background-color: #900909;
        }

        .profile-card .btn-secondary {
            background-color: white;
            color: #B00B0B;
            border: 1px solid #B00B0B;
            width: 100%;
            font-size: 18px;
            transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out;
        }

        .profile-card .btn-secondary:hover {
            background-color: #B00B0B;
            color: white;
        }

        .points-section {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .points-section .item-card {
            background: #fff;
            padding: 10px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 10px 0;
            transition: transform 0.2s ease-in-out;
        }

        .points-section .item-card:hover {
            transform: translateY(-5px);
        }

        .points-section .item-card img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .points-section .item-card .btn-danger {
            background-color: #B00B0B;
            color: white;
            width: 100%;
            margin-top: 10px;
            transition: background-color 0.2s ease-in-out;
        }

        .points-section .item-card .btn-danger:hover {
            background-color: #900909;
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
                <button class="btn-back" onclick="window.location.href='<?php echo base_url('welcome/'); ?>'">
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
                    <h3>
                        <?php
                        if (isset($user['google_email']) && !empty($user['google_email'])) {
                            echo isset($user['Username']) ? $user['Username'] : 'Username tidak tersedia';
                        } else {
                            echo isset($user['Nama']) ? $user['Nama'] : 'Nama tidak tersedia';
                        }
                        ?>
                    </h3>
                    <?php if (isset($user['google_email'])) : ?>
                        <p><?php echo isset($user['google_email']) ? $user['google_email'] : 'Email tidak tersedia'; ?></p>
                    <?php else : ?>
                        <p><?php echo isset($user['Email']) ? $user['Email'] : 'Email tidak tersedia'; ?></p>
                    <?php endif; ?>
                    <p><?php echo isset($user['Nomor_Telepon']) ? $user['Nomor_Telepon'] : 'Nomor telepon tidak tersedia'; ?></p>
                    <button class="btn btn-primary" onclick="window.location.href='<?php echo base_url('user/edit_profile'); ?>'">Edit Profil</button>
                    <button class="btn btn-primary" onclick="window.location.href='<?php echo base_url('user/riwayat_transaksi'); ?>'">Riwayat Transaksi</button>
                    <button class="btn btn-secondary" onclick="window.location.href='<?php echo base_url('auth/logout'); ?>'">Logout</button>
                </div>
            </div>
            <div class="col-md-8">
                <div class="points-section">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5>Jumlah Poin</h5>
                        <h5><?php echo isset($user['points']) ? $user['points'] : '0'; ?> <span><img src="<?php echo base_url('assets/img/coin.png'); ?>"></span></h5>
                    </div>
                    <div class="row">
                        <?php if (!empty($products)) : ?>
                            <?php foreach ($products as $product) : ?>
                                <div class="col-6 col-md-4">
                                    <div class="item-card">
                                        <img src="<?php echo base_url('assets/img/' . $product['image']); ?>" alt="<?php echo $product['name']; ?>">
                                        <p><?php echo $product['points']; ?> <img src="<?php echo base_url('assets/img/coin.png'); ?>" alt="coin" style="width: 20px; height: 20px;"></p>
                                        <button class="btn btn-danger" onclick="confirmRedemption('<?php echo $product['product_id']; ?>', '<?php echo $product['name']; ?>')">Tukarkan Poin</button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <p>No products available.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="redeemModal" tabindex="-1" aria-labelledby="redeemModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="redeemModalLabel">Konfirmasi Penukaran Poin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin ingin menukarkan poin dengan <span id="product-name"></span>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirm-redeem">Tukarkan Poin</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <?php if ($this->session->flashdata('success')) : ?>
        <script>
            alert('<?php echo $this->session->flashdata('success'); ?>');
        </script>
    <?php elseif ($this->session->flashdata('error')) : ?>
        <script>
            alert('<?php echo $this->session->flashdata('error'); ?>');
        </script>
    <?php endif; ?>

    <script>
        function confirmRedemption(product_id, product_name) {
            document.getElementById('product-name').innerText = product_name;
            var redeemButton = document.getElementById('confirm-redeem');
            redeemButton.onclick = function() {
                window.location.href = '<?php echo base_url('user/redeem_points/'); ?>' + product_id;
            };
            var redeemModal = new bootstrap.Modal(document.getElementById('redeemModal'));
            redeemModal.show();
        }
    </script>
</body>

</html>