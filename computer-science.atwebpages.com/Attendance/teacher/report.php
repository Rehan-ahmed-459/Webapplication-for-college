<?php
error_reporting(0);

ob_start();
session_start();

if(!$_SESSION['authorized'] && $_SESSION['authorized'] ===TRUE)
{
  header('location: ../index.php');
}
?>
<?php include('connect.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../main.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Management System</title>
    <script defer src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
</head>
<body>
 
  
    <?php include "../att-navbar.php" ?>




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

<div class="row">

  <div class="content">
    <h3>Individual Report</h3>

    <form method="post" action="">

    <label>Select Subject</label>
    <select name="whichcourse">
    <option  value="algo">Analysis of Algorithms</option>
         <option  value="algolab">Analysis of Algorithms Lab</option>
        <option  value="dbms">Database Management System</option>
        <option  value="dbmslab">Database Management System Lab</option>
        <option  value="weblab">Web Programming Lab</option>
        <option  value="os">Operating System</option>
        <option  value="oslab">Operating System Lab</option>
        <option  value="obm">Object Based Modeling</option>
        <option  value="softcomp">Soft Computing</option>
    </select>

      <p>  </p>
      <label>Student Reg. No.</label>
      <input type="text" name="sr_id">
      <input type="submit" name="sr_btn" value="Go!" >

    </form>

    <h3>Mass Report</h3>

    <form method="post" action="">

    <label>Select Subject</label>
    <select name="course">
    <option  value="algo">Analysis of Algorithms</option>
         <option  value="algolab">Analysis of Algorithms Lab</option>
        <option  value="dbms">Database Management System</option>
        <option  value="dbmslab">Database Management System Lab</option>
        <option  value="weblab">Web Programming Lab</option>
        <option  value="os">Operating System</option>
        <option  value="oslab">Operating System Lab</option>
        <option  value="obm">Object Based Modeling</option>
        <option  value="softcomp">Soft Computing</option>
    </select>
    <p>  </p>
      <label>Date ( yyyy-mm-dd )</label>
      <input type="text" name="date">
      <input type="submit" name="sr_date" value="Go!" >
    </form>

    <br>

    <br>

   <?php

    if(isset($_POST['sr_btn'])){

     $sr_id = $_POST['sr_id'];
     $course = $_POST['whichcourse'];

     $single = mysqli_query($con,"select stat_id,count(*) as countP from attendance where attendance.stat_id='$sr_id' and attendance.course = '$course' and attendance.st_status='Present'");
      $singleT= mysqli_query($con,"select count(*) as countT from attendance where attendance.stat_id='$sr_id' and attendance.course = '$course'");
    //  $count_tot = mysqli_num_rows($singleT);
  } 

    if(isset($_POST['sr_date'])){

     $sdate = $_POST['date'];
     $course = $_POST['course'];

     $all_query = mysqli_query($con,"select * from attendance where reports.stat_date='$sdate' and reports.course = '$course'");

    }
    if(isset($_POST['sr_date'])){

      ?>

    <table class="table table-stripped">
      <thead>
        <tr>
          <th scope="col">Reg. No.</th>
          <th scope="col">Name</th>
          <th scope="col">Department</th>
          <th scope="col">Batch</th>
          <th scope="col">Date</th>
          <th scope="col">Attendance Status</th>
        </tr>
     </thead>


    <?php

     $i=0;
     while ($data = mysqli_fetch_array($all_query)) {

       $i++;

     ?>
        <tbody>
           <tr>
             <td><?php echo $data['st_id']; ?></td>
             <td><?php echo $data['st_name']; ?></td>
             <td><?php echo $data['st_dept']; ?></td>
             <td><?php echo $data['st_batch']; ?></td>
             <td><?php echo $data['stat_date']; ?></td>
             <td><?php echo $data['st_status']; ?></td>
           </tr>
        </tbody>

     <?php 
   } 
  }
     ?>
     
    </table>


    <form method="post" action="" class="form-horizontal col-md-6 col-md-offset-3">
    <table class="table table-striped">

    <?php


    if(isset($_POST['sr_btn'])){

       $count_pre = 0;
       $i= 0;
       $count_tot;
       if ($row=mysqli_fetch_row($singleT))
       {
       $count_tot=$row[0];
       }
       while ($data = mysqli_fetch_array($single)) {
       $i++;
       
       if($i <= 1){
     ?>


     <tbody>
      <tr>
          <td>Student Reg. No: </td>
          <td><?php echo $data['stat_id']; ?></td>
      </tr>

           <?php
         //}
        
        // }

      ?>
      
      <tr>
        <td>Total Class (Days): </td>
        <td><?php echo $count_tot; ?> </td>
      </tr>

      <tr>
        <td>Present (Days): </td>
        <td><?php echo $data[1]; ?> </td>
      </tr>

      <tr>
        <td>Absent (Days): </td>
        <td><?php echo $count_tot -  $data[1]; ?> </td>
      </tr>

    </tbody>

   <?php

     }  
    }}
     ?>
    </table>
  </form>

  </div>

</div>

</center>

</body>
</html>
