<?php
$query = $this->db->select('*')
                ->from('permintaan_sparepart')
                ->where('Status', 'Approved')
                ->get();  // Execute the query

$barang_keluar = $query->result_array();
?>

<div class="main-content">
    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header">
                    <h1 style="color: black; font-size: 2rem;">Barang Keluar</h1>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="barang_keluar_table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Permintaan</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Harga Per Unit</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($barang_keluar as $index => $item) :
                                    $hargaPerUnit = $this->sparepart_model->get_price_by_name($item['Nama_Barang']);
                                ?>
                                    <tr>
                                        <td><?php echo $index + 1; ?></td>
                                        <td><?php echo htmlspecialchars(date('Y-m-d H:i:s', strtotime($item['Tanggal_Permintaan']))); ?></td>
                                        <td><?php echo htmlspecialchars($item['Nama_Barang']); ?></td>
                                        <td><?php echo $item['Jumlah']; ?></td>
                                        <td><?php echo 'Rp. ' . number_format($hargaPerUnit, 0, ',', '.'); ?></td>
                                        <td>
                                            <a href="<?php echo site_url('inventory/delete_barang_keluar/' . $item['ID_Permintaan']); ?>" class="btn btn-delete btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?');">
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
