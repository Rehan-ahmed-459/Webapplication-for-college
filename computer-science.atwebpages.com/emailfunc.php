<?php 

function email_exists($email,$conn){

    $row = mysqli_query($conn,"select email from users_login where email='$email'");
//    echo print_r($row);
    {
        if(mysqli_num_rows($row)==1)
        {
            return true;
        }
        else {
            return false;
        }
    }
}
?>
