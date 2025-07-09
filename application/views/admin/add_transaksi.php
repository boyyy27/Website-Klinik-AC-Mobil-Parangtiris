<div class="main-content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="<?php echo site_url('admin/transaksi'); ?>" class="btn btn-back btn-sm">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                    <h1 style="color: black; font-size: 2rem;">Tambah Transaksi</h1>
                </div>
                <div class="card-body">
                    <form id="transactionForm" action="<?php echo site_url('admin/save_transaksi'); ?>" method="post">
                        <div class="form-group">
                            <label>Status:</label><br>
                            <input type="radio" id="non_member" name="status" value="non_member" checked>
                            <label for="non_member">Non Member</label><br>
                            <input type="radio" id="member" name="status" value="member">
                            <label for="member">Member</label>
                        </div>
                        <div class="form-group" id="user_id_div" style="display: none;">
                            <label for="user_id">ID User:</label>
                            <select class="form-control" id="user_id" name="user_id">
                                <?php foreach ($members as $member): ?>
                                    <option value="<?php echo $member['ID_User']; ?>"><?php echo $member['Nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sparepart">Sparepart:</label>
                            <select class="form-control" id="sparepart" name="sparepart" required>
                                <option value="Tidak menggunakan Sparepart" data-harga="0">Tidak menggunakan Sparepart</option>
                                <?php foreach ($suku_cadang as $item): ?>
                                    <option value="<?php echo $item['Nama_Barang']; ?>" data-harga="<?php echo $item['Harga_Satuan']; ?>"><?php echo $item['Nama_Barang']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi:</label>
                            <input type="text" placeholder="Masukan Deskripsi" class="form-control" id="deskripsi" name="deskripsi">
                        </div>
                        <div class="form-group">
                            <label for="amount">Jumlah:</label>
                            <input type="number" placeholder="Masukan Jumlah" class="form-control" id="amount" name="amount" required>
                        </div>
                        <div class="form-group">
                            <label>Total:</label>
                            <div id="total_display">0</div>
                        </div>
                        <input type="hidden" id="points" name="points" value="0">
                        <button type="submit" class="btn btn-submit">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
