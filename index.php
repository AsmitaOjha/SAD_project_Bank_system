<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank</title>
</head>
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
            background-color: #555;
        }
        body{
            font-family:Arial, sans-serif;
            margin:0;
            padding:0;
        }
        .content-container{
            background:linear-gradient(to bottom, rgba(66, 67, 60, 0.2), rgba(55, 55, 55, 0.8)),url('cash.jpg') no-repeat center fixed;
            background-size:cover;
            width:100%;
            height:100vh;
            display:flex;
            justify-content:center;
             /* align-items:center;  */
            color: #000;
        }
       

    </style>
</head>
<body>
    <!-- Navigation bar -->
    <div class="navbar">
        <a href="#">Home</a>
        <a href="create_account.php">Create Account</a>
        <a href="deposit.php">Deposit</a>
        <a href="transfer.php">Transfer</a>
        <a href="withdraw.php">Withdraw</a>
    </div>
    <div class='content-container'>
    <h1>Welcome to RAW Bank</h1>
   
    </div>
    <!-- Your page content goes here -->

</body>
</html>
