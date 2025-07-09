<div class="main-content">
    <div class="container mt-5">
        <h3>Laporan Barang Keluar</h3>
        <div class="form-container p-4 bg-light border rounded mb-4">
            <form method="get" action="<?php echo site_url('inventory/laporan_barang_keluar'); ?>">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="date_from">Tanggal Dari</label>
                            <input type="date" class="form-control" id="date_from" name="date_from" value="<?php echo set_value('date_from'); ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="date_to">Tanggal Sampai</label>
                            <input type="date" class="form-control" id="date_to" name="date_to" value="<?php echo set_value('date_to'); ?>">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Filter</button>
                <button type="button" class="btn btn-secondary" onclick="printReport()">Print Report</button>
            </form>
        </div>

        <?php if (!empty($barang_keluar)) : ?>
            <div id="report-content">
                <div class="text-center mb-4">
                    <h4>Laporan Barang Keluar</h4>
                    <p style="color: #4B4B4B;">Laporan dari <?php echo $this->input->get('date_from'); ?> sampai dengan <?php echo $this->input->get('date_to'); ?>.</p>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal Keluar</th>
                            <th>Nama Penerima</th>
                            <th>ID Barang</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Barang Keluar</th>
                            <th>Harga Per Unit</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($barang_keluar as $index => $item) : ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo $item['TanggalKeluar']; ?></td>
                                <td><?php echo $item['NamaPenerima']; ?></td>
                                <td><?php echo $item['ID_Barang']; ?></td>
                                <td><?php echo $item['NamaBarang']; ?></td>
                                <td><?php echo $item['JumlahBarang']; ?></td>
                                <td><?php echo $format_rupiah($item['HargaPerUnit']); ?></td>
                                <td><?php echo $item['Keterangan']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="text-right">
                    <h5>Total Harga Barang Masuk : <?php echo $format_rupiah($total_harga); ?></h5>
                </div>
            </div>
        <?php else : ?>
            <div class="alert alert-warning" role="alert">
                Tidak ada transaksi untuk periode yang dipilih.
            </div>
        <?php endif; ?>

        <div class="mt-4">
            <h4>Notifications</h4>
            <ul id="notificationList" class="list-group">
                <!-- Notifikasi akan dimuat di sini -->
            </ul>
        </div>
    </div>
</div>

<script>
    // Panggil fungsi untuk cek notifikasi setiap beberapa waktu
    setInterval(checkNotificationStatus, 60000); // Cek setiap 60 detik
</script>
