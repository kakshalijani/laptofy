<?php
include "connection.php";
$qry = mysqli_query($con,"SELECT * FROM laptofy WHERE status='active'")
       or die("query error");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Display Record</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<table border="1" align="center">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Images</th>
        <th>Price</th>
        <th>Status</th>
        <th>Delete</th>
        <th>Update</th>
        <th>View</th>
    </tr>

<?php while ($data = mysqli_fetch_array($qry)) { ?>
    <tr>
        <td><?php echo $data["id"]; ?></td>
        <td><?php echo $data["name"]; ?></td>
        <td><?php echo $data["description"]; ?></td>

        <!-- MULTIPLE IMAGES -->
        <td>
            <?php
            $img = explode(",", $data["img"]);
            foreach ($img as $i) {
                if (!empty($i)) {
                    echo "<img src='img/$i'
                          width='70' height='70'
                          style='margin:4px;border-radius:6px;object-fit:cover;'>";
                }
            }
            ?>
        </td>

        <td><?php echo $data["price"]; ?></td>
        <td><?php echo $data["status"]; ?></td>
        <td><a href="delete.php?id=<?php echo $data["id"]; ?>">Delete</a></td>
        <td><a href="update.php?id=<?php echo $data["id"]; ?>">Update</a></td>
        <td><a href="view.php?id=<?php echo $data["id"]; ?>">View</a></td>
    </tr>
<?php } ?>

    <tr>
        <td colspan="9" align="center" class="btn-center">
            <a href="laptofy.php"><button>Insert New Record</button></a>
        </td>
    </tr>
</table>

</body>
</html>