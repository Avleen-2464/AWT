<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary">Family Dashboard</h2>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>

        <!-- Compare Expenses Button -->
        <div class="d-flex justify-content-end mb-4">
            <a href="compare_expenses.php" class="btn btn-info"><i class="bi bi-bar-chart"></i> Compare Expenses</a>
        </div>

        <!-- Expenses Table -->
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Expenses for <?php echo date('F Y'); ?></h4>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Item</th>
                            <th>Total Amount</th>
                            <th>Add Amount Spent</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($expenses->num_rows > 0) {
                            while ($row = $expenses->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $row['item_name']; ?></td>
                                    <td><?php echo $row['amount']; ?></td>
                                    <td>
                                        <form method="POST" action="family_dashboard.php" class="d-flex align-items-center gap-2">
                                            <input type="number" name="amount_spent" class="form-control" placeholder="Enter amount" required>
                                            <input type="hidden" name="expense_id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" class="btn btn-success">Add</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="3" class="text-center">No expenses found for this month.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Success/Error Alert Section -->
        <?php if (isset($_POST['amount_spent'])) { ?>
            <div class="mt-4">
                <?php if ($conn->query($update_query)) { ?>
                    <div class="alert alert-success">Amount added successfully!</div>
                <?php } else { ?>
                    <div class="alert alert-danger">Error adding amount: <?php echo $conn->error; ?></div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
