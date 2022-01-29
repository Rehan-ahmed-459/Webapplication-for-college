<?php 
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: /login/");
    session_regenerate_id(true);
    exit;
}
include "dbconnect.php";


if(isset($_GET['id']))
{    
	$id= $_GET['id'];

	
    $q = mysqli_query($conn,"DELETE FROM `list_files` WHERE `id`=$id");
   
   if(!$q){
       $e ="<div class='alert alert-Danger alert-dismissible fade show' role='alert'>
       <strong>Error!</strong> Something Went Wrong Please Try again Later!
       <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
         <span aria-hidden='true'>&times;</span>
       </button>
     </div>";

   }
   else{
    header("location: stud_Drive.php");
   $e1="<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> File SuccessFully Deleted!
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
  </div>";
   }

}
?>