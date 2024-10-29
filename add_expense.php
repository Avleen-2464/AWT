<!-- <?php
session_start();
include 'db.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_name = $_POST['item_name'];
    $amount = $_POST['amount'];
    $user_id = $_SESSION['user_id'];  // Admin adding the expense

    // Insert into the expenses table
    $query = "INSERT INTO expenses (item_name, amount, user_id, date_added) 
              VALUES ('$item_name', '$amount', '$user_id', CURDATE())";
    
    if ($conn->query($query) === TRUE) {
        // Redirect to the dashboard after successful addition
        header('Location: admin_dashboard.php');
        exit;
    } else {
        $error_message = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Expense</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Add New Expense</h2>

        <?php if (isset($error_message)): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error_message; ?>
        </div>
        <?php endif; ?>

        <!-- Add Expense Form -->
        <div class="card p-4">
            <form method="POST" action="add_expense.php">
                <div class="mb-3">
                    <label for="item_name" class="form-label">Item Name:</label>
                    <input type="text" class="form-control" id="item_name" name="item_name" placeholder="Enter item name" required>
                </div>
                <div class="mb-3">
                    <label for="amount" class="form-label">Amount:</label>
                    <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter amount" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Add Expense</button>
            </form>
        </div>

        <div class="text-center mt-3">
            <a href="admin_dashboard.php" class="btn btn-primary">Back to Dashboard</a>
        </div>
    </div>
</body>
</html> -->
