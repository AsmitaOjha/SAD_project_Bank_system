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
            /* overflow: hidden; */
            display:flex;
            justify-content: center;
            /* position: fixed; Add position: fixed to make the navigation bar fixed */
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
            background-color: #555;
        }
        body{
            
            font-family:Arial, sans-serif;
            margin:0;
            padding:0;
            overflow-y: auto;
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
            display:flex;
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
    <div class="container1">
    <h1>Welcome to RAW Bank</h1>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Error tempore nemo fugit.</p>
    <span>Find out more</span>
    </div>
    <div class="container2">
    <form>
        <input type="text" placeholder="your name">
        <input type="text" placeholder="your email">
        <input type="text" placeholder="your phone">
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ratione non quis omnis quos mollitia delectus tempore repudiandae recusandae illum. Fuga mollitia est consectetur illo error. Voluptatem hic dolor delectus sed.
        <button>Submit</button>
    </form>
    </div>
    </div>
    <!-- Your page content goes here -->

</body>
</html>
