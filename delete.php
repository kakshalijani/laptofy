<?php
include "connection.php";
if(isset($_GET["id"]) && !isset($_GET["confirm"])){
    $id=$_GET["id"];
    echo "<script>
            if(confirm('Are you sure you want to delete this record?')){
                window.location.href='delete.php?id=$id&confirm=yes';
            } else {
                window.location.href='display.php';
            }
          </script>";
} else if(isset($_GET["id"]) && isset($_GET["confirm"]) && $_GET["confirm"] == "yes"){
    $id=$_GET["id"];
    $qry=mysqli_query($con,"DELETE FROM laptofy WHERE id='$id'") or die("query error");
    if($qry){
        echo "<script>alert('record deleted successfully');</script>";
        header("location:display.php");
    }
}
?>


