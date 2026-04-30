<?php
include "db.php";

if (isset($_POST['submit'])) {
    $date = $_POST['date'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];

    $sql = "INSERT INTO expenses (date, description, amount)
            VALUES ('$date', '$description', '$amount')";

    if ($conn->query($sql) === TRUE) {
        echo "Expense added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Expense</title>
</head>
<body>

<h2>Add Expense</h2>

<form method="POST">
    <label>Date:</label><br>
    <input type="date" name="date" required><br><br>

    <label>Description:</label><br>
    <input type="text" name="description" required><br><br>

    <label>Amount:</label><br>
    <input type="number" step="0.01" name="amount" required><br><br>

    <button type="submit" name="submit">Add Expense</button>
</form>

</body>
</html>