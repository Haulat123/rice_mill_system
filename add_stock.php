<?php
include "db.php";

if (isset($_POST['submit'])) {
    $date = $_POST['date'];
    $type = $_POST['type'];
    $quantity = $_POST['quantity'];

    $sql = "INSERT INTO stock (date, type, quantity) 
            VALUES ('$date', '$type', '$quantity')";

    if ($conn->query($sql) === TRUE) {
        echo "Stock added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Stock</title>
</head>
<body>

<h2>Add Stock</h2>

<form method="POST">
    <label>Date:</label><br>
    <input type="date" name="date" required><br><br>

    <label>Type:</label><br>
    <select name="type">
        <option value="IN">IN (Stock In)</option>
    </select><br><br>

    <label>Quantity:</label><br>
    <input type="number" name="quantity" required><br><br>

    <button type="submit" name="submit">Add Stock</button>
</form>

</body>
</html>