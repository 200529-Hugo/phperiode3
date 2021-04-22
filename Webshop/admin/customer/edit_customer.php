<?php
    include('../core/header.php');
    include('../core/checklogin_admin.php');
?>

<h1>Edit user</h1>

<?php
    if (isset($_POST['submit']) && $_POST['submit'] != '') {
        $customer_id = $con->real_escape_string($_POST['customer_id']);
        $gender = $con->real_escape_string($_POST['gender']);
        $first_name = $con->real_escape_string($_POST['first_name']);
        $middle_name = $con->real_escape_string($_POST['middle_name']);
        $last_name = $con->real_escape_string($_POST['last_name']);
        $street = $con->real_escape_string($_POST['street']);
        $house_number = $con->real_escape_string($_POST['house_number']);
        $house_number_addon = $con->real_escape_string($_POST['house_number_addon']);
        $zip_code = $con->real_escape_string($_POST['zip_code']);
        $city = $con->real_escape_string($_POST['city']);
        $phone = $con->real_escape_string($_POST['phone']);
        $emailadres = $con->real_escape_string($_POST['emailadres']);
        $newsletter_subscription = $con->real_escape_string($_POST['newsletter_subscription']);
        $query1 = $con->prepare("UPDATE customer SET gender = ?, first_name = ?, middle_name = ?, last_name = ?, street = ?, house_number = ?, house_number_addon = ?, zip_code = ?, city = ?, phone = ?, emailadres = ?, newsletter_subscription = ? WHERE customer_id = ? LIMIT 1;");
        if ($query1 === false) {
            echo mysqli_error($con);
        }
                    
        $query1->bind_param('ssssssssssssi',$gender,$first_name,$middle_name,$last_name,$street,$house_number,$house_number_addon,$zip_code,$city,$phone,$emailadres,$newsletter_subscription,$customer_id);
        if ($query1->execute() === false) {
            echo mysqli_error($con);
        } else {
            echo '<div style="border: 2px solid red; width: fit-content;">User edited</div>';
            header('Refresh: 2; index.php');
        }
        $query1->close();
                    
    }
?>



<form action="" method="POST">
<?php
    if (isset($_GET['uid']) && $_GET['uid'] != '') {
        $uid = $con->real_escape_string($_GET['uid']);

        $liqry = $con->prepare("SELECT customer_id, gender, first_name, middle_name, last_name, street, house_number, house_number_addon, zip_code, city, phone, emailadres, newsletter_subscription FROM customer WHERE customer_id = ? LIMIT 1;");
        if($liqry === false) {
           echo mysqli_error($con);
        } else{
            $liqry->bind_param('i',$uid);
            $liqry->bind_result($customer_id,$gender,$first_name,$middle_name,$last_name,$street,$house_number,$house_number_addon,$zip_code,$city,$phone,$emailadres,$newsletter_subscription);
            if($liqry->execute()){
                $liqry->store_result();
                $liqry->fetch();
                if($liqry->num_rows == '1'){
                    $columns = array('customer_id', 'gender', 'first_name', 'middle_name', 'last_name', 'street', 'house_number', 'house_number_addon', 'zip_code', 'city', 'phone', 'emailadres', 'newsletter_subscription');
                    foreach ($columns as $key) {
                        $typeInput = "input";
                        $type = "text";
                        $read = "";
                        if ($key == 'customer_id') {
                            $read = "readonly";
                        }
                        if ($key == 'newsletter_subscription' || $key == 'gender') {
                            $typeInput = "select";
                        }
                        if ($key == 'house_number') {
                            $type = "number";
                        }
                        if ($key == 'phone') {
                            $type = "tel";
                        }
                        if ($key == 'emailadres ') {
                            $type = "email";
                        }
                        echo '<b>' . $key .'</b> :<'.$typeInput.' type="'.$type.'" name="'.$key.'" value="' . $$key . '" '.$read.'>';
                        if ($typeInput == "textarea") {
                            echo $$key.'</textarea><br>';
                        } elseif ($typeInput == "select" && $key == 'newsletter_subscription') {
                            echo '<option value="1">Yes</option><option value="0">No</option></select>';
                            echo '<br>';
                        } elseif ($typeInput == "select" && $key == 'gender') {
                            echo '<option value="male">Male</option><option value="female">Female</option><option value="other">Other</option></select>';
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