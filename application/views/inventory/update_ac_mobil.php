<body>
    <br><br><br>
    <div class="main-content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card card-chart">
                        <div class="card-header">
                            <a href="<?php echo site_url('inventory/ac_mobil'); ?>" class="btn btn-back btn-sm">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                            <h1 style="color: black; font-size: 2rem;">Edit Barang AC Mobil</h1>
                        </div>
                        <div class="card-body">
                            <?php echo form_open('inventory/update_ac_mobil/' . $item['ID_Barang'], ['onsubmit' => 'return validateForm()']); ?>
                                <div class="form-group">
                                    <label for="Nama_Barang">Nama Barang</label>
                                    <input type="text" placeholder="Masukan Nama Barang" class="form-control" id="Nama_Barang" name="nama_barang" value="<?php echo set_value('nama_barang', $item['Nama_Barang']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="Harga_Satuan">Harga Satuan</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="number" placeholder="Masukan Harga Satuan" class="form-control" id="Harga_Satuan" name="harga_satuan" value="<?php echo set_value('harga_satuan', $item['Harga_Satuan']); ?>" step="0.01" required>
                                    </div>
                                    <div id="hargaSatuanError" style="color: red; display: none;">Harga Satuan harus diisi dengan angka lebih dari 0</div>
                                </div>
                                <div class="form-group">
                                    <label for="Jumlah_Stok">Jumlah Stok</label>
                                    <input type="number" placeholder="Masukan Jumlah Stok" class="form-control" id="Jumlah_Stok" name="jumlah_stok" value="<?php echo $item['Jumlah_Stok']; ?>" readonly>
                                    <!-- Hidden field to submit unchanged stock value -->
                                    <input type="hidden" name="jumlah_stok" value="<?php echo $item['Jumlah_Stok']; ?>">
                                </div>
                                <button type="submit" class="btn btn-submit">Update</button>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function validateForm() {
            var hargaSatuan = document.getElementById('Harga_Satuan').value;
            var jumlahStok = document.getElementById('Jumlah_Stok').value;
            
            if (hargaSatuan <= 0 || isNaN(hargaSatuan)) {
                document.getElementById('hargaSatuanError').style.display = 'block';
                return false;
            } else {
                document.getElementById('hargaSatuanError').style.display = 'none';
            }

            if (jumlahStok <= 0 || isNaN(jumlahStok)) {
                document.getElementById('jumlahStokError').style.display = 'block';
                return false;
            } else {
                document.getElementById('jumlahStokError').style.display = 'none';
            }

            return true;
        }
    </script>
</body>
</html>
