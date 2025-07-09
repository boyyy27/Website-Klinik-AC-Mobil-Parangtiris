
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
                        <h1 style="color: black; font-size: 2rem;">Update Barang Keluar</h1>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo site_url('inventory/update_barang_keluar/'.$item['NomorTransaksi']); ?>"
                            method="post">
                            <div class="form-group">
                                <label for="TanggalKeluar">Tanggal Keluar</label>
                                <input type="date" class="form-control" id="TanggalKeluar" name="TanggalKeluar"
                                    value="<?php echo set_value('TanggalKeluar', $item['TanggalKeluar']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="NamaPenerima">Nama Penerima</label>
                                <input type="text" class="form-control" id="NamaPenerima" name="NamaPenerima"
                                    value="<?php echo set_value('NamaPenerima', $item['NamaPenerima']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="ID_Barang">ID Barang - Nama Barang - Harga Per Unit</label>
                                <select name="ID_Barang" class="form-control">
                                    <option value="">- Pilih Barang -</option>
                                    <!-- Ganti_oli_items -->
                                    <?php foreach ($ganti_oli_items as $ganti_oli_item) { ?>
                                    <option value="<?php echo $ganti_oli_item['ID_Barang']; ?>"
                                        <?php echo set_select('ID_Barang', $ganti_oli_item['ID_Barang'], ($item['ID_Barang'] == $ganti_oli_item['ID_Barang'])); ?>>
                                        <?php echo $ganti_oli_item['ID_Barang'] . ' - ' . $ganti_oli_item['Nama_Barang'] . ' - ' . format_rupiah($ganti_oli_item['Harga_Satuan']); ?></option>
                                    <?php } ?>
                                    <!-- Servis_mesin_ringan_items -->
                                    <?php foreach ($servis_mesin_ringan_items as $servis_mesin_ringan_item) { ?>
                                    <option value="<?php echo $servis_mesin_ringan_item['ID_Barang']; ?>"
                                        <?php echo set_select('ID_Barang', $servis_mesin_ringan_item['ID_Barang'], ($item['ID_Barang'] == $servis_mesin_ringan_item['ID_Barang'])); ?>>
                                        <?php echo $servis_mesin_ringan_item['ID_Barang'] . ' - ' . $servis_mesin_ringan_item['Nama_Barang'] . ' - ' . format_rupiah($servis_mesin_ringan_item['Harga_Satuan']); ?></option>
                                    <?php } ?>
                                    <!-- Ac_mobil_items -->
                                    <?php foreach ($ac_mobil_items as $ac_mobil_item) { ?>
                                    <option value="<?php echo $ac_mobil_item['ID_Barang']; ?>"
                                        <?php echo set_select('ID_Barang', $ac_mobil_item['ID_Barang'], ($item['ID_Barang'] == $ac_mobil_item['ID_Barang'])); ?>>
                                        <?php echo $ac_mobil_item['ID_Barang'] . ' - ' . $ac_mobil_item['Nama_Barang'] . ' - ' . format_rupiah($ac_mobil_item['Harga_Satuan']); ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('ID_Barang'); ?>
                            </div>
                            <div class="form-group">
                                <label for="NamaBarang">Nama Barang</label>
                                <input type="text" class="form-control" id="NamaBarang" name="NamaBarang"
                                    value="<?php echo set_value('NamaBarang', $item['NamaBarang']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="JumlahBarang">Jumlah Barang Keluar</label>
                                <input type="number" class="form-control" id="JumlahBarang" name="JumlahBarang"
                                    value="<?php echo set_value('JumlahBarang', $item['JumlahBarang']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="HargaPerUnit">Harga Per Unit (Rp)</label>
                                <input type="number" class="form-control" id="HargaPerUnit" name="HargaPerUnit"
                                    value="<?php echo set_value('HargaPerUnit', $item['HargaPerUnit']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="Keterangan">Keterangan</label>
                                <textarea class="form-control" id="Keterangan" name="Keterangan" rows="3"
                                    required><?php echo set_value('Keterangan', $item['Keterangan']); ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-submit">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
