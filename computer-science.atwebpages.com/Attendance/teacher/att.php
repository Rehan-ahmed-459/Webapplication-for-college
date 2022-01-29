<?php 
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




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check-Attendance</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>  
<link rel="stylesheet" href="style1.css">
</head>
<body>
<style type="text/css">

  .form{
    width: max-content;
  }

  .paging-nav .selected-page {
  background: #187ed5;
  font-weight: bold;
}
.paging-nav a {
  margin: auto 1px;
  text-decoration: none;
  display: inline-block;
  padding: 1px 7px;
  background: #91b9e6;
  color: white;
  border-radius: 3px;
}
@media only screen and (min-width:300px) and (max-width:540px){
    body{
        width: auto;
    }
}
@media only screen and (min-width:340px) and (max-width:472px){
    body{
        width: max-content;
    }
}


</style>
    <?php include('../att-navbar.php'); ?>
    <div class="container container-fluid form form-control my-3">

        <div class="row">
            
            <div class="content text-center ">
                <h3>Check Individual Report</h3>
                
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <br>
   

    <div class="form-group">
							<label class="control-label" for="register number"> Register Number</label>
							<input id="reg_no" name="reg_no" type="text" maxlength="50"
								class="form-control" 
								value="" placeholder="Enter Your Register Number">
							
						</div>
      
    <!-- <label>Student Reg. No.</label>
      <input type="text" name="reg_no"> -->
      <input type="submit" class="btn btn-primary my-3 md-3" name="sr_btn"  value="Check"/>

    </form>
    
   
    <table id="tableData" class="table table-stripped">
      <thead>
        <tr>
          <th scope="col">Reg. No.</th>
          <th scope="col">Name</th>
          <th scope="col">course</th>
          <th scope="col">Batch</th>
          <th scope="col">Year</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
   <?php

if(isset($_POST['sr_btn'])){
    $reg_no=$_POST['reg_no'];
   
    // $single = mysqli_query($conn,"select stat_id,count(*) as countP from attendance where attendance.stat_id='$sr_id' and attendance.course = '$course' and attendance.st_status='Present'");
    //   $singleT= mysqli_query($conn,"select count(*) as countT from attendance where attendance.stat_id='$sr_id' and attendance.course = '$course'");
    $query=mysqli_query($conn,"SELECT COUNT(*) AS count from take_attendance where reg_no='$reg_no' and status='Present'");
    $que=mysqli_query($conn,"SELECT COUNT(*) AS count from take_attendance where reg_no='$reg_no' and status='Absent'");
    $abs=mysqli_fetch_array($que);
    
    $absent=$abs[0];
  $pres=mysqli_fetch_array($query);
   $present=$pres[0];
   $total=$present+$absent;
 
   echo "<div>Total No of Days :</div>".$total.'<br>';
   echo "<div>Total Present Days :</div>".$present.'<br>';
   echo "<div>Total Absent Days:</div>".$absent.'<br>';


    $q=mysqli_query($conn,"SELECT * from take_attendance where reg_no='$reg_no' ");
    $num=mysqli_num_rows($q);
    if($num==0){
      echo "<div class='alert alert-warning' role='alert'>
      No Records Found or You May Entered Wrong Register Number!
      </div>";
    } 
    $i=1;
  
    
    
    while ($data = mysqli_fetch_array($q)) {
      $i++;
      ?>

      <tr>
          <td><?php echo $data['reg_no']; ?></td>
          
          <td><?php echo $data['name']; ?></td>
          <td><?php echo $data['course']; ?></td>
          <td><?php echo $data['batch']; ?></td>
          <td><?php echo $data['year']; ?></td>
          
         
          <td>
              <label><?php echo $data['status'] ?></label>
              
              
              
            </td>
        </tr>
        <?php }} else{
          echo `<div class="alert alert-danger" role="alert">
          uh-ho! something went Wrong on our side!
        </div>`;
        }
       ?>
    
</table>


    

</div>



<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> 
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="paging.js"></script> 
<script type="text/javascript">
            $(document).ready(function() {
                $('#tableData').paging({limit:5});
            });
        </script>
        
</body>
</html>