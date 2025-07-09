<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Riwayat Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f8f9fa;
        }

        .transaction-card {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            transition: transform 0.2s ease-in-out;
        }

        .transaction-card:hover {
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

        .btn-lihat {
            background-color: #B00B0B;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.2s ease-in-out;
        }

        .btn-lihat:hover {
            background-color: #900909;
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
            <div class="col-12">
                <div class="transaction-card">
                    <h2>Riwayat Transaksi</h2>
                    <?php if (!empty($transactions)) : ?>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Produk</th>
                                    <th scope="col">Gambar Produk</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($transactions as $index => $transaction) : ?>
                                    <tr>
                                        <th scope="row"><?php echo $index + 1; ?></th>
                                        <td><?php echo $transaction['date']; ?></td>
                                        <td>
                                            <?php
                                            if (!empty($transaction['product_name'])) {
                                                echo $transaction['product_name'];
                                            } else {
                                                echo $transaction['sparepart'];
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php if (!empty($transaction['product_image'])) : ?>
                                                <img src="<?php echo base_url('assets/img/' . $transaction['product_image']); ?>" alt="<?php echo $transaction['product_name']; ?>">
                                            <?php else : ?>
                                                <span>No Image</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $transaction['deskripsi']; ?></td>
                                        <td>
                                            <?php
                                            if ($transaction['amount'] < 100) {
                                                echo $transaction['amount'] . ' points';
                                            } else {
                                                echo 'Rp' . number_format($transaction['amount'], 2);
                                            }
                                            ?>
                                        </td>                                        <td>
                                            <button class="btn-lihat" onclick="window.location.href='<?php echo base_url('user/detail_transaksi/'.$transaction['transaction_id']); ?>'">Lihat</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else : ?>
                        <p>Tidak ada transaksi.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
