<div class="main-content">
        <div class="row">
            <div class="col-12">
                <div class="card card-chart">
                    <div class="card-header">
                        <h1 style="color: black; font-size: 2rem;">AC Mobil</h1>
                        <a href="<?php echo site_url('inventory/add_ac_mobil_view'); ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Barang
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="ac_mobil_table" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Barang</th>
                                        <th>Harga Satuan</th>
                                        <th>Jumlah Stok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($ac_mobil as $item): ?>
                                        <tr>
                                            <td><?php echo $item['ID_Barang']; ?></td>
                                            <td><?php echo $item['Nama_Barang']; ?></td>
                                            <td><?php echo format_rupiah($item['Harga_Satuan']); ?></td>
                                            <td><?php echo $item['Jumlah_Stok']; ?></td>
                                            <td>
                                                <a href="<?php echo site_url('inventory/update_ac_mobil/' . $item['ID_Barang']); ?>" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a href="<?php echo site_url('inventory/delete_ac_mobil/' . $item['ID_Barang']); ?>" class="btn btn-delete btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?');">
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