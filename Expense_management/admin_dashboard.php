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
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary">Admin Dashboard</h2>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>

        <!-- Compare Expenses Button -->
        <div class="text-end mb-4">
            <a href="compare_expenses.php" class="btn btn-info">Compare Expenses</a>
        </div>

        <!-- Add New Item Form -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Add New Item</h5>
                <form method="POST" action="admin_dashboard.php">
                    <div class="mb-3">
                        <label for="new_item_name" class="form-label">Item Name</label>
                        <input type="text" name="new_item_name" id="new_item_name" class="form-control" placeholder="Enter item name" required>
                    </div>
                    <button type="submit" class="btn btn-success">Add Item</button>
                </form>
            </div>
        </div>

        <!-- Expenses Table -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Expenses for <?php echo date('F Y'); ?></h5>
                <table class="table table-bordered table-striped mt-3">
                    <thead class="table-dark">
                        <tr>
                            <th>Item</th>
                            <th>Total Amount</th>
                            <th>Add Amount Spent</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($expenses && $expenses->num_rows > 0) { ?>
                            <?php while ($row = $expenses->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row['item_name']; ?></td>
                                <td><?php echo $row['amount']; ?></td>
                                <td>
                                    <form method="POST" action="admin_dashboard.php" class="d-flex">
                                        <input type="number" name="amount_spent" class="form-control me-2" placeholder="Enter amount" required>
                                        <input type="hidden" name="expense_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                    </form>
                                </td>
                            </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="3" class="text-center text-muted">No expenses found for this month.</td>
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
