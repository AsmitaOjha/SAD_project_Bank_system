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
            /* background-color: #555; */
            background-color:orangered;
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
            justify-content: space-around;
            
        }
        .container1{
            width:40%;
            margin-top: 100px;
            height: 250px;
           
        }
        .container1 h1{
            font-size: 40px;
        }
        .container1 span{
            /* color:rgb(175, 48, 2); */
            color:orangered;
        }
        .container1 p{
            font-size:12px;
        }
        .container1 button{
            color:whitesmoke;
            /* background-color: orangered; */
            background-color: rgb(68, 66, 66);
            border:none;
            margin-top: 3px;
            margin-left: 7px;
            height: 30px;
            
        }
       
        .container2{
            width:40%;
            margin-top:100px;
            border:1px solid rgb(68, 66, 66);
            background-color: rgb(68, 66, 66);
            color:whitesmoke;
            height: 250px;
            padding:10px;
        }
        .container2 form input{
          margin: 5px 55px;
            text-align:center;
            
        }
        .container2 p{
            margin: 0 55px;
            font-size: 12px;
            text-align:justify;
        }
        .container2 button{
            color:whitesmoke;
            background-color: orangered;
            border:none;
            margin-top: 3px;
            margin-left: 55px;
            height: 30px;
            
        }
                /* Apply styles to increase the height of text input */
        input[type="text"]{
            height: 30px; /* You can adjust the height as needed */
            width: 400px;
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
        <br>
        <br>
    <h1>Welcome to  <span>RAW</span> Bank</h1>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Error tempore nemo fugit.</p>
    <button>Find out more</button>
    </div>
    <div class="container2">
    <form>
   
        <input type="text" placeholder="your name" >
        <input type="text" placeholder="your email" >
        <input type="text" placeholder="your phone" >
        <br>
    </form>
    <br>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ratione non quis omnis quos mollitia delectus tempore repudiandae recusandae illum. Fuga mollitia est consectetur illo error. Voluptatem hic dolor delectus sed.</p> <br>
        <button>Submit</button>
    
    </div>
    </div>
    <!-- Your page content goes here -->

</body>
</html>
