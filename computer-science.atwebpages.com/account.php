<?php
$run='';
include 'dbconnect.php';
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$showalert =false;
$showerror=false;
$showerror2='';
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: /login/");
    session_regenerate_id(true);
    exit;
}
else {
$username=$_SESSION['username'];
$result = mysqli_query($conn,"Select id,name,register_number,class, Age, dob, yos, batch, shift, email, fathername, occupation, income ,mothername, bloodgroup,nationality,nativity,religion,caste,fatherphone,motherphone,studentphone,address,file,username from users_login where username='$username'");
$retrive = mysqli_fetch_array($result);

	$name = $retrive['name'];
	$register_number = $retrive['register_number'];
	$class = $retrive['class'];
    $age= $retrive['Age'];
	$dob = $retrive['dob'];
	$year = $retrive['yos'];
	$batch = $retrive['batch'];
	$shift = $retrive['shift'];
    $email = $retrive['email'];
	$fathername = $retrive['fathername'];
	$occupation = $retrive['occupation'];
	$income = $retrive['income'];
	$mothername = $retrive['mothername'];
	$bloodgroup = $retrive['bloodgroup'];
	$nationality = $retrive['nationality'];
	$nativity = $retrive['nativity'];
	$religion = $retrive['religion'];
	$caste = $retrive['caste'];
	$fatherphone = $retrive['fatherphone'];
	$motherphone = $retrive['motherphone'];
	$studentphone = $retrive['studentphone'];
	$address = $retrive['address'];
	$image = $retrive['file'];
	$username = $retrive['username'];
	$id = $retrive['id'];
}
// <-------------------------------------------->
	// When user click on update
   
   if(isset($_POST['update'])){
   $name = test_input(mysqli_real_escape_string($conn,$_POST['name']));
	$register_number = test_input(mysqli_real_escape_string($conn,$_POST['register_number']));
	$class = test_input(mysqli_real_escape_string($conn,$_POST['class']));
	$age = test_input(mysqli_real_escape_string($conn,$_POST['age']));
	$dob = test_input(mysqli_real_escape_string($conn,$_POST['dob']));
	$year = test_input(mysqli_real_escape_string($conn,$_POST['yos']));
	$batch = test_input(mysqli_real_escape_string($conn,$_POST['batch']));
	$shift =test_input(mysqli_real_escape_string($conn,$_POST['shift']));
	$fathername = test_input(mysqli_real_escape_string($conn,$_POST['fathername']));
	$occupation = test_input(mysqli_real_escape_string($conn,$_POST['occupation']));
	$income = test_input(mysqli_real_escape_string($conn,$_POST['income']));
	$mothername =test_input(mysqli_real_escape_string($conn,$_POST['mothername']));
	$bloodgroup = test_input(mysqli_real_escape_string($conn,$_POST['bloodgroup']));
	$nationality = test_input(mysqli_real_escape_string($conn,$_POST['nationality']));
	$nativity = test_input(mysqli_real_escape_string($conn,$_POST['nativity']));
	$religion = test_input(mysqli_real_escape_string($conn,$_POST['religion']));
	$caste = test_input(mysqli_real_escape_string($conn,$_POST['caste']));
	$fatherphone = test_input(mysqli_real_escape_string($conn,$_POST['fatherphone']));
	$motherphone = test_input(mysqli_real_escape_string($conn,$_POST['motherphone']));
	$studentphone = test_input(mysqli_real_escape_string($conn,$_POST['studentphone']));
	$address = test_input(mysqli_real_escape_string($conn,$_POST['address']));

       $query =" UPDATE `users_login` SET `name` = '$name', `register_number` = '$register_number', `class` = '$class', `Age` = '$age', `dob` = '$dob', `yos` = '$year', `batch` = '$batch', `shift` = '$shift', `fathername` = '$fathername', `occupation` = '$occupation', `income` = '$income', `mothername` = '$mothername', `bloodgroup` = '$bloodgroup', `nationality` = '$nationality', `nativity` = '$nativity', `religion` = '$religion', `caste` = '$caste', `fatherphone` = '$fatherphone', `motherphone` = '$motherphone', `studentphone` = '$studentphone', `address` = '$address' WHERE `users_login`.`id` = $id";
   
       $res = mysqli_query($conn,$query);

       if($res){
            $showalert="<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Success!</strong> Your Profile has Been Updated Successfully!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>";

       }
       else {
            $showerror="<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Error!</strong> Please Check the error and then retry ()!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>";
       }
   
    }
    if(isset($_POST['upload'])){
     
    //     if(empty($image)){
    //         $showerror2 ="<div class='alert alert-danger alert-dismissible fade show' role='alert'>
    //        <strong>Error ! Please Select an Image (Profile Picture Cannot Be Empty).</strong> 
    //        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    //      </div>";
    //    }
        $image = $_FILES['file']['name'];
        $tmp_image = $_FILES['file']['tmp_name'];
       

        $img_ext= explode(".",$image);
		$img_exten= $img_ext['1'];
        if($img_exten==''){
            $showerror2 ="<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Success!</strong> File Uploaded SuccessFully!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>";

        }
		$image =rand(1,10000).rand(1,1000).time().".".$img_exten;
		
		if($img_exten=='jpg' || $img_exten=='JPG' || $img_exten=='jpeg' || $img_exten=='JPEG' || $img_exten=='PNG' || $img_exten=='png'){
            move_uploaded_file($tmp_image,"images/$image");
            
		
           $sql_query = "UPDATE `users_login` SET `file`='$image' WHERE `users_login`.`id` = $id";
           $run = mysqli_query($conn,$sql_query);

        }
        if($run){
            $showalert ="<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Success!</strong> File Uploaded SuccessFully!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>";
        }
 else{
    $showerror="<div class='alert alert-danger alert-dismissible fade show' role='alert'>
    <strong>Error ! Only JPG and PNG image are Allowed with less than 2 mb.</strong> 
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
 }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="account.css">
</head>
<body> 
<?php include "navbar.php"; ?>    
<?php echo $showalert;
     echo $showerror; 
     echo $showerror2; ?>
<div class="container emp-profile my-6">
            <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="images/<?php echo $image; ?>" />
                            <div class="file btn btn-lg btn-light">
                                Change Photo
                                <input type="file" id="choose" name="file" onclick="myFunction()" />
                            </div>                         
                        </div>                       
                    </div>
                    <input type="submit" name="upload" id="uploadbtn" class="upload" value="Upload" style="display:none;"/>
                    </form> 
                    <div class="col-md-6">
                        <div class="profile-head">
                            <div class="button float-right"><button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#exampleModal">
  Edit Profile
</button></div>
                                    <h5>
                                    <p class="proile-name">Name : <span><?php echo $name; ?></span></p>
                                    </h5><hr>
                                    <h6>
                                    <p class="proile-name">Class : <span><?php echo $class ?></span></p>
                                    </h6><hr>
                                    <p class="proile-name">Register Number : <span><?php echo $register_number; ?></span></p>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true"></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                    

<!-- Modal -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body ">
      <label class="control-label" for="signupEmail">Username</label>
      <input class="form-control" id="disabledInput" name="username" type="text" placeholder="<?php echo $username; ?>" disabled><br>
      <label for="name" class="form-label">Name</label>
<input type="text" id="name" class="form-control" name="name" aria-describedby="Nameblock" value="<?php echo ucwords($name); ?>">
<br>
      <label for="reg_number5" class="form-label">Register Number</label>
<input type="text" id="reg_number" class="form-control" name="register_number" aria-describedby="register_numberHelpBlock" value="<?php echo $register_number; ?>"/>
<br>
      <label for="Class" class="form-label">Class</label>
<input type="text" id="Class" class="form-control" name="class" aria-describedby="ClassHelpBlock" value="<?php echo ucwords($class); ?>">
     <br>
     <label class="control-label" for="signupEmail">Email</label>
      <input class="form-control" id="disabledInput" name="email" type="email" placeholder="<?php echo $email; ?>" disabled>
<br>
      <label for="Age" class="form-label">Age</label>
<input type="text" id="Age" class="form-control" name="age" aria-describedby="AgeHelpBlock" value="<?php echo $age; ?>">
<br>
      <label for="dob" class="form-label">Date Of Birth</label>
<input type="text" id="dob" class="form-control" name="dob" aria-describedby="DObHelpBlock" value="<?php echo $dob; ?>">
<br>
      <label for="year" class="form-label">Year Of Studying</label>
<input type="text" id="year" class="form-control" name="yos" aria-describedby="yearHelpBlock" value="<?php echo $year; ?>">
<br>
      <label for="Batch" class="form-label">Batch</label>
<input type="text" id="Batch" class="form-control" name="batch" aria-describedby="batchHelpBlock" value="<?php echo $batch; ?>">
<br>
      <label for="shift" class="form-label">Shift</label>
<input type="text" id="shift" class="form-control" name="shift" aria-describedby="shiftHelpBlock" value="<?php echo $shift; ?>">
<br>
      <label for="fathername" class="form-label">Father Name</label>
<input type="text" id="fathername" class="form-control" name="fathername" aria-describedby="FatherNameHelpBlock" value="<?php echo ucwords($fathername); ?>">
<br>
      <label for="occupation" class="form-label">Occupation</label>
<input type="text" id="occupation" class="form-control" name="occupation" aria-describedby="OccupationHelpBlock" value="<?php echo ucfirst($occupation); ?>">
<br>
      <label for="income" class="form-label">Income</label>
<input type="text" id="income" class="form-control" name="income" aria-describedby="incomeHelpBlock" value="<?php echo $income; ?>">
<br>
      <label for="mothername" class="form-label">Mother Name</label>
<input type="text" id="mothername" class="form-control" name="mothername" aria-describedby="MotherNameHelpBlock" value="<?php echo ucwords($mothername); ?>">
<br>
      <label for="bloodgroup" class="form-label">Blood Group</label>
<input type="text" id="bloodgroup" class="form-control" name="bloodgroup" aria-describedby="BloodHelpBlock" value="<?php echo $bloodgroup; ?>">
<br>
      <label for="nationality" class="form-label">Nationality</label>
<input type="text" id="nationality" class="form-control" name="nationality" aria-describedby="NationalityHelpBlock" value="<?php echo ucfirst($nationality); ?>">
<br>
      <label for="nativity" class="form-label">Nativity</label>
<input type="text" id="nativity" class="form-control" name="nativity" aria-describedby="NativityHelpBlock" value="<?php echo ucfirst($nativity); ?>">
<br>
      <label for="religion" class="form-label">Religion</label>
<input type="text" id="religion" class="form-control" name="religion" aria-describedby="ReligionHelpBlock" value="<?php echo ucfirst($religion); ?>">
<br>
      <label for="Caste" class="form-label">Caste</label>
<input type="text" id="Caste" class="form-control" name="caste" aria-describedby="CasteHelpBlock" value="<?php echo $caste; ?>">
<br>
      <label for="fatherphone" class="form-label">Father Phone</label>
<input type="text" id="fatherphone" class="form-control" name="fatherphone" aria-describedby="fatherphHelpBlock" value="<?php echo $fatherphone; ?>">
<br>
      <label for="motherphone" class="form-label">Mother Phone</label>
<input type="text" id="motherphone" class="form-control" name="motherphone" aria-describedby="Mother PhoneHelpBlock" value="<?php echo $motherphone; ?>">
<br>
      <label for="studentphone" class="form-label">Student Phone</label>
<input type="text" id="studentphone" class="form-control" name="studentphone" aria-describedby="Student PhoneHelpBlock" value="<?php echo $studentphone; ?>">
<br>
      <label for="Address" class="form-label">Address</label>
<input type="text" id="Address" class="form-control" name="address" aria-describedby="CasteHelpBlock" value="<?php echo $address; ?>">
<br>
     
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="update" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</form>
<!-- modal ends here -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work">
                           
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Username</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $username; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo ucwords($name); ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $email; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Student Mobile Number</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $studentphone; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Date Of Birth</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $dob; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Age</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $age; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Year Of Studying</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $year; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Batch</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $batch; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Shift</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $shift; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Religion</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo ucfirst($religion); ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Caste</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo ucfirst($caste); ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Nationality</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo ucfirst($nationality); ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Nativity</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo ucfirst($nativity); ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Blood Group</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $bloodgroup; ?></p>
                                            </div>
                                        </div>
                            </div>
                            <!-- <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab"> -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Father name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo ucwords($fathername); ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Mother Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo ucwords($mothername); ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Father Occupation</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo ucfirst($occupation); ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Father's Annual Income</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $income; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Father Phone Number</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $fatherphone; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Mother Phone Number</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $motherphone; ?></p>
                                            </div>
                                        </div>
                                <div class="row">
                                    <div class="col-md-6 add">
                                        <label>Address</label>
                                        <p><?php echo $address; ?></p>
                                        <a href="logout.php"><button type="button" class="btn btn-primary" >Logout</button></a>
                    
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- </div> -->
                     
        </div>
        
 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<script>
    let btn =document.getElementById("uploadbtn");

function myFunction(){
    var style=btn.style.display;
        if(style=='block')
        	{
            btn.style.display='none';
        	}
    	else{
            btn.style.display='block';
        	}    			
    }
</script>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</html>
