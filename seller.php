<?php  
require 'sellerconnect.php';
session_start();  

if (isset($_GET['route']) && $_GET['route'] == 'home') {  
    header('Location: home.php');  
    exit();  
} 
if(isset($_GET['route']) && $_GET['route']== 'login'){
    header('Location: sellersignin.php'); 
    exit(); 
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        .l:hover {
            text-decoration: underline;
        }
        a{
            text-decoration: none;
        }
        .l{
            text-shadow: 1px 1px 0 #ff0000;
              font-size:30px
        }
    </style>
</head>
<body>
    <div>
        <div class='d-flex justify-content-between m-4'>
            <div class='d-flex gap-4 ms-3'>
                <h4><a href="?route=home">Home</a></h4>
                <h4><a href="#">About</a></h4>
                <h4><a href="#">Contact</a></h4>
            </div>
            <div class='d-flex'>
                <h4><a href="#" class=' l' >TEEBOY</a></h4>
            </div>
            <div class='d-flex gap-4 me-3'>
                <h4><a href="#">Help</a></h4>
                <h4><a href="#">Setting</a></h4>
                <h4><a href="?route=login">Login</a></h4>
            </div>
        </div>
    </div>

    <div>
        <div class='mx-auto text-center mb-5'>
            <h3>TEEBOY Welcome You To The Seller Page🤝</h3>
        </div>
        <div class="container">
            <form action="sellersignup.php" method='POST' class="col-8 border flex mx-auto shadow p-3">
            <div class="col-10 mx-auto">
                <h1 class="text-success text-center" >Sign Up Here</h1>
                <div>

                </div>
                <div>
                    <label for="firstname">First Name:</label>
                    <input type="text" name="firstname" id="firstname" placeholder='Enter your first name' class="form-control my-2 shadow-none" required>
                </div>
                <div>
                    <label for="lastname">Last Name:</label>
                    <input type="text" name="lastname" id="lastname" placeholder='Enter your last name' class="form-control my-2 shadow-none" required>
                </div>
                <div>
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" placeholder='Enter your email' class="form-control my-2 shadow-none" required>
                </div>
                <div>
                    <label for="pass">Password:</label>
                    <input type="password" name='password' id="password" placeholder='Enter your password' class="form-control my-2 shadow-none" required>
                </div>
                <div>
                    <label for="number">Phone Number</label>
                    <input type="number" name="number" id="number" placeholder="Phone number" class="form-control my-2 shadow-none" required>
                </div>
                <div class="my-3 d-flex">
                    <label for="gender" class="me-4">Gender-:</label>
                    <div class="d-flex">
                        <div class="me-3">
                            <label for="male">Male:</label>
                            <input type="radio" name="gender" id="male" value="Male" required>
                        </div>
                        <div class="me-3">
                            <label for="female">Female:</label>
                            <input type="radio" name="gender" id="female" value="Female">
                        </div>
                        <div>
                            <label for="other">Other:</label>
                            <input type="radio" name="gender" id="other" value="Other">
                        </div>
                    </div>
                </div>
                <div">
                    <label for="dob">Date of Birth:</label>  
                    <input type="date" id="dob" name="birthday" class="my-2 ms-2" required>
                 </div>
                 <div class="mb-3 col-10 mx-auto">
                    <input type="checkbox" name="agreeTerm" required class="my-2 mx-2" id="agreeTerm">  <label for="agreeTerm"> I agree to follow the Terms and Conditions</label>
                 </div>
                <div class="col-10 mx-auto">
                    <input type="submit" name="submit_seller" class="btn btn-outline-success w-100" value="Sign Up">
                </div>
             </div>
            </form>
        </div>
    </div>
</body>
</html>