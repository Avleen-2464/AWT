<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 1200px;
        }
        h2, h3 {
            font-weight: 600;
            color: #343a40;
        }
        .btn {
            border-radius: 8px;
        }
        .table-hover tbody tr:hover {
            background-color: #f1f3f5;
        }
        .table-primary {
            background-color: #007bff !important;
            color: white;
        }
        .logout-btn {
            display: flex;
            justify-content: flex-end;
        }
        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .table {
            border-radius: 8px;
            overflow: hidden;
        }
        .btn-info {
            background-color: #17a2b8;
            border: none;
        }
        .btn-info:hover {
            background-color: #138496;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-5">Admin Dashboard</h2>

        <!-- Logout Button -->
        <div class="logout-btn mb-3">
            <a href="logout.php" class="btn btn-danger"><i class="bi bi-box-arrow-right"></i> Logout</a>
        </div>

        <!-- Compare Expenses Button -->
        <div class="mb-4 text-center">
            <a href="compare_expenses.php" class="btn btn-info btn-lg"><i class="bi bi-bar-chart"></i> Compare Expenses</a>
        </div>

        <!-- Add New Item Form -->
        <div class="card p-4 mb-5">
            <h3 class="mb-3">Add New Item</h3>
            <form method="POST" action="admin_dashboard.php">
                <div class="row g-3">
                    <div class="col-md-10">
                        <input type="text" name="new_item_name" id="new_item_name" class="form-control" placeholder="Enter Item Name" required>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100"><i class="bi bi-plus-circle"></i> Add</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- List of Expenses -->
        <div class="card p-4">
            <h3 class="mb-4">Expenses for <?php echo date('F Y'); ?></h3>
            <table class="table table-bordered table-hover text-center">
                <thead>
                    <tr class="table-primary">
                        <th>Item</th>
                        <th>Total Amount</th>
                        <th>Add Amount Spent</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $expenses->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['item_name']; ?></td>
                        <td>₹<?php echo $row['amount']; ?></td>
                        <td>
                            <form method="POST" action="admin_dashboard.php" class="d-flex align-items-center">
                                <input type="number" name="amount_spent" class="form-control" style="max-width: 100px;" required>
                                <input type="hidden" name="expense_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="btn btn-success ms-2"><i class="bi bi-cash-stack"></i> Add</button>
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS and Icons -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
</body>
</html>
