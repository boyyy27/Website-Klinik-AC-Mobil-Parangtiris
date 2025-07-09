<div class="main-content">
    <div class="container mt-5">
        <div class="row">
            <!-- Card 1 -->
            <div class="col-md-4">
                <div class="card bg-primary text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Users</h5>
                        <p class="card-text"><?php echo $totalUsers; ?></p>
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="col-md-4">
                <div class="card bg-success text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Transactions</h5>
                        <p class="card-text"><?php echo $totalTransactions; ?></p>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="col-md-4">
                <div class="card bg-warning text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Points</h5>
                        <p class="card-text"><?php echo $totalPoints; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Transactions Table -->
        <div class="row mt-4">
            <div class="col-md-12">
                <h3>Recent Transactions</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Amount</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recentTransactions as $transaction) : ?>
                            <tr>
                                <td><?php echo $transaction['transaction_id']; ?></td>
                                <td><?php echo !empty($transaction['Username']) ? $transaction['Username'] : 'Non Member'; ?></td>
                                <td>
                                    <?php
                                    if ($transaction['amount'] < 100) {
                                        echo $transaction['amount'] . ' points';
                                    } else {
                                        echo 'Rp' . number_format($transaction['amount'], 2);
                                    }
                                    ?>
                                </td>
                                <td><?php echo $transaction['date']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Requests Table -->
        <div class="row mt-4">
            <div class="col-md-12">
                <h3>Recent Requests</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Spare Part</th>
                            <th>Quantity</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recentRequests as $request) : ?>
                            <tr>
                                <td><?php echo $request['ID_Permintaan']; ?></td>
                                <td><?php echo $request['ID_Barang']; ?></td>
                                <td><?php echo $request['Jumlah']; ?></td>
                                <td><?php echo $request['Tanggal_Permintaan']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
