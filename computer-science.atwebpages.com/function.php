<?php 

function username_exists($username,$conn){

    $row = mysqli_query($conn,"select id,email from users_login where username='$username'");
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
