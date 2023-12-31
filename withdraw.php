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
    <!-- Include any necessary styles or scripts here -->
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
            background:linear-gradient(to bottom, rgba(66, 67, 60, 0.2), rgba(55, 55, 55, 0.8)),url('withdraw.jpg') repeat center fixed;
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
    <h1>Make a Withdrawal</h1>
    <form method="post" action="">
        <label for="account_number">Account Number:</label>
        <input type="text" id="account_number" name="account_number" required>
        <br>
        <label for="withdrawal_amount">Withdrawal Amount:</label>
        <input type="text" id="withdrawal_amount" name="withdrawal_amount" required>
        <br>
        <button type="submit">Withdraw</button>
    </form>
    </div>
    </div>
</body>
</html>

<?php
    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $account_number = $_POST['account_number'];
        $withdrawal_amount = $_POST['withdrawal_amount'];

        // Validate and sanitize user input (add more validation as needed)
        if (!is_numeric($withdrawal_amount) || $withdrawal_amount <= 0) {
            echo "Invalid withdrawal amount. Please enter a valid amount.";
        } elseif (!isValidAccount($account_number, $conn)) {
            echo "Invalid account number. Please enter a valid account number.";
        } else {
            // Check if the account has sufficient balance for withdrawal
            $sql = "SELECT balance FROM accounts WHERE account_number = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $account_number);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            $current_balance = $row['balance'];

            if ($withdrawal_amount > $current_balance) {
                echo "Insufficient balance for withdrawal.";
            } else {
                // Proceed with the withdrawal
                // Update the balance in the database based on the account number
                $sql = "UPDATE accounts SET balance = balance - ? WHERE account_number = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ds", $withdrawal_amount, $account_number);

                if ($stmt->execute()) {
                    echo "Withdrawal of $" . $withdrawal_amount . " was successful.";
                } else {
                    echo "Error processing the withdrawal: " . $stmt->error;
                }

                $stmt->close();
            }
        }
    }
    ?>