<?php
//establishing connection with database.

$con=mysqli_connect('localhost','root','','attmgsystem');
if (!$con){
    echo '<script>alert("Connection Error")</script>';
}

?>