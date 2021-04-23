<?php
    include('../core/header.php');
    include('../core/checklogin_admin.php');
?>

<h1>Add category</h1>

<?php
    if (isset($_POST['submit']) && $_POST['submit'] != '') {
        $name = $con->real_escape_string($_POST['name']);
        $desc = $con->real_escape_string($_POST['desc']);

        $liqry1 = $con->prepare("INSERT INTO category (name, description, active) VALUES (?,?,1)");
        if($liqry1 === false) {
           echo mysqli_error($con);
        } else{
            $liqry1->bind_param('ss',$name,$desc);
            if($liqry1->execute()){
                echo "Category with name " . $name . " added.";
                header('Refresh: 2; index.php');
            }
        }
        $liqry1->close();
    }
?>

<form action="" method="POST">
Name: <input type="text" name="name" value=""><br>
Discription: <textarea type="text" name="desc" value=""></textarea><br><br>
<input type="submit" name="submit" value="Add">
<a href="index.php">Go Back</a>
</form>



<?php
    include('../core/footer.php');
?>