<?php
include "connection.php";
error_reporting(0);

if (isset($_POST["insert"])) {

    $id = $_POST["id"];
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $status = $_POST["status"];

    $imageArray = [];

    foreach ($_FILES["img"]["name"] as $key => $imageName) {
        $tmpName = $_FILES["img"]["tmp_name"][$key];

        if (!empty($imageName)) {
            move_uploaded_file($tmpName, "img/" . $imageName);
            $imageArray[] = $imageName;
        }
    }

    $folder = implode(",", $imageArray);

    $check = mysqli_query($con, "SELECT id FROM laptofy WHERE id='$id'");

    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('ID already exists');</script>";
    } else {

        $qry = mysqli_query(
            $con,
            "INSERT INTO laptofy (id, name, description, img, price, status)
             VALUES ('$id','$name','$description','$folder','$price','$status')"
        );

        if ($qry) {
            header("Location: display.php");
            exit;
        }
    }
}

if (isset($_POST["display"])) {
    header("Location: display.php");
    exit;
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
    <td>enter name</td>
    <td><input type="text" name="name" required></td>
</tr>
<tr>
    <td>enter description</td>
    <td><input type="text" name="description" required></td>
</tr>
<tr>
    <td>select image</td>
    <td><input type="file" name="img[]" multiple required ></td>
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
