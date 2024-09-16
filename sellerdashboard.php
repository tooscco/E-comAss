<!-- <div>welcome</div> -->
<?php
require 'sellerconnect.php';
session_start();

echo $_SESSION['seller_id'];
$id=$_SESSION['seller_id'];

$query="SELECT * FROM seller_table WHERE seller_id= ?";
$dbconnect=$sellercon->prepare($query);
$dbconnect->bind_param('i', $id);
$dbconnect->execute();
$result=$dbconnect->get_result();
$user=$result->fetch_assoc();
// print_r($user);


//  print_r($user['firstname']);
if(isset($_POST['submit_das'])){

    $pic=$_FILES['productpic']['name'];
    $temp=$_FILES['productpic']['tmp_name'];
    $newpic=time().$pic;
    $move=move_uploaded_file($temp, 'images/'.$newpic);
    $name=$_POST['productname'];
    $price=$_POST['productprice'];
    $description=$_POST['productdescription'];
    $query="INSERT INTO `products_table` (`seller_id`, `productpic`, `productname`, `productdesc`, `productprice`) VALUES (?,?,?,?,?)";
        // print_r($query);
    $dbdash=$sellercon->prepare($query);
    $dbdash->bind_param('issss', $id, $newpic, $name, $description, $price);
    $dbdash->execute();
    if($dbdash){
        echo 'Product successfully inserted';
    }
    else{
        echo 'query not ran:'.$sellercon->error;
    }

                    // OR
    // if(move_uploaded_file($temp, 'images/'.$newpic)){
    //     $name=$_POST['productname'];
    //     $price=$_POST['productprice'];
    //     $description=$_POST['productdescription'];
    //     $query="INSERT INTO `products_table` (`seller_id`, `productpic`, `productname`, `productdesc`, `productprice`) VALUES (?,?,?,?,?)";
    //     // print_r($query);
    //     $dbdash=$sellercon->prepare($query);
    // }
    // if($dbdash === false){
    //     die('Prepare failed: ' . $sellercon->error);
    // }

    // $dbdash->bind_param('issss', $id, $newpic, $name, $description, $price);

    // if($dbdash->execute()){
    //     echo 'Product successfully inserted';
    // }
    // else{
    //     echo 'query not ran:'.$sellercon->error;
    // } 
   
}
$query="SELECT * FROM products_table WHERE seller_id=?";
$dbconnect=$sellercon->prepare($query);
$dbconnect->bind_param('i', $id);
$dbconnect->execute();
$result=$dbconnect->get_result();
$sellers=$result->fetch_all(MYSQLI_ASSOC);

if(isset($_POST['submit_del'])){
    $del = intval ($_POST['product_id']);
    $query="DELETE FROM `products_table` WHERE `product_id`=$del";
    $dbdel=$sellercon->query($query);
    if($dbdel){
        echo 'Note deleted successfully';
    }
    else{
        echo 'Failed to delete note:'.$sellercon->error;
    }
}

$editseller = [];

if(isset($_POST['submit_edit'])){
    echo $_SESSION['product_id'] = $_POST['product_id'];
    $proEdit = $_SESSION['product_id'];
    $query="SELECT * FROM products_table WHERE product_id=$proEdit";
    $dbpro=$sellercon->query($query);
    if($dbpro->num_rows>0){
        $editseller=$dbpro->fetch_assoc();
        $showModal = true;
    }
    else{
        echo 'Data not found';
        $showModal = false;
    }
}

if(isset($_POST['submit_editId'])){
    $proEdit=$_SESSION['product_id'];
    $pix = $sellercon->real_escape_string($_FILES['pic']['name']); 
    $pixtemp = $_FILES['pic']['tmp_name'];
    // print_r($pixtemp);
    $newpix=time().'_'.$pix;
    // print_r($newpix);
    $movepix=move_uploaded_file($pixtemp, 'images/'.$newpix);
    $name=$sellercon->real_escape_string($_POST['name']);
    $desc=$sellercon->real_escape_string($_POST['desc']);
    $price=$sellercon->real_escape_string($_POST['price']);
    $query="UPDATE `products_table` SET `productpic`= $newpix , `productname`=$name, `productdesc`= $desc, `productprice`= $price WHERE product_id= $proEdit";
    $dbedit=$sellercon->query($query);
    if($dbedit){
        echo 'working';
    }
    else{
        echo 'not working:'.$sellercon->error;
    }

}

// print_r($notes);

// foreach ($notes as $note) {
//     $productpic = $note['productpic'];
//     $productname = $note['productname'];
//     $productprice = $note['productprice'];
//     $productdesc = $note['productdesc'];
//     echo "<br>Product Picture: $productpic";
//     echo "<br>Product Name: $productname";
//     echo "<br>Product Price: $productprice";
//     echo "<br>Product Description: $productdesc";
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        a{
            text-decoration: none;
        }
        .hove:hover{
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <div>
        <div class="d-flex justify-content-between mx-4 mt-3">
            <h5>Welcome <span><?php echo $user['firstname'] ?></span></h5>
            <h5>Seller Id: <?php echo $user['seller_id']?></h5>
        </div>
        <div class="d-flex justify-content-center my-5">
        <div class="col-6 border shadow p-3 ms-3">
            <h5 class="text-success text-center">Add Product Here</h5>
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" class="col-10 mx-auto" enctype="multipart/form-data">
                <input type="file" name="productpic" placeholder="Product Picture" class="form-control my-2">
                <input type="text" name="productname" placeholder="Enter Product Name" class="form-control my-2">
                <input type="text" name="productprice" placeholder="Product Price" class="form-control">
                <input type="text" name="productdescription" placeholder="Enter Product Description" class="form-control my-2">
                <input type="submit" name="submit_das" value="Add Produts" class="btn btn-outline-success w-100">
            </form>
        </div>
        </div>
    </div>

    <!-- Modal -->
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method='POST' enctype="multipart/form-data">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content w-75 h-75">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Note</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="file" placeholder="Product Picture" class="form-control mb-4 shadow-none" name="pic" value="<?php echo isset($proEdit['productpic']) ? htmlspecialchars($proEdit['productpic']) : ''; ?>" required>
                    <input type="text" placeholder="Product Name" class="form-control mb-4 shadow-none" name="name" value="<?php echo isset($editnote['productname']) ? htmlspecialchars($editnote['productname']) : ''; ?>" required>
                    <input type="text" placeholder="Product Description" class="form-control mb-4 shadow-none" name="desc" value="<?php echo isset($editnote['productdesc']) ? htmlspecialchars($editnote['productdesc']) : ''; ?>" required>
                    <input type="text" placeholder="Product price" name="price" class="form-control shadow-none mb-3" value="<?php echo isset($editnote['productprice']) ? htmlspecialchars($editnote['productprice']) : ''; ?>" required>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="submit_editId" class="btn btn-primary" value="Save changes">
                </div>
            </div>
        </div>
    </div>
</form>

<?php if (isset($showModal) && $showModal): ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {});
            myModal.show();
        });
    </script>
<?php endif; ?>

    <div class='col-10 mx-auto mb-3'>
        <h4 class="text-center mb-3">Goods uploaded</h4>
        <div class="flex-wrap d-flex gap-4">
        <?php foreach($sellers as $seller): ?>
        <div class="card" style="width: 15rem;">
            <img src="<?php echo 'images/'.$seller['productpic']; ?>" class="card-img-top" alt="image" style='height:200px;'>
        <div class="card-body">
            <a href=""><h6 class="card-title">Seller Id: <?php echo $seller['seller_id']; ?></h6></a>
        </div>
            <ul class="list-group list-group-flush">
             <li class="list-group-item hove"><?php echo $seller['productname']; ?></li>
            <li class="list-group-item"><?php echo $seller['productdesc'];?></li>
            <li class="list-group-item fs-5 fw-bold">#<?php echo $seller['productprice'];?></li>
        </ul>
        <div class="card-body d-flex justify-content-between">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $seller['product_id'];?>">
            <input type="submit" name="submit_edit" class="btn btn-success py-1 px-3" value="Edit">
        </form>
        
        <form action="<?php echo $_SERVER['PHP_SELF'] ;?>" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $seller['product_id'] ;?>">
            <input type="submit" name="submit_del" value="Delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this this card?')">
        </form>
        </div>
        </div>
        <?php endforeach; ?>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>