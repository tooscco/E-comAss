<?php
require 'sellerconnect.php';
session_start();

if (isset($_GET['route']) && $_GET['route'] == 'home') {  
    header('Location: home.php');  
    exit();  
}

if (isset($_GET['route']) && $_GET['route'] == 'signup') {  
    header('Location: seller.php');  
    exit();  
}

 if(isset($_POST['submit_signin'])){
    $email=$_POST['email'];
    $password=$_POST['password'];

    $query="SELECT * FROM `seller_table` WHERE email=?";
    $prepare=$sellercon->prepare($query);
    $prepare->bind_param('s', $email);
    $prepare->execute();
    $sel=$prepare->get_result();
    if($sel){
        if($sel->num_rows>0){
            $user=$sel->fetch_assoc();
            // print_r($user['password']);
            $hashedpassword= $user['password'];
            $password_verify=password_verify($password,$hashedpassword);

            if($password_verify){
                $_SESSION['seller_id']=$user['seller_id'];
                header('location: sellerdashboard.php');
            }
            else{
                echo 'Incorrect email or password';
            }
        }
        else{
            echo 'Incorrect email or password';
        }
    }
    else{
        echo 'Errors running queries'. $sellercon->error;
    }
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signin Page</title>
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
                <h4><a href="?route=signup">Sign Up</a></h4>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="col-8 border flex mx-auto shadow p-3">
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                <div class="col-10 mx-auto">
                    <h1 class="text-success text-center">Sign In Here</h1>
                    <div>
                        <label for="email">Email:</label>
                        <input type="email" placeholder="Email" name="email" id="email" class="form-control my-2 shadow-none" required>
                    </div>
                    <div>
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" placeholder="Password" class="form-control my-2 shadow-none mb-3">
                    </div>
                    <div class=" mx-auto">
                    <input type="submit" name="submit_signin" class="btn btn-outline-success w-100" value="Sign In">
                </div>
                </div>

            </form>
        </div>
    </div>
</body>
</html>