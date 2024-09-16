<?php
require 'sellerconnect.php';
session_start();

echo $_SESSION['seller_id'];
$id=$_SESSION['seller_id'];

if (isset($_GET['route']) && $_GET['route'] == 'seller') {  
    header('Location: seller.php');  
    exit();  
} 

$query="SELECT * FROM products_table ";
$dbcon=$sellercon->prepare($query); 
$dbcon->execute();
$result=$dbcon->get_result();
$dbconn=$result->fetch_all(MYSQLI_ASSOC);
// print_r($dbconn);
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
        .hove:hover{
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <div>
        <div class='d-flex justify-content-between m-4'>
            <div class='d-flex gap-4 ms-3'>
                <h4><a href="#">Home</a></h4>
                <h4><a href="#">About</a></h4>
                <h4><a href="#">Contact</a></h4>
                <h4><a href="?route=seller">Seller</a></h4>
            </div>
            <div class='d-flex'>
                <h4><a href="#" class=' l' >TEEBOY</a></h4>   
            </div>
            <div class='d-flex gap-4 me-3'>
                <h4><a href="#">Help</a></h4>
                <h4><a href="#">Setting</a></h4>
                <h4><a href="#">Sign Up</a></h4>
                <h4><a href="#">Login</a></h4>
            </div>
        </div>
    </div>

    <div>
        <div class='mx-auto text-center'>
            <h3>Welcome to TEEBOY Shopping Mall 🤝</h3>
        </div>
    </div>

    <div class='col-10 mx-auto my-5'>
        <!-- <h4 class="text-center mb-3">Goods uploaded</h4> -->
        <div class="flex-wrap d-flex gap-4">
        <?php foreach($dbconn as $note): ?>
        <div class="card" style="width: 15rem;">
            <img src="<?php echo 'images/'.$note['productpic']; ?>" class="card-img-top" alt="image" style='height:200px;'>
        <div class="card-body">
            <a href=""><h6 class="card-title">Seller Id: <?php echo $note['seller_id']; ?></h6></a>
        </div>
            <ul class="list-group list-group-flush">
             <li class="list-group-item hove"><?php echo $note['productname']; ?></li>
            <li class="list-group-item"><?php echo $note['productdesc'];?></li>
            <li class="list-group-item fs-5 fw-bold">#<?php echo $note['productprice'];?></li>
        </ul>
        </div>
        <?php endforeach; ?>
</body>
</html>