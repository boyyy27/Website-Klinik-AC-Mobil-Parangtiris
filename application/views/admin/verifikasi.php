

<div class="container">
        <div class="modal" tabindex="-1" role="dialog" id="inventoryModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Perhatian!</h5>
                    </div>
                    <div class="modal-body">
                        <p>Mohon maaf, <br>akses ke halaman ini terbatas untuk pengguna. Jika Anda memiliki akun administrasi, silakan keluar dan masuk kembali menggunakan kredensial yang sesuai. <br>Jika tidak, Anda dapat menghubungi administrator untuk mendapatkan bantuan lebih lanjut.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="closeModal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#inventoryModal').modal({
                backdrop: 'static',
                keyboard: false
            });

            $('#inventoryModal').modal('show');

            $('#closeModal').click(function() {
                history.back();
            });
        });
    </script>
