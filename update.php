<?php
include "connection.php";
error_reporting(0);

/* FETCH OLD DATA */
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $res = mysqli_query($con, "SELECT * FROM laptofy WHERE id='$id'");
    $data = mysqli_fetch_assoc($res);
}

/* DELETE SINGLE IMAGE */
if (isset($_GET['delimg'])) {
    $delImg = $_GET['delimg'];

    $res = mysqli_query($con, "SELECT img FROM laptofy WHERE id='$id'");
    $row = mysqli_fetch_assoc($res);
    $imgs = explode(",", $row['img']);

    if (($key = array_search($delImg, $imgs)) !== false) {
        unset($imgs[$key]);
        if (file_exists("img/$delImg")) {
            unlink("img/$delImg");
        }
    }

    $final = implode(",", $imgs);
    mysqli_query($con, "UPDATE laptofy SET img='$final' WHERE id='$id'");
    header("Location: update.php?id=$id");
    exit;
}

/* UPDATE RECORD + ADD IMAGES */
if (isset($_POST['update'])) {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $status = $_POST['status'];

    // OLD IMAGES
    $oldImgs = explode(",", $data['img']);

    // ADD NEW IMAGES
    if (!empty($_FILES['img']['name'][0])) {
        foreach ($_FILES['img']['name'] as $key => $imgName) {
            $tmp = $_FILES['img']['tmp_name'][$key];
            if ($imgName != "") {
                move_uploaded_file($tmp, "img/$imgName");
                $oldImgs[] = $imgName;
            }
        }
    }

    $finalImgs = implode(",", array_filter($oldImgs));

    mysqli_query($con, "
        UPDATE laptofy SET
        name='$name',
        description='$description',
        img='$finalImgs',
        price='$price',
        status='$status'
        WHERE id='$id'
    ");

    header("Location: display.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Product</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<form method="POST" enctype="multipart/form-data">
<table border="1" align="center">

<tr><th colspan="2">UPDATE PRODUCT</th></tr>

<tr>
<td>ID</td>
<td><input type="text" name="id" value="<?= $data['id'] ?>" readonly></td>
</tr>

<tr>
<td>Name</td>
<td><input type="text" name="name" value="<?= $data['name'] ?>"></td>
</tr>

<tr>
<td>Description</td>
<td><input type="text" name="description" value="<?= $data['description'] ?>"></td>
</tr>

<!-- EXISTING IMAGES -->
<tr>
<td>Existing Images</td>
<td>
<?php
if (!empty($data['img'])) {
    foreach (explode(",", $data['img']) as $img) {
        ?>
        <div style="display:inline-block;text-align:center;margin:6px">
            <img src="img/<?= $img ?>" width="90"
                 style="border-radius:6px;border:1px solid #ccc;"><br>
            <a href="update.php?id=<?= $id ?>&delimg=<?= $img ?>"
               onclick="return confirm('Delete this image?')">
               <button type="button" style="background:red;color:white">Delete</button>
            </a>
        </div>
        <?php
    }
}
?>
</td>
</tr>

<!-- ADD NEW IMAGES -->
<tr>
<td>Add Images</td>
<td><input type="file" name="img[]" multiple></td>
</tr>

<tr>
<td>Price</td>
<td><input type="text" name="price" value="<?= $data['price'] ?>"></td>
</tr>

<tr>
<td>Status</td>
<td>
<select name="status">
<option <?= ($data['status']=="Active")?"selected":"" ?>>Active</option>
<option <?= ($data['status']=="Inactive")?"selected":"" ?>>Inactive</option>
</select>
</td>
</tr>

<tr>
<td colspan="2" align="center">
<input type="submit" name="update" value="Update">
<a href="display.php"><button type="button">Back</button></a>
</td>
</tr>

</table>
</form>

</body>
</html>