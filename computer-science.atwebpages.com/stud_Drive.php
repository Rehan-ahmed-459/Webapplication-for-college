<?php 
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: /login/");
    session_regenerate_id(true);
    exit;
}
$msg ='';
$username=$_SESSION['username'];
$errors =array();
$header= "deposition";
include "dbconnect.php";


if(isset($_POST['submit'])){
  $semester =test_input(mysqli_real_escape_string($conn,$_POST['sem']));
  $Report_card= $_FILES['file']['name'];
  $tmp_file =$_FILES['file']['tmp_name'];
 

  if(empty($semester)){
    $errors['Semester-field']="<div class='error'>Semester  is required*</div>";
  }
  else{ 
		$file_ext= explode(".",$Report_card);
		$file_exten= $file_ext['1'];
		$Report_card =rand(1,10000).rand(1,1000).time().".".$file_exten;
  }		
		if($file_exten=='pdf' || $file_exten=='PDF' || $file_exten=='jpeg' || $file_exten=='JPEG' || $file_exten=='PNG' || $file_exten=='png'){
            move_uploaded_file($tmp_file,"results/$Report_card");
            $sql ="INSERT INTO list_files(id,username,Semester,file_name,action,dt) VALUES (NULL,'$username','$semester','$Report_card','$header',CURRENT_TIMESTAMP)";
            $result=mysqli_query($conn,$sql);
            if($result){
              $msg=  "<div class='alert alert-success alert-dismissible fade show' role='alert'>
              <strong>Success!</strong> File Uploaded SuccessFully!
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
              </button>
            </div>";
              
            }
                   
}
else{
  $errors['db-error'] ='Please Only Upload PDF and JPEG Format Files';
 
}  
}

  

?>

<?php include "navbar.php";?>
<?php
                        if(count($errors) > 0){
                            ?>
                            <div class="alert alert-danger text-center">
                                <?php 
                                    foreach($errors as $error){
                                        echo $error;
                                    }
                                ?>
                            </div>
                            <?php
                        }
                    ?>
                    <?php echo $msg; ?>
                    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student-Report</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="report-card.css">
</head>
<body>
    <div class="container text-center">
<h1>Manage Your Important Files At One Place</h1>
<ul>
  <p>1.You can Upload your Results</p>
  <p>2.You can Upload your Fees Recipts</p>
  <p>3.You can Upload your Notes</p>
</ul>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary me-2" data-toggle="modal" data-target="#exampleModalLong">
  Start Uploading
</button>
</div>
<!-- Modal -->
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" role="form">
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Upload the Result</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="form-group">
							<label class="control-label" for="shift">Select the Purpose</label>
							<input list="sem" type="text" name="sem" maxlength="50" class="form-control"
								placeholder="Select" value="">
							<datalist id="sem">
								<option value="Semester-I Results"></option>
								<option value="Semester-II Results"></option>
								<option value="Semester-III Results"></option>
								<option value="Semester-IV Results"></option>
								<option value="Semester-V Results"></option>
								<option value="Semester-VI Results"></option>
								<option value="Semester-I Fee Receipt"></option>
								<option value="Semester-II Fee Receipt"></option>
								<option value="Semester-III Fee Receipt"></option>
								<option value="Semester-VI Fee Receipt"></option>
								<option value="Semester-V Fee Receipt"></option>
								<option value="Semester-VI Fee Receipt"></option>
								<option value="Notes"></option>
							</datalist>
							
						</div>
            <div class="form-group">
							<label class="control-label" for="profilepic">Select the file</label>
							<input type="file" name="file" required>
						
							<!-- <input type="submit" name="upload" value="Upload" class="btn"> -->
						</div>
<br>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="submit" class="btn btn-primary">Upload</button>
      </div>
    </div>
  </div>
</div>
</form>
<div class="container container-fluid my-4">
        <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">S.no</th>
                <th scope="col">Purpose</th>
                <th scope="col" >File Name</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
            <tr>
                <?php 
                
                $query =mysqli_query($conn,"Select id,Semester,file_name from list_files where username='$username'");
                $nums =mysqli_num_rows($query);
                if($nums==0){

                   echo "<td>No Records Found</td>";
                }
                else{
                $sno =0;
                while($res =mysqli_fetch_array($query)){
                  $sno =$sno+1;
                  ?>
<th scope="row"><?php echo $sno; ?></th>
                
                <td><?php echo $res['Semester']; ?></td>
                <td id="file-name"><?php echo $res['file_name']; ?></td>
                <td><a href="download.php?id=<?php echo $res['id']; ?>"  class="btn btn-primary" name=download>Download</a><a href="delete.php?id=<?php echo $res['id']; ?>"  class="btn btn-danger my-2 mx-2" name=delete>DELETE</a></td>
                
              
              </tr>
                  <?php 
                }
              }
              ?>
                
            
            </tbody>
          </table>
    </div>
   <style>
     .navbar-toggler-icon {
    background: white;
}
@media only screen and (min-width:320px) and (max-width:756px){
  body{
  width: fit-content;
}
}

   </style>
  
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>
<?php 
 function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>