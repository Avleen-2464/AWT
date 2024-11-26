<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compare Expenses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h2 class="text-center mb-0">Compare Expenses</h2>
            </div>
            <div class="card-body">
                <!-- Form to Select Months -->
                <form method="POST" action="compare_expenses.php" class="mb-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="month1" class="form-label">Select First Month</label>
                            <select class="form-select" id="month1" name="month1" required>
                                <option value="">Choose...</option>
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
                            <label for="month2" class="form-label">Select Second Month</label>
                            <select class="form-select" id="month2" name="month2" required>
                                <option value="">Choose...</option>
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
                    <button type="submit" class="btn btn-primary mt-3 w-100">Compare</button>
                </form>

                <!-- Display Results -->
                <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>
                    <div class="row g-4">
                        <!-- Month 1 Table -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Expenses for <?php echo date('F Y', strtotime($month1)); ?> <span class="badge bg-primary"><?php echo $total_amount_month1; ?></span></h5>
                                </div>
                                <div class="card-body p-0">
                                    <table class="table table-hover table-striped mb-0">
                                        <thead>
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
                            </div>
                        </div>

                        <!-- Month 2 Table -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Expenses for <?php echo date('F Y', strtotime($month2)); ?> <span class="badge bg-secondary"><?php echo $total_amount_month2; ?></span></h5>
                                </div>
                                <div class="card-body p-0">
                                    <table class="table table-hover table-striped mb-0">
                                        <thead>
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
                        </div>
                    </div>

                    <!-- Chart Section -->
                    <div class="card mt-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Expenses Comparison Chart</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="expensesChart" height="200"></canvas>
                            <script>
                                const ctx = document.getElementById('expensesChart').getContext('2d');
                                new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: ['<?php echo date('F Y', strtotime($month1)); ?>', '<?php echo date('F Y', strtotime($month2)); ?>'],
                                        datasets: [{
                                            label: 'Total Expenses',
                                            data: [<?php echo $total_amount_month1; ?>, <?php echo $total_amount_month2; ?>],
                                            backgroundColor: ['rgba(75, 192, 192, 0.5)', 'rgba(153, 102, 255, 0.5)'],
                                            borderColor: ['rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)'],
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            y: { beginAtZero: true }
                                        }
                                    }
                                });
                            </script>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
