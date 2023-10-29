<?php
require_once "./includes/config.php";

// Perform SQL JOIN operation on budgets and expenses tables using a common key (e.g., 'id')
$sql = "SELECT budgets.id, budgets.user_id, budgets.item_name, budgets.quantity, budgets.budget_price, expenses.actual_price
        FROM budgets
        LEFT JOIN expenses ON budgets.id = expenses.id AND budgets.user_id = expenses.user_id";

$result = $conn->query($sql);

// Check if the query executed successfully
if ($result) {
    // Loop through the results and compare values
    while ($row = $result->fetch_assoc()) {
        $id = (int)$row['id'];
        $user_id = (int)$row['user_id'];
        $quantity = (int)$row['quantity'];
        $item_name = $row['item_name'];
        $budgetAmount = (float)$row['budget_price'];
        $expenseAmount = (float)$row['actual_price'];

        // Compare budget and expense amounts
        $difference = $budgetAmount - $expenseAmount;

        // Get column names dynamically
        $columns = array('budget_price', 'actual_price');

        // Construct and execute the INSERT query
        $insertSql = "INSERT INTO reports (id, user_id, item_name, quantity, " . implode(", ", $columns) . ", differences) VALUES ('$id', '$user_id', '$item_name', '$quantity', '$budgetAmount', '$expenseAmount', '$difference')";
        $conn->query($insertSql);
    }

    // Close the result set
    $result->close();
} else {
    // Handle SQL query error
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();

?>