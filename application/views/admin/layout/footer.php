<div class="footer">
        <p>2001 Copyright by PARANGTRITIS KLINIK AC MOBIL</p>
    </div>
    <script>
    function printReport() {
        var printContents = document.getElementById('report-content').innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>
    <!-- Rest of the suku_cadang view content -->

<div class="modal fade" id="requestModal" tabindex="-1" aria-labelledby="requestModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="requestModalLabel">Konfirmasi Permintaan Sparepart</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin membuat permintaan untuk <span id="sparepart-name"></span> ke inventory?
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="confirm-request">Buat Permintaan</button>
                </div>
            </div>
        </div>
    </div>
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
                    <?php if (!empty($check)) : ?>
                        <table class="table table-hover table-bordered" id="requests_table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID Permintaan</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($check as $d) : ?>
                                    <tr>
                                        <td><?php echo $d['ID_Permintaan']; ?></td>
                                        <td><?php echo $d['Nama_Barang']; ?></td>
                                        <td><?php echo $d['Jumlah']; ?></td>
                                        <td><?php echo $d['Status']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else : ?>
                        <p>No pending requests.</p>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
       function confirmRequest(sparepart_id, sparepart_name) {
        document.getElementById('sparepart-name').innerText = sparepart_name;
        var requestButton = document.getElementById('confirm-request');
        requestButton.onclick = function() {
            window.location.href = '<?php echo site_url('admin/request_sparepart/'); ?>' + sparepart_id;
        };
        var requestModal = new bootstrap.Modal(document.getElementById('requestModal'));
        requestModal.show();
    }
$(document).ready(function() {
    $('#suku_cadang_table, #member_table, #transactions_table').DataTable({
        "pagingType": "full_numbers"
    });
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

    function printReport() {
        var printContents = document.getElementById('report-content').innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
    function checkNotificationStatus() {
        $.ajax({
            url: '<?php echo site_url('admin/check_notifications'); ?>',
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
    $(document).ready(function() {
        function calculateTotal() {
            var amount = parseFloat($('#amount').val()) || 0;
            var sparepartPrice = parseFloat($('#sparepart option:selected').data('harga')) || 0;
            var total = amount + sparepartPrice;
                $('#total_display').text(total.toLocaleString('en-US', { minimumFractionDigits: 0, maximumFractionDigits: 0 }));
            return total;
        }

        $('#amount, #sparepart').on('input change', function() {
            calculateTotal();
        });

        $('#transactionForm').on('submit', function(e) {
            var total = calculateTotal();
            var points = 0;
            if ($('input[name="status"]:checked').val() === 'member' && total > 90000) {
                points = 1;
            }
            $('#points').val(points);
        });
    });

    // Event listener untuk mengubah tampilan berdasarkan perubahan input status
    document.querySelectorAll('input[name="status"]').forEach((elem) => {
        elem.addEventListener("change", function(event) {
            var value = event.target.value;
            var userDiv = document.getElementById("user_id_div");
            if (value === "member") {
                userDiv.style.display = "block";
            } else {
                userDiv.style.display = "none";
            }
        });
    });
});
</script>


</body>
</html>