<body>
    <br><br><br>
    <div class="main-content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="<?php echo site_url('inventory/servis_mesin_ringan'); ?>" class="btn btn-back btn-sm">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                        <h1 style="color: black; font-size: 2rem;">Tambah Barang Servis Mesin Ringan</h1>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo site_url('inventory/add_servis_mesin_ringan'); ?>" method="post" onsubmit="return validateForm()">
                            <div class="form-group">
                                <label for="Nama_Barang">Nama Barang</label>
                                <input type="text" placeholder="Masukkan Nama Barang" class="form-control" id="Nama_Barang" name="Nama_Barang" required>
                            </div>
                            <div class="form-group">
                                <label for="Harga_Satuan">Harga Satuan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="number" class="form-control"placeholder="Masukan Harga Satuan" id="Harga_Satuan" name="Harga_Satuan" step="0.01" required>
                                </div>
                                <div id="hargaSatuanError" style="color: red; display: none;">Harga Satuan harus diisi dengan angka lebih dari 0</div>
                            </div>
                            <div class="form-group">
                                <label for="Jumlah_Stok">Jumlah Stok</label>
                                <input type="number" value="1" class="form-control" id="Jumlah_Stok" readonly>
                                <input type="hidden" name="Jumlah_Stok" value="1">
                                <div id="jumlahStokError" style="color: red; display: none;">Jumlah Stok harus diisi dengan angka lebih dari 0</div>
                            </div>
                            <button type="submit" class="btn btn-submit">Tambah</button>
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
            var hargaSatuan = document.getElementById('Harga_Satuan').value;
            
            if (hargaSatuan <= 0 || isNaN(hargaSatuan)) {
                document.getElementById('hargaSatuanError').style.display = 'block';
                return false;
            } else {
                document.getElementById('hargaSatuanError').style.display = 'none';
            }

            return true;
        }
    </script>
</body>

</html>
