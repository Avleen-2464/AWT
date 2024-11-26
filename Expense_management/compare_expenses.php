<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}


$query = "SELECT DISTINCT DATE_FORMAT(date_added, '%Y-%m') AS month FROM expenses ORDER BY month DESC";
$months_result = $conn->query($query);


$month1 = '';
$month2 = '';


$total_amount_month1 = 0;
$total_amount_month2 = 0;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $month1 = $_POST['month1'];
    $month2 = $_POST['month2'];

    
    $query1 = "SELECT item_name, SUM(amount) AS total_amount FROM expenses WHERE DATE_FORMAT(date_added, '%Y-%m') = '$month1' GROUP BY item_name";
    $query2 = "SELECT item_name, SUM(amount) AS total_amount FROM expenses WHERE DATE_FORMAT(date_added, '%Y-%m') = '$month2' GROUP BY item_name";

    $expenses_month1 = $conn->query($query1);
    $expenses_month2 = $conn->query($query2);

    
    while ($expense = $expenses_month1->fetch_assoc()) {
        $total_amount_month1 += $expense['total_amount'];
    }

    while ($expense = $expenses_month2->fetch_assoc()) {
        $total_amount_month2 += $expense['total_amount'];
    }

    
    $expenses_month1->data_seek(0);
    $expenses_month2->data_seek(0);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Compare Expenses</title>
    <link href="https:
    <script src="https:
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Compare Expenses</h2>

        <form method="POST" action="compare_expenses.php" class="mb-4">
            <div class="row">
                <div class="col">
                    <select class="form-select" name="month1" required>
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
                <div class="col">
                    <select class="form-select" name="month2" required>
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
            <button type="submit" class="btn btn-primary mt-3">Compare</button>
        </form>

        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>
            <h4>Expenses for <?php echo date('F Y', strtotime($month1)); ?></h4>
            <h5>Total Amount: <?php echo $total_amount_month1; ?></h5>
            <table class="table table-bordered">
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
                            <td colspan="2">No expenses found for this month.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <h4>Expenses for <?php echo date('F Y', strtotime($month2)); ?></h4>
            <h5>Total Amount: <?php echo $total_amount_month2; ?></h5>
            <table class="table table-bordered">
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
                            <td colspan="2">No expenses found for this month.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <!-- Chart Section -->
            <h4>Expenses Comparison Chart</h4>
            <canvas id="expensesChart" width="400" height="200"></canvas>
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
</body>
</html>
