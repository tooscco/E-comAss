<?php 
$host='localhost';
$username='root';
$password='';
$db='ecomass_db';

$sellercon=new mysqli($host, $username, $password, $db);
if(!$sellercon){
    echo 'Connection failed'.$sellercon->connect_error;
}
else{
echo 'connected';
}
?>