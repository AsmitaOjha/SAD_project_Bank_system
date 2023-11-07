<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$database = "bank_system";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $database);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to generate a random 10-digit account number
function generateAccountNumber() {
    return strval(mt_rand(1000000000, 9999999999));
}

// Handle form submission

?>


<!DOCTYPE html>
<html>
<head>
 <style>
            /* Style for the navigation bar */
            .navbar {
                background-color: #333;
                overflow: hidden;
                display:flex;
                justify-content: center;
            }

            /* Style for the navigation bar links */
            .navbar a {
                
                display: block;
                color: white;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
            }

            /* On hover, change the background color of the links */
            .navbar a:hover {
                background-color:orangered;
            }
 </style>
</head>
<body>
<div class="navbar">
        <a href="index.php">Home</a>
        <a href="create_account.php">Create Account</a>
        <a href="deposit.php">Deposit</a>
        <a href="transfer.php">Transfer</a>
        <a href="withdraw.php">Withdraw</a>
    </div>
    <h1>Create Account</h1>
    <form method="post" action="">
        <label for="account_holder">Account Holder Name:</label>
        <input type="text" id="account_holder" name="account_holder" required>

        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number" required>

        <label for="initial_balance">Initial Balance:</label>
        <input type="text" id="initial_balance" name="initial_balance" required>

        <button type="submit">Create Account</button>
    </form>
    <?php
    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Generate a unique 10-digit account number
        $account_number = generateAccountNumber();

        // Get user input from the form
        $account_holder = $_POST['account_holder'];
        $phone_number = $_POST['phone_number'];
        $initial_balance = $_POST['initial_balance'];

        // Validate and sanitize user input (add more validation as needed)

        // Insert data into the database
        $sql = "INSERT INTO accounts (account_number, account_holder, phone_number, balance) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdi", $account_number, $account_holder, $phone_number, $initial_balance);

        if ($stmt->execute()) {
            // Account created successfully
            echo "\n Account created successfully for " . $account_holder . ". Your account number is: " . $account_number;
        } else {
            // Error handling for account creation
            echo "Error creating account: " . $stmt->error;
        }

        $stmt->close();
    }
    ?>

</body>
</html>
