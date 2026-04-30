<?php
include "db.php";

// 🔥 Calculate total revenue
$total_query = "SELECT SUM(total_amount) as total_sales FROM sales";
$total_result = $conn->query($total_query);
$total_row = $total_result->fetch_assoc();

$total_sales = $total_row['total_sales'] ?? 0;

// Get all sales records
$sql = "SELECT * FROM sales ORDER BY date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Sales</title>
</head>
<body>

<h2>Sales Records</h2>

<!-- 🔥 TOTAL REVENUE -->
<h2>Total Revenue: <?php echo $total_sales; ?></h2>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Date</th>
        <th>Bags Sold</th>
        <th>Price per Bag</th>
        <th>Total Amount</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row['sale_id']."</td>
                    <td>".$row['date']."</td>
                    <td>".$row['bags_sold']."</td>
                    <td>".$row['price_per_bag']."</td>
                    <td>".$row['total_amount']."</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No sales found</td></tr>";
    }
    ?>

</table>

</body>
</html>