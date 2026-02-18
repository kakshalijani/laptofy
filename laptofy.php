<?php
include("connection.php");
error_reporting(0);
if(isset($_POST["Insert"]))
{
    
    $folder="img/".$img;

    $qry=mysqli_query($con,"INSERT INTO `laptofy` (`id`, `name`, `description`, `img`, `price`, `status`) VALUES ('$id', '$name', '$description', '$folder', '$price', '$status');")or die ("query error");
    if($qry){
        echo "<script>alert('record insert successfully');</script>";
    }
}
if(isset($_POST["delete"])){
    
    $qry=mysqli_query($con,"DELETE FROM laptofy WHERE `laptofy`.`id` = $id") or die("query error");
    if($qry){
        echo "<script>alert('record delete successfully');</script>";
    }
}
if(isset($_POST["update"])){
    
        $folder="img/".$img;
        $qry=mysqli_query($con,"UPDATE `laptofy` SET `name` = '$name', `description` = '$description', `img` = '$folder', `price` = '$price', `status` = '$status' WHERE `laptofy`.`id` = $id;")or die ("query error");
 
    if($qry){
        echo "<script>alert('record update successfully');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>smart laptop. smart shopping</title>
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
    <td><input type="text" name="id" value="<?php echo $id; ?>"></td>
</tr>
<tr>
    <td>enter name</td>
    <td><input type="text" name="name" value="<?php echo $name; ?>"></td>
</tr>
<tr>
    <td>enter description</td>
    <td><input type="text" name="description" value="<?php echo $description; ?>"></td>
</tr>
<tr>
    <td>select image</td>
    <td><input type="file" name="img" img src="<?php echo $folder; ?>"width="120"></td>
</tr>
<tr>
    <td>enetr price</td>
    <td><input type="text" name="price" value="<?php echo $price; ?>"></td>
</tr>
<tr>
    <td>enter status</td>
    <td><select name="status">
        <option value="Active">Active</option>
        <option value="Inactive">Inactive</option>
</select></td>
</tr>
<tr>
    <td colspan="2" align="center">
        <input type="submit" name="insert" value="insert">
        <input type="submit" name="delete" value="delete">
        <input type="submit" name="update" value="update">
</td>
</tr>
</table>
</form>
</body>
</html>