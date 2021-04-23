<?php
include('../core/header.php');
include('../core/checklogin_admin.php');
?>

    <h1>Edit product</h1>

<?php
    if (isset($_POST['submit']) && $_POST['submit'] != '') {
        $pid = $con->real_escape_string($_POST['product_id']);
        $name = $con->real_escape_string($_POST['name']);
        $description = $con->real_escape_string($_POST['description']);
        $category_id = $con->real_escape_string($_POST['category_id']);
        $price = $con->real_escape_string($_POST['price']);
        $color = $con->real_escape_string($_POST['color']);
        $weight = $con->real_escape_string($_POST['weight']);
        $active = $con->real_escape_string($_POST['active']);
        $query1 = $con->prepare("UPDATE product SET name = ?, description = ?, category_id = ?, price = ?, color = ?, weight = ?, active = ? WHERE product_id = ? LIMIT 1;");
        if ($query1 === false) {
            echo mysqli_error($con);
        }

        $query1->bind_param('sssssssi',$name,$description,$category_id,$price,$color,$weight,$active,$pid);
        if ($query1->execute() === false) {
            echo mysqli_error($con);
        } else {
            echo '<div style="border: 2px solid red">Edited product</div>';
            header('Refresh: 2; index.php');
        }
        $query1->close();

    }
?>



    <form action="" method="POST">
        <?php
        if (isset($_GET['pid']) && $_GET['pid'] != '') {
            $pid = $con->real_escape_string($_GET['pid']);

            $liqry = $con->prepare("SELECT product_id, name, description, category_id, price, color, weight, active FROM product WHERE product_id = ? LIMIT 1;");
            if($liqry === false) {
                echo mysqli_error($con);
            } else{
                $liqry->bind_param('i',$pid);
                $liqry->bind_result($product_id, $name, $description, $category_id, $price, $color, $weight, $active );
                if($liqry->execute()){
                    $liqry->store_result();
                    $liqry->fetch();
                    if($liqry->num_rows == '1'){
                        $columns = array('product_id', 'name', 'description', 'category_id', 'price', 'color', 'weight', 'active');
                        foreach ($columns as $key) {
                            $typeInput = "input";
                            $read = "";
                            if ($key == 'product_id') {
                                $read = "readonly";
                            }
                            if ($key == 'description'){
                                $typeInput = "textarea";
                            }
                            if ($key == 'category_id' || $key == 'active') {
                                $typeInput = "select";
                            }
                            echo '<b>' . $key .'</b> :<'.$typeInput.' type="text" name="'.$key.'" value="' . $$key . '" '.$read.'>';
                            if ($typeInput == "textarea") {
                                echo $$key.'</textarea><br>';
                            } elseif ($typeInput == "select" && $key == 'category_id') {
                                $liqry = $con->prepare("SELECT category_id,name FROM category");
                                if($liqry === false) {
                                    echo mysqli_error($con);
                                } else{
                                    $liqry->bind_result($category_id,$name);
                                    if($liqry->execute()){
                                        $liqry->store_result();
                                        while ($liqry->fetch() ) { ?>
                                            <option value="<?php echo $category_id; ?>"><?php echo $name . " With ID: " . $category_id?></option><br>

                                            <?php
                                        }
                                        echo '</select>';
                                    }

                                }
                                echo '<br>';                               
                            } elseif ($typeInput == "select" && $key == 'active') {
                                echo '<option value="1">Yes</option><option value="0">No</option></select>';
                                echo '<br>';
                            }
                            else{
                                echo '<br>';
                            }
                        }


                    }
                }
            }
            $liqry->close();

        }
        ?>
        <br>
        <input type="submit" name="submit" value="Save">
        <a href="index.php">Go back</a>
    </form>

<?php
include('../core/footer.php');
?>