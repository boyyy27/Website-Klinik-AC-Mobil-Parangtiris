<div class="main-content">
    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header">
                    <h1 style="color: black; font-size: 2rem;">Data member</h1>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="member_table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Nomor Telepon</th>
                                    <th>Role</th>
                                    <th>Login</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($members as $index => $m): ?>
                                    <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td><?php echo $m['Nama']; ?></td>
                                        <td>
                                            <?php 
                                                if (!empty($m['Email'])) {
                                                    echo $m['Email'];
                                                } else {
                                                    echo $m['google_email'];
                                                }
                                            ?>
                                        </td>                                        
                                        <td><?php echo $m['Nomor_Telepon']; ?></td>
                                        <td><?php echo $m['Role']; ?></td>
                                        <td><?php echo $m['Login']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>