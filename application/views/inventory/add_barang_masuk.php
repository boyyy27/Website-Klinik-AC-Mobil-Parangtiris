<body>
    <div class="main-content">
        <div class="row">
            <div class="col-12">
                <div class="card card-chart">
                    <div class="card-header">
                        <a href="<?php echo site_url('inventory/barang_masuk'); ?>" class="btn btn-back btn-sm">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                        <h1 style="color: black; font-size: 2rem;">Tambah Barang Masuk</h1>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo site_url('inventory/add_barang_masuk'); ?>" method="post"
                            onsubmit="return validateForm()">
                            <div class="form-group">
                                <label for="TanggalMasuk">Tanggal Masuk</label>
                                <input type="date" class="form-control" id="TanggalMasuk" name="TanggalMasuk" required>
                            </div>
                            <div class="form-group">
                                <label for="NamaPemasok">Nama Pemasok</label>
                                <input type="text" class="form-control" id="NamaPemasok" name="NamaPemasok" required>
                            </div>
                            <div class="form-group">
                                <label for="ID_Barang">ID Barang - Nama Barang - Harga Per Unit</label>
                                <select name="ID_Barang" id="ID_Barang" class="form-control" onchange="fillDetails()"
                                    required>
                                    <option value="">- Pilih Barang -</option>
                                    <!-- Ganti_oli_items -->
                                    <?php foreach ($ganti_oli_items as $item) { ?>
                                        <option value="<?php echo $item['ID_Barang']; ?>"
                                            data-nama-barang="<?php echo $item['Nama_Barang']; ?>"
                                            data-harga-per-unit="<?php echo $item['Harga_Satuan']; ?>">
                                            <?php echo $item['ID_Barang'] . ' - ' . $item['Nama_Barang'] . ' - ' . format_rupiah($item['Harga_Satuan']); ?>
                                        </option>
                                    <?php } ?>
                                    <!-- Servis_mesin_ringan_items -->
                                    <?php foreach ($servis_mesin_ringan_items as $item) { ?>
                                        <option value="<?php echo $item['ID_Barang']; ?>"
                                            data-nama-barang="<?php echo $item['Nama_Barang']; ?>"
                                            data-harga-per-unit="<?php echo $item['Harga_Satuan']; ?>">
                                            <?php echo $item['ID_Barang'] . ' - ' . $item['Nama_Barang'] . ' - ' . format_rupiah($item['Harga_Satuan']); ?>
                                        </option>
                                    <?php } ?>
                                    <!-- Ac_mobil_items -->
                                    <?php foreach ($ac_mobil_items as $item) { ?>
                                        <option value="<?php echo $item['ID_Barang']; ?>"
                                            data-nama-barang="<?php echo $item['Nama_Barang']; ?>"
                                            data-harga-per-unit="<?php echo $item['Harga_Satuan']; ?>">
                                            <?php echo $item['ID_Barang'] . ' - ' . $item['Nama_Barang'] . ' - ' . format_rupiah($item['Harga_Satuan']); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('ID_Barang'); ?>
                            </div>
                            <div class="form-group">
                                <label for="NamaBarang">Nama Barang</label>
                                <input type="text" class="form-control" id="NamaBarang" name="NamaBarang" readonly
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="JumlahBarang">Jumlah Barang</label>
                                <input type="number" class="form-control" id="JumlahBarang" name="JumlahBarang"
                                    required>
                                <span id="jumlahBarangError" style="color: red; display: none;">Jumlah Barang harus
                                    lebih besar dari 0.</span>
                            </div>
                            <div class="form-group">
    <label for="HargaPerUnit">Harga Per Unit</label>
    <input type="text" class="form-control" id="HargaPerUnit" name="HargaPerUnit" readonly required>
    <input type="hidden" id="HargaPerUnitNumeric" name="HargaPerUnitNumeric">
</div>


                            <div class="form-group">
                                <label for="Keterangan">Keterangan</label>
                                <textarea class="form-control" id="Keterangan" name="Keterangan" rows="3"
                                    required></textarea>
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
        function fillDetails() {
    var selectedOption = document.querySelector('#ID_Barang option:checked');
    var namaBarang = selectedOption.getAttribute('data-nama-barang');
    var hargaPerUnit = selectedOption.getAttribute('data-harga-per-unit');

    document.getElementById('NamaBarang').value = namaBarang;
    document.getElementById('HargaPerUnit').value = formatRupiah(hargaPerUnit);
    document.getElementById('HargaPerUnitNumeric').value = hargaPerUnit;
}

function formatRupiah(angka) {
    var reverse = angka.toString().split('').reverse().join('');
    var ribuan = reverse.match(/\d{1,3}/g);
    var formatted = ribuan.join('.').split('').reverse().join('');
    return 'Rp. ' + formatted;
}




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