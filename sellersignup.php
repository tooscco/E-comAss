<?php 
 require 'sellerconnect.php';
 session_start();

 if (isset($_POST['submit_seller'])) {
    $fname=$_POST['firstname'];
    $lname=$_POST['lastname'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $pnumber=$_POST['number'];
    $gender=$_POST['gender'];
    $birthday=$_POST['birthday'];
    $agreed = isset($_POST['agreeTerm']) ? 1 : 0;

    $query="SELECT * FROM `seller_table` WHERE email=?";
    $dbseller=$sellercon->prepare($query);
    $dbseller->bind_param('s',$email);
    $execute=$dbseller->execute();
    if($dbseller){
        $user=$dbseller->get_result();
        if($user->num_rows>0){
            $_SESSION['msg']='Email exists';
            header('location: seller.php');
            echo "email exists";
        }
        else{
            $hashed=password_hash($password,PASSWORD_DEFAULT);

    $query= "INSERT INTO `seller_table`(`firstname`, `lastname`, `email`, `password`, `phonenumber`, `gender`, `birthday`, `checkbox`) VALUES(?,?,?,?,?,?,?,?)";
    // print_r($query);
    $dbseller=$sellercon->prepare($query);
    $dbseller->bind_param('ssssssss', $fname, $lname, $email, $hashed, $pnumber, $gender, $birthday, $agreed);
    $execute=$dbseller->execute();
    // print_r($dbseller);
   if($dbseller){
        header('location:sellersignin.php');
        // echo $dbseller.'successfully inserted';
    }
    else{
        echo 'query not ran:'.$sellercon->error;
    }
        }
    }
    else{
        echo 'query not ran';
    }

 }
 else{
    header('Location:seller.php');
 }
?>