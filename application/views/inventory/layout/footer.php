<div class="footer">
    <p>2001 Copyright by PARANGTRITIS KLINIK AC MOBIL</p>
</div>
<?php
// Ambil data notifikasi dari session
$countPending = $this->session->userdata('countPending');
// Ambil data untuk modal dari session
$modalData = $this->session->userdata('modalData');
?>
<!-- Modal -->
<div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationModalLabel">Pending Requests</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php if (!empty($requests)) : ?>
                    <table class="table table-hover table-bordered" id="requests_table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID Permintaan</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Tanggal Permintaan</th>
                                <th>Status</th>
                                <th>Aksi</th> <!-- Tambahkan kolom aksi -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($requests as $request) : ?>
                                <tr>
                                    <td><?php echo $request['ID_Permintaan']; ?></td>
                                    <td><?php echo $request['Nama_Barang']; ?></td>
                                    <td><?php echo $request['Jumlah']; ?></td>
                                    <td><?php echo $request['Tanggal_Permintaan']; ?></td>
                                    <td><?php echo $request['Status']; ?></td>
                                    <td>
                                        <button class="btn btn-primary change-status" data-id="<?php echo $request['ID_Permintaan']; ?>" data-status="Approved">Approve</button>
                                        <button class="btn btn-danger change-status" data-id="<?php echo $request['ID_Permintaan']; ?>" data-status="Rejected">Reject</button>
                                    </td> <!-- Tambahkan tombol aksi -->
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <p>No pending requests.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>

<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script>
    $(document).ready(function() {
    $('.change-status').click(function() {
        var id = $(this).data('id');
        var status = $(this).data('status');
        $.ajax({
            url: '<?php echo site_url("inventory/approve"); ?>/' + id,
            method: 'POST',
            data: { status: status },
            success: function(response) {
                location.reload(); // Reload halaman setelah status diubah
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
});
    $(document).ready(function() {
        $('#servis_mesin_ringan_table').DataTable();
    });
    $(document).ready(function() {
        $('#ganti_oli_table').DataTable();
    });
    $(document).ready(function() {
        $('#ac_mobil_table').DataTable();
    });
    $(document).ready(function() {
        $('[data-toggle="collapse"]').on('click', function() {
            var target = $(this).attr('href');
            $(target).toggleClass('show');
        });

        $('#menuBtn').on('click', function() {
            $('#sidebar').toggleClass('small');
            $('.header').toggleClass('small');
            $('.main-content').toggleClass('small');
            $('.footer').toggleClass('small');
        });
    });
    $(document).ready(function() {
        $('.change-status').click(function() {
            var id = $(this).data('id');
            var status = $(this).data('status');
            $.ajax({
                url: '<?php echo site_url("inventory/change_status"); ?>',
                method: 'POST',
                data: {
                    id: id,
                    status: status
                },
                success: function(response) {
                    location.reload(); // Reload halaman setelah status diubah
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });

    function printReport() {
    var printContents = document.getElementById('report-content').innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
}

function checkNotificationStatus() {
    $.ajax({
        url: '<?php echo site_url('inventory/check_notifications'); ?>', // Sesuaikan URL dengan rute yang benar
        method: 'GET',
        success: function(data) {
            let notificationList = $('#notificationList');
            notificationList.empty();

            data.forEach(function(notification) {
                let listItem = $('<li class="list-group-item"></li>');
                listItem.text(notification.message);
                notificationList.append(listItem);
            });
        },
        error: function(error) {
            console.error('Error fetching notifications:', error);
        }
    });
}

</script>

<script>
        $(document).ready(function() {
            $('#barangKeluarTable').DataTable();
        });
    </script>
</body>

</html>