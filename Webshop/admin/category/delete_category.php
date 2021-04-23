<?php
    include('../core/header.php');
    include('../core/checklogin_admin.php');
?>

<h1>Delete category</h1>

<?php
    if (isset($_POST['submit']) && $_POST['submit'] != '') {
        $id = $con->real_escape_string($_POST['id']);
        $query1 = $con->prepare("DELETE FROM category WHERE category_id = ? LIMIT 1;");
        if ($query1 === false) {
            echo mysqli_error($con);
        } else{
            $query1->bind_param('i',$id);
            if ($query1->execute() === false) {
                echo mysqli_error($con);
            } else {
                $query2 = $con->prepare("DELETE FROM product WHERE category_id = ?;");
                if ($query2 === false) {
                    echo mysqli_error($con);
                } else{
                    $query2->bind_param('i',$id);
                    if ($query2->execute() === false) {
                        echo mysqli_error($con);
                    } else {
                        echo '<div style="border: 2px solid red; width: fit-content;">Category with category_id '.$id.' deleted!</div>';
                        header('Refresh: 2; index.php');
                    }
                }
                $query2->close(); 
            }
        }
        $query1->close();  
    }
?>


<?php
    if (isset($_GET['id']) && $_GET['id'] != '') {

        ?>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">

        <h2 style="color: red">Are you sure you want to delete this category?</h2><?php

        $id = $con->real_escape_string($_GET['id']);

        $liqry = $con->prepare("SELECT category_id,name FROM category WHERE category_id = ? LIMIT 1;");
        if($liqry === false) {
           echo mysqli_error($con);
        } else{
            $liqry->bind_param('i',$id);
            $liqry->bind_result($categoryId,$name);
            if($liqry->execute()){
                $liqry->store_result();
                $liqry->fetch();
                if($liqry->num_rows == '1'){
                    echo 'ID: ' . $categoryId . '<br>';
                    echo '<input type="hidden" name="id" value="' . $categoryId . '" />';
                    echo 'Name: ' . $name . '<br>';
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