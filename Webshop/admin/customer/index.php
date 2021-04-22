<?php
    include('../core/header.php');
    include('../core/checklogin_admin.php');
    include('customer-menu.php');
?>

<h1>Customer overview</h1>

<?php
        $liqry = $con->prepare("SELECT customer_id, gender, CONCAT(first_name, ' ', middle_name, ' ', last_name), CONCAT(street, ' ', house_number, ' ', house_number_addon), city, phone, emailadres, newsletter_subscription FROM customer");
        if($liqry === false) {
           echo mysqli_error($con);
        } else{
            $liqry->bind_result($custId,$gender,$name,$home,$city,$phone,$email,$sub);
            if($liqry->execute()){
                $liqry->store_result();
                echo '<table border=1>
                        <tr>
                            <td>ID</td>
                            <td>Gender</td>
                            <td>Name</td>
                            <td>Home</td>
                            <td>City</td>
                            <td>Phone</td>
                            <td>Email</td>
                            <td>Newsletter</td>
                            <td>edit</td>
                            <td>delete</td>
                        </tr>';
                while ($liqry->fetch() ) { ?>
                        <tr>
                        <td><?php echo $custId; ?></td>
                        <td><?php echo $gender; ?></td>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $home; ?></td>
                        <td><?php echo $city; ?></td>
                        <td><?php echo $phone; ?></td>
                        <td><?php echo $email; ?></td>
                        <td><?php echo $sub; ?></td>
                        <td><a href="edit_customer.php?uid=<?php echo $custId; ?>">edit</a></td>
                        <td><a href="delete_customer.php?uid=<?php echo $custId; ?>">delete</a></td>
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
