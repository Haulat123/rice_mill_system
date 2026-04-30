<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include "db.php";
// 🔥 Calculate stock balance
$in_query = "SELECT SUM(quantity) as total_in FROM stock WHERE type='IN'";
$out_query = "SELECT SUM(quantity) as total_out FROM stock WHERE type='OUT'";

$in_result = $conn->query($in_query);
$out_result = $conn->query($out_query);

$in_row = $in_result->fetch_assoc();
$out_row = $out_result->fetch_assoc();

$total_in = $in_row['total_in'] ?? 0;
$total_out = $out_row['total_out'] ?? 0;

$balance = $total_in - $total_out;

// Total Sales
$sales_query = "SELECT SUM(total_amount) as total_sales FROM sales";
$sales_result = $conn->query($sales_query);
$sales_row = $sales_result->fetch_assoc();
$total_sales = $sales_row['total_sales'] ?? 0;

// Total Expenses
$expense_query = "SELECT SUM(amount) as total_expense FROM expenses";
$expense_result = $conn->query($expense_query);
$expense_row = $expense_result->fetch_assoc();
$total_expense = $expense_row['total_expense'] ?? 0;

// Profit
$profit = $total_sales - $total_expense;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>


<div class="container">

<h1>Rice Mill Dashboard</h1>
<?php if ($balance < 20): ?>
    <h2 style="color: red;">⚠️ Low Stock Alert! Only <?php echo $balance; ?> bags remaining</h2>
<?php endif; ?>

<div class="cards">

    <div class="card">
        <h2>Total Sales</h2>
        <p><?php echo $total_sales; ?></p>
    </div>

    <div class="card">
        <h2>Total Expenses</h2>
        <p><?php echo $total_expense; ?></p>
    </div>

    <div class="card">
        <h2>Profit</h2>
        <p><?php echo $profit; ?></p>
    </div>

</div>

<div class="nav">
    <a href="add_stock.php">Add Stock</a>
    <a href="view_stock.php">View Stock</a>
    <a href="add_sales.php">Add Sales</a>
    <a href="view_sales.php">View Sales</a>
    <a href="add_expense.php">Add Expense</a>
    <a href="view_expense.php">View Expenses</a>
</div>

</div>
<a href="logout.php">Logout</a>


</body>
</html>