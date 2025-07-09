<div class="main-content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 style="color: black; font-size: 2rem;">Transaksi</h1>
                    <a href="<?php echo site_url('admin/add_transaksi'); ?>" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Barang
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <?php if ($this->session->flashdata('success')) : ?>
                            <div class="alert alert-success">
                                <?php echo $this->session->flashdata('success'); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($this->session->flashdata('error')) : ?>
                            <div class="alert alert-danger">
                                <?php echo $this->session->flashdata('error'); ?>
                            </div>
                        <?php endif; ?>
                        <table class="table table-hover table-bordered" id="transactions_table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID Transaksi</th>
                                    <th>ID User</th>
                                    <th>Nama Produk</th>
                                    <th>Gambar</th>
                                    <th>Deskripsi</th>
                                    <th>Redeem</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($transactions as $transaction) : ?>
                                    <tr>
                                        <td><?php echo $transaction['transaction_id']; ?></td>
                                        <td><?php echo $transaction['user_id']; ?></td>
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
                                        <td><?php echo $transaction['redeem']; ?></td>
                                        <td>
                                            <?php
                                            if ($transaction['amount'] < 100) {
                                                echo $transaction['amount'] . ' points';
                                            } else {
                                                echo 'Rp' . number_format($transaction['amount'], 2);
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $transaction['date']; ?></td>
                                        <td>
                                            <a href="<?php echo site_url('admin/delete_transaksi/' . $transaction['transaction_id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');">
                                                Hapus
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>