<?php
    include('../core/header.php');
    include('../core/checklogin_admin.php');
?>

<h1>Delete product</h1>

<?php
    if (isset($_POST['submit']) && $_POST['submit'] != '') {
        $pid = $con->real_escape_string($_POST['pid']);
        $query = $con->prepare("DELETE product, product_image FROM product INNER JOIN product_image ON product.product_id = product_image.product_id WHERE product.product_id = ?;");
        if ($query === false) {
            echo mysqli_error($con);
        }
                    
        $query->bind_param('i',$pid);
        if ($query->execute() === false) {
            echo mysqli_error($con);
        } else {
            echo '<div style="border: 2px solid red; width: fit-content;">Product with product_id '.$pid.' deleted!</div>';
            header('Refresh: 2; index.php');
        }
        $query->close();
                    
    }
?>


<?php
    if (isset($_GET['pid']) && $_GET['pid'] != '') {

        ?>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">

        <h2 style="color: red">Are you sure you want to delete this product?</h2><?php

        $pid = $con->real_escape_string($_GET['pid']);

        $liqry = $con->prepare("SELECT product_id, name FROM product WHERE product_id = ? LIMIT 1;");
        if($liqry === false) {
           echo mysqli_error($con);
        } else{
            $liqry->bind_param('i',$pid);
            $liqry->bind_result($productId,$name);
            if($liqry->execute()){
                $liqry->store_result();
                $liqry->fetch();
                if($liqry->num_rows == '1'){
                    echo '$productId: ' . $productId . '<br>';
                    echo '<input type="hidden" name="pid" value="' . $productId . '" />';
                    echo '$name: ' . $name . '<br>';
                }
            }
        }
        $liqry->close();

        ?>
        <br>
        <input type="submit" name="submit" value="Yes, delete!">
        <a href="index.php">Go back</a>
        </form>
        <?php

    }
?>

<?php
    include('../core/footer.php');
?>