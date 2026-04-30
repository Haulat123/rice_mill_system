<?php
include "db.php";

// Total expenses
$total_query = "SELECT SUM(amount) as total_expense FROM expenses";
$total_result = $conn->query($total_query);
$total_row = $total_result->fetch_assoc();

$total_expense = $total_row['total_expense'] ?? 0;

// Get all expenses
$sql = "SELECT * FROM expenses ORDER BY date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Expenses</title>
</head>
<body>

<h2>Expenses</h2>

<h2>Total Expenses: <?php echo $total_expense; ?></h2>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Date</th>
        <th>Description</th>
        <th>Amount</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row['expense_id']."</td>
                    <td>".$row['date']."</td>
                    <td>".$row['description']."</td>
                    <td>".$row['amount']."</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No expenses found</td></tr>";
    }
    ?>

</table>

</body>
</html>