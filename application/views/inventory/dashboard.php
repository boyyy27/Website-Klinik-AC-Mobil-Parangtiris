<?php
// Controller or model fetching data from the database

// Assuming CodeIgniter framework, example in controller or model:

// Fetch data from database with status "Approved"
$query = $this->db->select('*')
    ->from('permintaan_sparepart')
    ->where('Status', 'Approved')
    ->get();

$barang_keluar = $query->result_array();

// Total Barang Keluar
$totalBarangKeluar = 0;
foreach ($barang_keluar as $barang) {
    $totalBarangKeluar += $barang['Jumlah'];
}

?>

<div class="main-content">
    <div class="container mt-5">
        <div class="row">
            <!-- Card 1 -->
            <div class="col-md-4">
                <div class="card bg-primary text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Barang Masuk</h5>
                        <p class="card-text" style="color: black;"><?php echo $totalBarangMasuk; ?></p>
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="col-md-4">
                <div class="card bg-success text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Barang Keluar</h5>
                        <p class="card-text" style="color: black;"><?php echo $totalBarangKeluar; ?></p>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="col-md-4">
                <div class="card bg-warning text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Stok Barang</h5>
                        <ul class="list-unstyled">
                            <?php foreach ($stokBarang as $barang): ?>
                                <li style="color: black;"><?php echo htmlspecialchars($barang['NamaBarang']); ?>:
                                    <?php echo $barang['stok']; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Barang Masuk Table -->
        <div class="row mt-4">
            <div class="col-md-12">
                <h3>Barang Masuk Terbaru</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal Masuk</th>
                            <th>Nama Pemasok</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Barang Masuk</th>
                            <th>Harga Per Unit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recentBarangMasuk as $index => $barang): ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo htmlspecialchars($barang['TanggalMasuk']); ?></td>
                                <td><?php echo htmlspecialchars($barang['NamaPemasok']); ?></td>
                                <td><?php echo htmlspecialchars($barang['NamaBarang']); ?></td>
                                <td><?php echo $barang['JumlahBarang']; ?></td>
                                <td><?php echo htmlspecialchars($barang['HargaPerUnit']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Barang Keluar Table -->
        <?php if (!empty($barang_keluar)): ?>
            <div id="report-content">
                <div class="col-md-12">
                    <h4>Laporan Barang Keluar</h4>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal Permintaan</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Harga Per Unit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($barang_keluar as $index => $item): ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo htmlspecialchars(date('Y-m-d H:i:s', strtotime($item['Tanggal_Permintaan']))); ?>
                                </td>
                                <td><?php echo htmlspecialchars($item['Nama_Barang']); ?></td>
                                <td><?php echo $item['Jumlah']; ?></td>
                                <td><?php echo $this->sparepart_model->get_price_by_name($item['Nama_Barang']); ?></td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
