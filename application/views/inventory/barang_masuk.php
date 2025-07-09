<div class="main-content">
    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header">
                    <h1 style="color: black; font-size: 2rem;">Barang Masuk</h1>
                    <a href="<?php echo site_url('inventory/add_barang_masuk_view'); ?>" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Barang
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="barang_masuk_table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nomor Transaksi</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Nama Pemasok</th>
                                    <th>ID Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah Barang</th>
                                    <th>Harga Per Unit</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($barang_masuk as $item): ?>
                                    <tr>
                                        <td><?php echo $item['NomorTransaksi']; ?></td>
                                        <td><?php echo $item['TanggalMasuk']; ?></td>
                                        <td><?php echo $item['NamaPemasok']; ?></td>
                                        <td><?php echo $item['ID_Barang']; ?></td>
                                        <td><?php echo $item['NamaBarang']; ?></td>
                                        <td><?php echo $item['JumlahBarang']; ?></td>
                                        <td><?php echo format_rupiah($item['HargaPerUnit']); ?></td>
                                        <td><?php echo $item['Keterangan']; ?></td>
                                        <td>
                                            <a href="<?php echo site_url('inventory/update_barang_masuk/' . $item['NomorTransaksi']); ?>" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="<?php echo site_url('inventory/delete_barang_masuk/' . $item['NomorTransaksi']); ?>" class="btn btn-delete btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?');">
                                                <i class="fas fa-trash"></i> Hapus
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
