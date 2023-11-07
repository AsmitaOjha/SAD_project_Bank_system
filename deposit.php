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

// Function to validate the account number
function isValidAccount($account_number, $conn) {
    // You should implement proper validation here
    // For this example, we assume the account exists
    $sql = "SELECT * FROM accounts WHERE account_number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $account_number);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}



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

    <h1>Make a Deposit</h1>
    <form method="post" action="">
        <label for="account_number">Account Number:</label>
        <input type="text" id="account_number" name="account_number" required>

        <label for="deposit_amount">Deposit Amount:</label>
        <input type="text" id="deposit_amount" name="deposit_amount" required>

        <button type="submit">Deposit</button>
    </form>
</body>
</html>
<?php
    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $account_number = $_POST['account_number'];
        $deposit_amount = $_POST['deposit_amount'];

        // Validate and sanitize user input (add more validation as needed)
        if (!is_numeric($deposit_amount) || $deposit_amount <= 0) {
            echo "Invalid deposit amount. Please enter a valid amount.";
        } elseif (!isValidAccount($account_number, $conn)) {
            echo "Invalid account number. Please enter a valid account number.";
        } else {
            // Proceed with the deposit
            // Update the balance in the database based on the account number
            $sql = "UPDATE accounts SET balance = balance + ? WHERE account_number = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ds", $deposit_amount, $account_number);

            if ($stmt->execute()) {
                
                echo "Deposit of $" . $deposit_amount . " was successful to .";
                // echo "Transfer of $" . $transfer_amount . " from $sender_name to $recipient_name was successful.";
            } else {
                echo "Error processing the deposit: " . $stmt->error;
            }

            $stmt->close();
        }
    }
    ?>
