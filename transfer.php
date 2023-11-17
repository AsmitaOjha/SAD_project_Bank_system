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
    $sql = "SELECT * FROM accounts WHERE account_number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $account_number);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}

// Function to get the account holder's name by account number
function getAccountHolderName($account_number, $conn) {
    $sql = "SELECT account_holder FROM accounts WHERE account_number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $account_number);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['account_holder'];
    }
    return "Unknown"; // Return "Unknown" if account not found
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
                position: fixed; /* Add position: fixed to make the navigation bar fixed */ 
                width: 100%; /* Make the navigation bar span the full width of the viewport */
                top: 0; /* Position it at the top of the viewport */
                z-index: 1000; /* Ensure it's above other elements */
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
            body{
            
            font-family:Arial, sans-serif;
            margin:0;
            padding:0;
            overflow-y: auto;
        }
        .container{
            background:linear-gradient(to bottom, rgba(66, 67, 60, 0.2), rgba(55, 55, 55, 0.8)),url('transfer.jpg') repeat center fixed;
            background-size:cover;
            width:100%;
            height:100vh;
            color: #000;
            padding-top:30px;
        }
        .container1{
            /* border: 3px solid black; */
           margin: 20px 40px;
            display:flex;
            flex-direction: column;
            padding: 10px 20px;
        }
        form input{
            margin: 5px 0px;
        }
            button{
            color:whitesmoke;
            background-color: orangered;
            border:none;
            margin-top: 3px;
            margin-left: 55px;
            height: 30px;
        }
        button:active{
            background-color: gray;
        }
    </style>
    <!-- Include any necessary styles or scripts here -->
</head>
<body>
<div class="navbar">
        <a href="index.php">Home</a>
        <a href="create_account.php">Create Account</a>
        <a href="deposit.php">Deposit</a>
        <a href="transfer.php">Transfer</a>
        <a href="withdraw.php">Withdraw</a>
    </div>
<div class="container">
    <div class="container1">
    <h1>Make a Transfer</h1>
    <form method="post" action="">
        <label for="sender_account">Sender Account Number:</label>
        <input type="text" id="sender_account" name="sender_account" required>

        <label for="recipient_account">Recipient Account Number:</label>
        <input type="text" id="recipient_account" name="recipient_account" required>

        <label for="transfer_amount">Transfer Amount:</label>
        <input type="text" id="transfer_amount" name="transfer_amount" required>

        <button type="submit">Transfer</button>
    </form>
    </div>
    </div>
   
</body>
</html>
<?php
// ... (your database connection and functions)

$transfer_success = false;  // Initialize the variable

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sender_account = htmlspecialchars($_POST['sender_account']);
    $recipient_account = htmlspecialchars($_POST['recipient_account']);
    $transfer_amount = htmlspecialchars($_POST['transfer_amount']);

    // Validate and sanitize user input
    if (!is_numeric($transfer_amount) || $transfer_amount <= 0) {
        echo "Invalid transfer amount. Please enter a valid amount.";
    } elseif (!isValidAccount($sender_account, $conn) || !isValidAccount($recipient_account, $conn)) {
        echo "Invalid sender or recipient account number. Please enter valid account numbers.";
    } else {
        // Check if the sender account has sufficient balance for the transfer
        $sql = "SELECT balance FROM accounts WHERE account_number = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $sender_account);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $sender_balance = $row['balance'];

        if ($transfer_amount > $sender_balance) {
            echo "Insufficient balance for the transfer.";
        } else {
            // Proceed with the transfer
            // Update the sender's and recipient's balances in the database
            $sql_sender = "UPDATE accounts SET balance = balance - ? WHERE account_number = ?";
            $stmt_sender = $conn->prepare($sql_sender);
            $stmt_sender->bind_param("ds", $transfer_amount, $sender_account);

            $sql_recipient = "UPDATE accounts SET balance = balance + ? WHERE account_number = ?";
            $stmt_recipient = $conn->prepare($sql_recipient);
            $stmt_recipient->bind_param("ds", $transfer_amount, $recipient_account);

            $conn->begin_transaction();
            
            // Execute the SQL queries and check for errors
            $transfer_success = $stmt_sender->execute() && !$stmt_sender->error &&
                                $stmt_recipient->execute() && !$stmt_recipient->error;

            if ($transfer_success) {
                $conn->commit();
                $sender_name = htmlspecialchars(getAccountHolderName($sender_account, $conn));
                $recipient_name = htmlspecialchars(getAccountHolderName($recipient_account, $conn));
                echo "Transfer of $" . $transfer_amount . " from $sender_name to $recipient_name was successful.";
            } else {
                $conn->rollback();
                echo "Error processing the transfer. Please try again later.";
                echo "Sender Error: " . $stmt_sender->error;
                echo "Recipient Error: " . $stmt_recipient->error;
            }

            $stmt_sender->close();
            $stmt_recipient->close();
        }
    }
}
?>
t