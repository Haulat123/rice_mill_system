<?php
include "db.php";


$in_query = "SELECT SUM(quantity) as total_in FROM stock WHERE type='IN'";
$out_query = "SELECT SUM(quantity) as total_out FROM stock WHERE type='OUT'";

$in_result = $conn->query($in_query);
$out_result = $conn->query($out_query);

$in_row = $in_result->fetch_assoc();
$out_row = $out_result->fetch_assoc();

$total_in = $in_row['total_in'] ?? 0;
$total_out = $out_row['total_out'] ?? 0;

$balance = $total_in - $total_out;

// existing code
$sql = "SELECT * FROM stock ORDER BY date DESC";
$result = $conn->query($sql);
?>


$sql = "SELECT * FROM stock ORDER BY date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Stock</title>
</head>
<body>

<h2>Stock Records</h2>
<h3>Total Stock IN: <?php echo $total_in; ?></h3>
<h3>Total Stock OUT: <?php echo $total_out; ?></h3>
<h2>Current Balance: <?php echo $balance; ?></h2>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Date</th>
        <th>Type</th>
        <th>Quantity</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row['stock_id']."</td>
                    <td>".$row['date']."</td>
                    <td>".$row['type']."</td>
                    <td>".$row['quantity']."</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No records found</td></tr>";
    }
    ?>

</table>

</body>
</html>