</head>

<body>
    <br><br><br>
    <div class="main-content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="<?php echo site_url('inventory/ac_mobil'); ?>" class="btn btn-back btn-sm">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                        <h1 style="color: black; font-size: 2rem;">Tambah Barang AC Mobil</h1>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo site_url('inventory/add_ac_mobil'); ?>" method="post"
                            onsubmit="return validateForm()">
                            <div class="form-group">
                                <label for="Nama_Barang">Nama Barang</label>
                                <input type="text" placeholder="Masukan Nama Barang" class="form-control"
                                    id="Nama_Barang" name="Nama_Barang" required>
                            </div>
                            <div class="form-group">
                                <label for="Harga_Satuan">Harga Satuan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="text" placeholder="Masukkan Harga Satuan" class="form-control" id="Harga_Satuan" name="Harga_Satuan" oninput="formatCurrency(this);" required>
                                </div>
                                <span id="hargaSatuanError" style="color: red; display: none;">Harga Satuan harus lebih
                                    besar dari 0.</span>
                            </div>
                            <div class="form-group">
                                <label for="Jumlah_Stok">Jumlah Stok</label>
                                <input type="number" value="1" class="form-control" id="Jumlah_Stok" disabled>
                                <input type="hidden" name="Jumlah_Stok" value="1">
                            </div>
                            <button type="submit" class="btn btn-submit">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function validateForm() {
            var hargaSatuan = document.getElementById('Harga_Satuan').value;

            if (hargaSatuan <= 0) {
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