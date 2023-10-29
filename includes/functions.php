<?php


// To validate the user inputs from the form
function input_validator($data) {
    trim($data);
    stripslashes($data);
    htmlspecialchars($data);
    return $data;
}


// To register a user based on the personal information provided
function register($firstname, $lastname, $email, $password) {
    global $conn;
    
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "SELECT email FROM users WHERE email = '$email'";
    if (mysqli_num_rows(mysqli_query($conn, $sql)) > 0) {
        return "exists";
    } else {
        $query = "INSERT INTO users(firstname, lastname, email, password)
                VALUES('$firstname', '$lastname', '$email', '$password')";
        if (mysqli_query($conn, $query)) {
            return "success";
        } else {
            return "error";
        }
        
    }
}


// To login a user based on the credentials supplied
function login($username, $password) {
    global $conn;
    // check if user exists in the database
    $query = "SELECT id, firstname, email, password FROM users WHERE email = ?";
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) == 1) {
                // If user exists with the email verify password
                mysqli_stmt_bind_result($stmt, $id, $firstname, $email, $hashed_password);
                if (mysqli_stmt_fetch($stmt)) {
                    if (password_verify($password, $hashed_password)) {
                        session_start();
                        $_SESSION['loggin'] = true;
                        $_SESSION['user_id'] = $id;
                        $_SESSION['firstname'] = $firstname;
                        header("Location: index.php");
                    } else {
                        return "Invalid";
                    }
                }
            } else {
                return "Invalid";
            }
        } else {
            return "Errors";
        }
        mysqli_stmt_close($stmt);
    }
}

// To check if the current user as accepted license agreements
function proceed($agreement) {
    if (!empty($agreement)) {
        return true;
    } else {
        return false;
    }
}


// To display the audit report from the database
function displayStatements($id, $table) {

    global $conn;

    $display = "SELECT * FROM $table WHERE user_id = '$id'";
    return mysqli_query($conn, $display);
}


// Generate repoprts by comparing values of different tables and storing the differences in another table
function makeReports() {
    global $conn;
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
}


// Clorize numerical fields based on its value
function colorize($data) {
    $color = "text-danger";
    if ($data > 0)
        $color = "text-success";
    return $color;
}
?>