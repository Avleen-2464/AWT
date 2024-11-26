<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary">Admin Dashboard</h2>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>

        <!-- Compare Expenses Button -->
        <div class="d-flex justify-content-end mb-4">
            <a href="compare_expenses.php" class="btn btn-info"><i class="bi bi-bar-chart"></i> Compare Expenses</a>
        </div>

        <!-- Add New Item Section -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Add New Item</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="admin_dashboard.php">
                    <div class="mb-3">
                        <label for="new_item_name" class="form-label">Item Name</label>
                        <input type="text" name="new_item_name" id="new_item_name" class="form-control" placeholder="Enter item name" required>
                    </div>
                    <button type="submit" class="btn btn-success">Add Item</button>
                </form>
            </div>
        </div>

        <!-- Expenses List -->
        <div class="card shadow-sm">
            <div class="card-header bg-secondary text-white">
                <h4 class="mb-0">Expenses for <?php echo date('F Y'); ?></h4>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Item</th>
                            <th>Total Amount</th>
                            <th>Add Amount Spent</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $expenses->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row['item_name']; ?></td>
                            <td><?php echo $row['amount']; ?></td>
                            <td>
                                <form method="POST" action="admin_dashboard.php" class="d-flex align-items-center gap-2">
                                    <input type="number" name="amount_spent" class="form-control" placeholder="Enter amount" required>
                                    <input type="hidden" name="expense_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </form>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
