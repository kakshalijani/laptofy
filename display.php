<?php
include "connection.php";
$qry=mysqli_query($con,"SELECT * FROM laptofy") or die("query error");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>display record</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <table border="1" align="center">
        <tr>
            <th>id</th>
            <th>name</th>
            <th>description</th>
            <th>image</th>
            <th>price</th>
            <th>status</th>
            <th>delete</th>
            <th>update</th>
            
        </tr>
        <?php
        while($data=mysqli_fetch_array($qry)){
        ?>
        <tr>
            <td><?php echo $data["id"]; ?></td>
            <td><?php echo $data["name"]; ?></td>
            <td><?php echo $data["description"]; ?></td>
            <td><img src="<?php echo $data["img"]; ?>" height="100px" width="100px"></td>
            <td><?php echo $data["price"]; ?></td>
            <td><?php echo $data["status"]; ?></td>
            <td><a href="delete.php?id=<?php echo $data["id"]; ?>">delete</a></td>
            <td><a href="update.php?id=<?php echo $data["id"]; ?>">update</a></td>
            
        </tr>
        <?php
        }
        ?>
        <tr>
            <td colspan="8" align="center" class="btn-center">
                <a href="laptofy.php"><button>insert new record</button></a>
            </td>
    </table>
</body>
</html>
