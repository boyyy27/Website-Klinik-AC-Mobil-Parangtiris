<?php
// Contoh penggunaan filter tanggal pada query untuk barang keluar
$date_from = $this->input->get('date_from');
$date_to = $this->input->get('date_to');

$query = $this->db->select('*')
                ->from('permintaan_sparepart')
                ->where('Status', 'Approved');

// Check if dates are provided and apply filters accordingly
if (!empty($date_from) && !empty($date_to)) {
    $query->where('Tanggal_Permintaan >=', $date_from)
          ->where('Tanggal_Permintaan <=', $date_to);
}

$query = $query->get();
$barang_keluar = $query->result_array();
?>

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
                            <th>Tanggal Permintaan</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Harga Per Unit</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $totalHargaSemuaBarang = 0;
                        foreach ($barang_keluar as $index => $item) :
                            $hargaPerUnit = $this->sparepart_model->get_price_by_name($item['Nama_Barang']);
                            $totalHargaBarang = $item['Jumlah'] * $hargaPerUnit;
                            $totalHargaSemuaBarang += $totalHargaBarang;
                        ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo htmlspecialchars(date('Y-m-d H:i:s', strtotime($item['Tanggal_Permintaan']))); ?></td>
                                <td><?php echo htmlspecialchars($item['Nama_Barang']); ?></td>
                                <td><?php echo $item['Jumlah']; ?></td>
                                <td><?php echo 'Rp. ' . number_format($hargaPerUnit, 0, ',', '.'); ?></td>
                                <td><?php echo 'Rp. ' . number_format($totalHargaBarang, 0, ',', '.'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="text-right">
                    <h5>Total Harga Semua Barang Keluar: <?php echo 'Rp. ' . number_format($totalHargaSemuaBarang, 0, ',', '.'); ?></h5>
                </div>
            </div>
        <?php else : ?>
            <div class="alert alert-warning" role="alert">
                Tidak ada barang keluar untuk periode yang dipilih.
            </div>
        <?php endif; ?>
    </div>
</div>
