
<body>
    <div class="main-content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                <div class="card card-chart">
                    <div class="card-header">
                        <a href="<?php echo site_url('inventory/barang_keluar'); ?>" class="btn btn-back btn-sm">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                        <h1 style="color: black; font-size: 2rem;">Tambah Barang Keluar</h1>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo site_url('inventory/add_barang_keluar'); ?>" method="post">
                            <div class="form-group">
                                <label for="TanggalKeluar">Tanggal Keluar</label>
                                <input type="date" class="form-control" id="TanggalKeluar" name="TanggalKeluar" required>
                            </div>
                            <div class="form-group">
                                <label for="NamaPenerima">Nama Penerima</label>
                                <input type="text" class="form-control" id="NamaPenerima" name="NamaPenerima" required>
                            </div>
                            <div class="form-group">
                                <label for="ID_Barang">ID Barang - Nama Barang - Harga Per Unit</label>
                                <select name="ID_Barang" class="form-control">
                                    <option value="">- Pilih Barang -</option>
                                    <!-- Ganti_oli_items -->
                                    <?php foreach ($ganti_oli_items as $item) { ?>
                                        <option value="<?php echo $item['ID_Barang']; ?>">
                                            <?php echo $item['ID_Barang'] . ' - ' . $item['Nama_Barang'] . ' - ' . format_rupiah($item['Harga_Satuan']); ?></option>
                                    <?php } ?>
                                    <!-- Servis_mesin_ringan_items -->
                                    <?php foreach ($servis_mesin_ringan_items as $item) { ?>
                                        <option value="<?php echo $item['ID_Barang']; ?>">
                                            <?php echo $item['ID_Barang'] . ' - ' . $item['Nama_Barang'] . ' - ' . format_rupiah($item['Harga_Satuan']); ?></option>
                                    <?php } ?>
                                    <!-- Ac_mobil_items -->
                                    <?php foreach ($ac_mobil_items as $item) { ?>
                                        <option value="<?php echo $item['ID_Barang']; ?>">
                                            <?php echo $item['ID_Barang'] . ' - ' . $item['Nama_Barang'] . ' - ' . format_rupiah($item['Harga_Satuan']); ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('ID_Barang'); ?>
                            </div>
                            <div class="form-group">
                                <label for="NamaBarang">Nama Barang</label>
                                <input type="text" class="form-control" id="NamaBarang" name="NamaBarang" required>
                            </div>
                            <div class="form-group">
                                <label for="JumlahBarang">Jumlah Barang Keluar</label>
                                <input type="number" class="form-control" id="JumlahBarang" name="JumlahBarang" required>
                            </div>
                            <div class="form-group">
                                <label for="HargaPerUnit">Harga Per Unit (Rp)</label>
                                <input type="number" class="form-control" id="HargaPerUnit" name="HargaPerUnit" required>
                            </div>
                            <div class="form-group">
                                <label for="Keterangan">Keterangan</label>
                                <textarea class="form-control" id="Keterangan" name="Keterangan" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-submit">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>

</html>
