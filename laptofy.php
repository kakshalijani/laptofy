<?php
include "connection.php";
error_reporting(0);
if(isset($_POST["insert"]))
{
    $id=$_POST["id"];
    $name=$_POST["name"];
    $description=$_POST["description"];
    $img=$_FILES["img"]["name"];
    $price=$_POST["price"];
    $status=$_POST["status"];
    $folder="img/".$img;
    move_uploaded_file($_FILES["img"]["tmp_name"],$folder);
    $qry=mysqli_query($con,"SELECT * FROM laptofy WHERE id='$id'") or die("query error");

    if(mysqli_num_rows($qry)>0){
        echo "<script>alert('id already exist');</script>";
    }else{
        $qry=mysqli_query($con,"INSERT INTO `laptofy` (`id`, `name`, `description`, `img`, `price`, `status`) VALUES ('$id', '$name', '$description', '$folder', '$price', '$status');")or die ("query error");
        if($qry){
            echo "<script>alert('record inserted successfully');</script>";
            header("location:display.php");
        }
    }
}
if(isset($_POST["display"])){
    header("location:display.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>smart laptop. smart shopping</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <table border="1" align="center">
            <tr>
                <td colspan="2" align="center">
                    <h1>LAPTOFY</h1>
</td>
</tr>
<tr>
    <td>enter Id</td>
    <td><input type="number"  name="id" required></td>
</tr>
<tr>
    <td>enter name</td>
    <td><input type="text" name="name" required></td>
</tr>
<tr>
    <td>enter description</td>
    <td><input type="text" name="description" required></td>
</tr>
<tr>
    <td>select image</td>
    <td><input type="file" name="img" required></td>
</tr>
<tr>
    <td>enetr price</td>
    <td><input type="text" name="price" required></td>
</tr>
<tr>
    <td>enter status</td>
    <td><select name="status" id="" required>
        <option value="Active">Active</option>
        <option value="Inactive">Inactive</option>
</select></td>
</tr>
<tr>
    <td colspan="2" class="btn-center">
        <input type="submit" name="insert" value="insert">
        <input type="submit" name="display" value="view list" formnovalidate>
</td>
</tr>
</table>
</form>
</body>
</html>
