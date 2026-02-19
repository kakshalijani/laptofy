<?php
$con=mysqli_connect("localhost","root","","laptofy");
if($con){
    echo "connection successful";
}
else{
    die("connection failed".mysqli_connect_error());
}
?>