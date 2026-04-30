<?php
include "db.php";

if (isset($_POST['submit'])) {
    $date = $_POST['date'];
    $bags = $_POST['bags'];
    $price = $_POST['price'];

    // 🔥 Get current stock balance
    $in_query = "SELECT SUM(quantity) as total_in FROM stock WHERE type='IN'";
    $out_query = "SELECT SUM(quantity) as total_out FROM stock WHERE type='OUT'";

    $in_result = $conn->query($in_query);
    $out_result = $conn->query($out_query);

    $in_row = $in_result->fetch_assoc();
    $out_row = $out_result->fetch_assoc();

    $total_in = $in_row['total_in'] ?? 0;
    $total_out = $out_row['total_out'] ?? 0;

    $balance = $total_in - $total_out;

    // ❌ Prevent overselling
    if ($bags > $balance) {
        echo "Error: Not enough stock available!";
    } else {
        $total = $bags * $price;

        // Reduce stock
        $stock_sql = "INSERT INTO stock (date, type, quantity)
                      VALUES ('$date', 'OUT', '$bags')";
        $conn->query($stock_sql);

        // Insert sale
        $sql = "INSERT INTO sales (date, bags_sold, price_per_bag, total_amount)
                VALUES ('$date', '$bags', '$price', '$total')";

        if ($conn->query($sql) === TRUE) {
            echo "Sale recorded successfully!";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
    

?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Sales</title>
</head>
<body>

<h2>Record Sale</h2>

<form method="POST">
    <label>Date:</label><br>
    <input type="date" name="date" required><br><br>

    <label>Bags Sold:</label><br>
    <input type="number" name="bags" required><br><br>

    <label>Price per Bag:</label><br>
    <input type="number" name="price" step="0.01" required><br><br>

    <button type="submit" name="submit">Record Sale</button>
</form>

</body>
</html>