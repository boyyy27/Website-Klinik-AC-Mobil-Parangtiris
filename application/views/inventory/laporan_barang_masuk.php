<?php
// Contoh penggunaan filter tanggal pada query untuk barang masuk
$date_from = $this->input->get('date_from');
$date_to = $this->input->get('date_to');

$query = $this->db->select('*')
                ->from('barangmasuk');

// Check if dates are provided and apply filters accordingly
if (!empty($date_from) && !empty($date_to)) {
    $query->where('TanggalMasuk >=', $date_from)
          ->where('TanggalMasuk <=', $date_to);
}

$query = $query->get();
$barang_masuk = $query->result_array();
$total_harga = 0;

// Hitung total harga untuk semua barang masuk
foreach ($barang_masuk as $item) {
    $total_harga += $item['JumlahBarang'] * $item['HargaPerUnit'];
}
?>

<div class="main-content">
    <div class="container mt-5">
        <h3>Laporan Barang Masuk</h3>
        <div class="form-container p-4 bg-light border rounded mb-4">
            <form method="get" action="<?php echo site_url('inventory/laporan_barang_masuk'); ?>">
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

        <?php if (!empty($barang_masuk)) : ?>
            <div id="report-content">
                <div class="text-center mb-4">
                    <h4>Laporan Barang Masuk</h4>
                    <p style="color: #4B4B4B;">Laporan dari <?php echo $this->input->get('date_from'); ?> sampai dengan <?php echo $this->input->get('date_to'); ?>.</p>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal Masuk</th>
                            <th>Nama Pemasok</th>
                            <th>ID Barang</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Barang Masuk</th>
                            <th>Harga Per Unit</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($barang_masuk as $index => $item) : ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo $item['TanggalMasuk']; ?></td>
                                <td><?php echo $item['NamaPemasok']; ?></td>
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
                    <h5>Total Harga: <?php echo $format_rupiah($total_harga); ?></h5>
                </div>
            </div>
        <?php else : ?>
            <div class="alert alert-warning" role="alert">
                Tidak ada barang masuk untuk periode yang dipilih.
            </div>
        <?php endif; ?>
    </div>
</div>
