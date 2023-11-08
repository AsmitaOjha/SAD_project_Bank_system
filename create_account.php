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
            background:linear-gradient(to bottom, rgba(66, 67, 60, 0.2), rgba(55, 55, 55, 0.8)),url('dollar tree.jpg') no-repeat center fixed;
            background-size:cover;
            width:100%;
            height:100vh;
            color: #000;
            padding-top:30px;
            /* padding-left: 50px; */
            align-items:center;
            
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
    <h1>Create Account</h1>
    <form method="post" action="">
        <label for="account_holder">Account Holder Name:</label>
        <input type="text" id="account_holder" name="account_holder" required>
            <br>
        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number" required>
            <br>
        <label for="initial_balance">Initial Balance:</label>
        <input type="text" id="initial_balance" name="initial_balance" required>
            <br>
        <button type="submit">Create Account</button>
    </form>
    </div>
 </div>
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
