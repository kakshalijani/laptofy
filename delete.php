<?php
include "connection.php";
if(isset($_GET["id"])){
    $id=$_GET["id"];
    
    $qry=mysqli_query($con,"DELETE FROM laptofy WHERE `laptofy`.`id` = $id") or die("query error");
    if($qry){
        echo "<script>alert('record delete successfully');</script>";
        header("location:display.php");
    }
}
?>

