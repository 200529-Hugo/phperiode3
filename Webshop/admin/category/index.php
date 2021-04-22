<?php
    include('../core/header.php');
    include('../core/checklogin_admin.php');
    include('category-menu.php');
?>

<h1>Category overview</h1>

<?php
    $liqry = $con->prepare("SELECT category_id,name,description,active FROM category");
    if($liqry === false) {
       echo mysqli_error($con);
    } else{
        $liqry->bind_result($id,$name,$desc,$active);
        if($liqry->execute()){
            $liqry->store_result();
            echo '<table border=1>
                    <tr>
                        <td>ID</td>
                        <td>name</td>
                        <td>Description</td>
                        <td>Active</td>
                        <td>edit</td>
                    </tr>';
            while ($liqry->fetch() ) { ?>
                    <tr>
                    <td><?php echo $id; ?></td>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $desc; ?></td>
                    <td><?php echo $active; ?></td>
                    <td><a href="edit_category.php?id=<?php echo $id; ?>">edit</a></td>
                </tr>
                <?php 
            }
            echo '</table>';
        }
        $liqry->close();
    }
?>

<?php
    include('../core/footer.php');
?>
