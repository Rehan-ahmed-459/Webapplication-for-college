<?php

ob_start();
session_start();

if(!$_SESSION['authorized'] && $_SESSION['authorized'] ===TRUE)
{
  header('location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../main.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Management System</title>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    
</head>
<body>
  <style>
    @media only screen and (min-width:350px) and (max-width:790px){
    body{
        width: fit-content;
    }
}
  </style>


<?php include "../att-navbar.php"?>
  <!-- <div class="navbar">
  <a href="index.php" style="text-decoration:none;">Home</a>
  <a href="students.php" style="text-decoration:none;">Students</a>
  <a href="teachers.php" style="text-decoration:none;">Faculties</a>
  <a href="attendance.php" style="text-decoration:none;">Attendance</a>
  <a href="report.php" style="text-decoration:none;">Report</a>
  <a href="../logout.php" style="text-decoration:none;">Logout</a>

</div> -->
  



<center>
<h1>Attendance Management System</h1>
<div class="row" >
    <div class="content">
    <img src="../img/att.png" width="400px" />

  </div>

</div>

</center>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</body>
</html>
