<!DOCTYPE html>
<html>
<head>
    <title>Compare Expenses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container mt-5">
        <!-- Header -->
        <div class="text-center mb-4">
            <h2 class="text-primary">Compare Expenses</h2>
        </div>

        <!-- Compare Form -->
        <form method="POST" action="compare_expenses.php" class="mb-4">
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="month1" class="form-label">Select Month 1</label>
                    <select id="month1" class="form-select" name="month1" required>
                        <option value="">Select Month 1</option>
                        <?php 
                        $months_result->data_seek(0); 
                        while ($row = $months_result->fetch_assoc()) { ?>
                            <option value="<?php echo $row['month']; ?>" <?php echo ($month1 == $row['month']) ? 'selected' : ''; ?>>
                                <?php echo date('F Y', strtotime($row['month'])); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="month2" class="form-label">Select Month 2</label>
                    <select id="month2" class="form-select" name="month2" required>
                        <option value="">Select Month 2</option>
                        <?php 
                        $months_result->data_seek(0); 
                        while ($row = $months_result->fetch_assoc()) { ?>
                            <option value="<?php echo $row['month']; ?>" <?php echo ($month2 == $row['month']) ? 'selected' : ''; ?>>
                                <?php echo date('F Y', strtotime($row['month'])); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Compare</button>
            </div>
        </form>

        <!-- Results Section -->
        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>
            <div class="row mb-4">
                <div class="col-md-6">
                    <h4>Expenses for <?php echo date('F Y', strtotime($month1)); ?></h4>
                    <h5>Total Amount: <span class="text-success"><?php echo $total_amount_month1; ?></span></h5>
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>Item</th>
                                <th>Total Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($expenses_month1->num_rows > 0) {
                                while ($expense = $expenses_month1->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $expense['item_name']; ?></td>
                                        <td><?php echo $expense['total_amount']; ?></td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan="2" class="text-center">No expenses found for this month.</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <div class="col-md-6">
                    <h4>Expenses for <?php echo date('F Y', strtotime($month2)); ?></h4>
                    <h5>Total Amount: <span class="text-success"><?php echo $total_amount_month2; ?></span></h5>
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>Item</th>
                                <th>Total Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($expenses_month2->num_rows > 0) {
                                while ($expense = $expenses_month2->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $expense['item_name']; ?></td>
                                        <td><?php echo $expense['total_amount']; ?></td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan="2" class="text-center">No expenses found for this month.</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Chart Section -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h4 class="card-title">Expenses Comparison Chart</h4>
                    <canvas id="expensesChart" width="400" height="200"></canvas>
                </div>
            </div>
            <script>
                const ctx = document.getElementById('expensesChart').getContext('2d');
                const chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['<?php echo date('F Y', strtotime($month1)); ?>', '<?php echo date('F Y', strtotime($month2)); ?>'],
                        datasets: [{
                            label: 'Total Expenses',
                            data: [<?php echo $total_amount_month1; ?>, <?php echo $total_amount_month2; ?>],
                            backgroundColor: [
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)'
                            ],
                            borderColor: [
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        <?php } ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
