<?php
include "connection.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $qry = mysqli_query($con, "SELECT * FROM laptofy WHERE id='$id'");

    if (mysqli_num_rows($qry) > 0) {
        $data = mysqli_fetch_array($qry);
    } else {
        header("Location: display.php");
        exit;
    }
} else {
    header("Location: display.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Product Details</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<table border="1" align="center">
    <tr>
        <th>ID</th>
        <td><?php echo $data["id"]; ?></td>
    </tr>
    <tr>
        <th>Name</th>
        <td><?php echo $data["name"]; ?></td>
    </tr>
    <tr>
        <th>Description</th>
        <td><?php echo $data["description"]; ?></td>
    </tr>

    <!-- MULTIPLE IMAGES -->
    <tr>
        <th>Images</th>
        <td>
            <?php
            $images = explode(",", $data["img"]);
            foreach ($images as $img) {
                if (!empty($img)) {
                    echo "<img src='img/$img'
                          width='100' height='100'
                          style='margin:6px;border-radius:8px;object-fit:cover;'>";
                }
            }
            ?>
        </td>
    </tr>

    <tr>
        <th>Price</th>
        <td><?php echo $data["price"]; ?></td>
    </tr>
    <tr>
        <th>Status</th>
        <td><?php echo $data["status"]; ?></td>
    </tr>

    <tr>
        <td colspan="2" align="center" class="btn-center">
            <a href="display.php"><button>Back</button></a>
        </td>
    </tr>
</table>

</body>
</html>