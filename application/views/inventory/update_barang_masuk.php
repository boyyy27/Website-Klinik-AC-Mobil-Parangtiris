<body>
    <div class="main-content">
        <div class="row">
            <div class="col-12">
                <div class="card card-chart">
                    <div class="card-header">
                        <a href="<?php echo site_url('inventory/barang_masuk'); ?>" class="btn btn-back btn-sm">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                        <h1 style="color: black; font-size: 2rem;">Update Barang Masuk</h1>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo site_url('inventory/update_barang_masuk/' . $item['NomorTransaksi']); ?>" method="post" onsubmit="return validateForm()">
                            <div class="form-group">
                                <label for="TanggalMasuk">Tanggal Masuk</label>
                                <input type="date" class="form-control" id="TanggalMasuk" name="TanggalMasuk"
                                    value="<?php echo set_value('TanggalMasuk', $item['TanggalMasuk']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="NamaPemasok">Nama Pemasok</label>
                                <input type="text" class="form-control" id="NamaPemasok" name="NamaPemasok"
                                    value="<?php echo set_value('NamaPemasok', $item['NamaPemasok']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="ID_Barang">ID Barang - Nama Barang - Harga Per Unit</label>
                                <input type="text" class="form-control" id="ID_Barang" value="<?php echo $item['ID_Barang'] . ' - ' . $item['NamaBarang'] . ' - ' . format_rupiah($item['HargaPerUnit']); ?>" disabled>
                                <input type="hidden" id="ID_Barang_hidden" name="ID_Barang" value="<?php echo $item['ID_Barang']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="NamaBarang">Nama Barang</label>
                                <input type="text" class="form-control" id="NamaBarang" name="NamaBarang"
                                    value="<?php echo set_value('NamaBarang', $item['NamaBarang']); ?>" readonly required>
                            </div>
                            <div class="form-group">
                                <label for="JumlahBarang">Jumlah Barang</label>
                                <input type="number" class="form-control" id="JumlahBarang" name="JumlahBarang"
                                    value="<?php echo set_value('JumlahBarang', $item['JumlahBarang']); ?>" required>
                                <span id="jumlahBarangError" style="color: red; display: none;">Jumlah Barang harus lebih besar dari 0.</span>
                            </div>
                            <div class="form-group">
                                <label for="HargaPerUnit">Harga Per Unit</label>
                                <?php 
                                    $hargaPerUnit = $item['HargaPerUnit'];
                                    $formattedHarga = "Rp. " . number_format($hargaPerUnit, 0, ',', '.');
                                ?>
                                <input type="text" class="form-control" id="formattedHargaPerUnit" value="<?php echo $formattedHarga; ?>" readonly>
                                <input type="hidden" id="HargaPerUnit" name="HargaPerUnit" value="<?php echo $hargaPerUnit; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="Keterangan">Keterangan</label>
                                <textarea class="form-control" id="Keterangan" name="Keterangan" rows="3" required><?php echo set_value('Keterangan', $item['Keterangan']); ?></textarea>
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
    <script>
        function validateForm() {
            var jumlahBarang = document.getElementById('JumlahBarang').value;
            if (jumlahBarang <= 0) {
                document.getElementById('jumlahBarangError').style.display = 'block';
                return false;
            } else {
                document.getElementById('jumlahBarangError').style.display = 'none';
                return true;
            }
        }
    </script>
</body>
</html>
