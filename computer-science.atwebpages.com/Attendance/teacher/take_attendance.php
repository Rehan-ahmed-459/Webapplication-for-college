<?php 
error_reporting(0);
ob_start();
require "../../dbconnect.php";
session_start();
$msg="";
if(!$_SESSION['authorized'] && $_SESSION['authorized'] !=TRUE)
{
  header('location: ../index.php');
}
?>
<?php
try {
   if(isset($_POST['mark_att'])){
    
     $name=$_POST['name'];
     
     $reg_no = $_POST['reg_no'];
    $batch=$_POST['batch'];
    $year=$_POST['yos'];

     foreach($_POST['st_status']  as $i => $names){

      $s_status=$names;
      $s_name=$name[$i];
      $s_reg_no=$reg_no[$i];
      $s_batch=$batch[$i];
      $s_year=$year[$i];
  
  
   foreach($_POST['course'] as $index => $subject){
    $s_course=$subject;
    
    $stat = mysqli_query($conn,"insert into take_attendance(name,reg_no,course,batch,year,status) values('$s_name','$s_reg_no','$s_course','$s_batch','$s_year','$s_status')");
  }
   
    
    
    }
    if($stat){
      
   $msg = "<div class='alert alert-success alert-dismissible fade in show' role='alert'>
     <strong>Success!</strong> File Uploaded SuccessFully!
     <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
       <span aria-hidden='true'>&times;</span>
     </button>
   </div>";
    }
    else{
      echo "<script>alert('Error')</script>";
    }
  }

} catch (Exception $e) {
  throw $e;
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take-Attendance</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>  
<link rel="stylesheet" href="style1.css">
</head>
<body>
<style>

    @media only screen and (min-width:350px) and (max-width:790px){
      body{
        width: fit-content;
      }
    }
    </style>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
  
    <a class="navbar-brand" href="#">
      <img src="../../images/logo.png" alt="the new college" width="60" height="38" class="d-inline-block align-text-top">
     The New College
    </a>
  
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="students.php">Students</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Reports
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="teachers.php">Faculties</a></li>
            <li><a class="dropdown-item" href="report.php">Report</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
<?php echo $msg; ?>
<div class="container my-3">

    <div class="content">
        <h3>Add Students</h3>
        
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <div class="container form">
            
    <label>Select Subject</label>
    <select  name="course[<?php echo $subject; ?>]">
      <option  value="java">Programming in Java</option>
      <option  value="javalab">Programming in Java Practicals</option>
        <option  value="maths1">Allied Maths-I</option>
        <option  value="maths2">Allied Maths-II</option>
        <option  value="maths3">Allied Maths-III</option>
        <option  value="eng">English</option>
        <option  value="lang">Language</option>
        <option  value="nme">NME</option>
        <option  value="ss2">SS2</option>
    </select>
<br>
  
  <label class="mx-3 my-3">Select Date</label>
  <input type="date" name="dt" id="date" placeholder="Select the date"><br>
  <label class="my-3">Enter Student Starting Reg No</label>
  <input type="text" name="start_id" placeholder="Ex: 8001"><br>
  <label class="my-3">Enter Student Ending Reg No</label>
  <input type="text" name="end_id" placeholder="Ex: 8050" >
  <input type="submit" name="submitbtn" value="Go!" >
  
</div>
      <input type="submit" name="mark_att" class="btn btn-primary" value="Mark Attendance">
    </div>
    <div class="container container-fluid my-3">
      
      <table class="table table-stripped">
      <thead>
        <tr>
         
          <th scope="col">Reg. No.</th>
          <th scope="col">Name</th>
          <th scope="col">Batch</th>
          <th scope="col">Year</th>
          <th scope="col">Status</th>
        </tr>
      </thead>

  
     <tr>
       <?php if(isset($_POST['submitbtn'])){
    $start =$_POST['start_id'];
    $end =$_POST['end_id'];
   $i=1;
    $i+=$start-1;
   
    $radio=0;
    while($i<=$end ){ 
      $q =mysqli_query($conn,"select register_number,yos,name,shift,batch from users_login where register_number=$i");
     $num=mysqli_num_rows($q);
     if($num ==0){
      echo "no records found";
    }
    $res=mysqli_fetch_array($q);
    
    
    ?>
      <td><?php echo $i;?> <input type="hidden" name="reg_no[]" value="<?php echo $res['register_number'] ?>"></td>
      
      <td><?php echo $res['name']; ?>  <input type="hidden" name="name[]" value="<?php echo $res['name'] ?>"></td>
      <td><?php echo $res['batch']; ?>  <input type="hidden" name="batch[]" value="<?php echo $res['batch'] ?>"></td>
      <td><?php echo $res['yos']; ?>  <input type="hidden" name="yos[]" value="<?php echo $res['yos'] ?>"></td>
      
      
      <?php  $i++; ?>
      
      <td>
        <label>Present</label>
        <input type="radio" name="st_status[<?php echo $radio; ?>]" value="Present" checked>
        <label>Absent </label>
        <input type="radio" name="st_status[<?php echo $radio; ?>]" value="Absent"  >
      </td>
    </tr>
    
    <?php    $radio++;}} ?>
  </table>
</div>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>