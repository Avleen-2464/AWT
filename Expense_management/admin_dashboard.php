<?php
session_start();
include 'db.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit;
}


$current_month = date('Y-m');
$query = "SELECT * FROM expenses WHERE DATE_FORMAT(date_added, '%Y-%m') = '$current_month'";
$expenses = $conn->query($query);


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['amount_spent'])) {
    $amount_spent = $_POST['amount_spent'];
    $expense_id = $_POST['expense_id'];

    
    $update_query = "UPDATE expenses SET amount = amount + '$amount_spent' WHERE id = '$expense_id'";

    if ($conn->query($update_query)) {
        echo "<div class='alert alert-success'>Amount added successfully!</div>";
        $expenses = $conn->query($query); 
    } else {
        echo "<div class='alert alert-danger'>Error adding amount: " . $conn->error . "</div>";
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['new_item_name'])) {
    $new_item_name = $_POST['new_item_name'];

    
    $insert_query = "INSERT INTO expenses (item_name, amount, date_added) VALUES ('$new_item_name', 0, CURDATE())";

    if ($conn->query($insert_query)) {
        echo "<div class='alert alert-success'>New item added successfully!</div>";
        $expenses = $conn->query($query); 
    } else {
        echo "<div class='alert alert-danger'>Error adding item: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https:
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Admin Dashboard</h2>

        <div class="d-flex justify-content-between mb-4">
            <div></div>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>

        <!-- Compare Expenses Button -->
        <div class="mb-4">
            <a href="compare_expenses.php" class="btn btn-info">Compare Expenses</a>
        </div>

        <!-- Add New Item Form -->
        <div class="card p-4 mb-4">
            <h3>Add New Item</h3>
            <form method="POST" action="admin_dashboard.php">
                <div class="mb-3">
                    <label for="new_item_name" class="form-label">Item Name</label>
                    <input type="text" name="new_item_name" id="new_item_name" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Item</button>
            </form>
        </div>

        <!-- List of Expenses -->
        <div class="card p-4">
            <h3 class="mb-4">Expenses for <?php echo date('F Y'); ?></h3>
            <table class="table table-bordered table-hover">
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
                        <td><?php echo $row['amount']; ?></td>
                        <td>
                            <form method="POST" action="admin_dashboard.php">
                                <input type="number" name="amount_spent" class="form-control" required>
                                <input type="hidden" name="expense_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="btn btn-success mt-2">Add</button>
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
