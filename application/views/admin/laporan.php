<div class="main-content">
    <div class="container mt-5">
        <h3>Transaction Report</h3>
        <div class="form-container p-4 bg-light border rounded mb-4">
            <form method="get" action="<?php echo site_url('admin/laporan'); ?>">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="date_from">Date From</label>
                            <input type="date" class="form-control" id="date_from" name="date_from" value="<?php echo set_value('date_from'); ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="date_to">Date To</label>
                            <input type="date" class="form-control" id="date_to" name="date_to" value="<?php echo set_value('date_to'); ?>">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Filter</button>
                <button type="button" class="btn btn-secondary" onclick="printReport()">Print Report</button>
            </form>
        </div>

        <?php if (!empty($transactions)) : ?>
            <div id="report-content">
                <div class="text-center mb-4">
                    <h4>LAPORAN PARANGTIRIS</h4>
                    <p style="color: #4B4B4B;">Laporan dari <?php echo $this->input->get('date_from'); ?> sampai dengan <?php echo $this->input->get('date_to'); ?>.</p>
                </div>
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
                        <?php foreach ($transactions as $transaction) : ?>
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
        <?php else : ?>
            <div class="alert alert-warning" role="alert">
                No transactions found for the selected period.
            </div>
        <?php endif; ?>
    </div>
</div>
            