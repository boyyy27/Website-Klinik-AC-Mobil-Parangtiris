<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f8f9fa;
        }

        .transaction-detail-card {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            transition: transform 0.2s ease-in-out;
        }

        .transaction-detail-card:hover {
            transform: translateY(-5px);
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
                <button class="btn-back" onclick="window.location.href='<?php echo base_url('user/riwayat_transaksi'); ?>'">
                    <span>&#x2190; Kembali</span>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="transaction-detail-card">
                    <h2>Detail Transaksi</h2>
                    <p><strong>Tanggal:</strong> <?php echo $transaction['date']; ?></p>
                    <p><strong>Produk:</strong> <?php
                                            if (!empty($transaction['product_name'])) {
                                                echo $transaction['product_name'];
                                            } else {
                                                echo $transaction['sparepart'];
                                            }
                                            ?></p>
                    <p><strong>Gambar Produk:</strong>  <?php if (!empty($transaction['product_image'])) : ?>
                                                <img src="<?php echo base_url('assets/img/' . $transaction['product_image']); ?>" alt="<?php echo $transaction['product_name']; ?>">
                                            <?php else : ?>
                                                <span>No Image</span>
                                            <?php endif; ?></p>
                    <p><strong>Deskripsi:</strong> <?php echo $transaction['deskripsi']; ?></p>
                    <p><strong>Total: </strong>  <?php
                                            if ($transaction['amount'] < 100) {
                                                echo $transaction['amount'] . ' points';
                                            } else {
                                                echo 'Rp' . number_format($transaction['amount'], 2);
                                            }
                                            ?></p>
                    <p><strong>Redeem Kode:</strong> <?php echo $transaction['redeem']; ?></p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
