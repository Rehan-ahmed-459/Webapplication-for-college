<?php
ob_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include "function.php";
include 'dbconnect.php';
include "emailfunc.php";
include "controlluserdata.php";


// varaible declaration
$errors =array();
$email='';
$name='';
$msg1='';$msg2='';$msg3='';$msg4='';
$msg5='';$msg6='';$msg7='';$msg8='';
$msg9='';$msg10='';$msg11='';$msg12='';
$msg13='';$msg14='';$msg15='';$msg16='';
$msg17='';$msg18='';$msg19='';$msg20='';
$msg21='';$msg22='';$msg23='';$msg24='';$msg25='';$msg26='';$msg27='';$msg28='';$msg29='';$msg30='';$msg31='';$msg32='';

// variable declaration for Autocomplete of previous entered data
$name='';$register_number='';$class='';$age='';$dob='';$year='';$batch='';$shift='';$fathername='';$occupation='';$income='';$mothername='';$email='';$bloodgroup='';$nationality='';$nativity='';$religion='';$caste='';$fatherphone='';$motherphone='';$studentphone='';$address='';
// if user submit then post the data
if(isset($_POST['submit'])){
	$name = test_input(mysqli_real_escape_string($conn,$_POST['name']));
	$register_number = test_input(mysqli_real_escape_string($conn,$_POST['register_number']));
	$class = test_input(mysqli_real_escape_string($conn,$_POST['class']));
	$age = test_input(mysqli_real_escape_string($conn,$_POST['age']));
	$dob = test_input(mysqli_real_escape_string($conn,$_POST['dob']));
	$year = test_input(mysqli_real_escape_string($conn,$_POST['yos']));
	$batch = test_input(mysqli_real_escape_string($conn,$_POST['batch']));
	$shift =test_input(mysqli_real_escape_string($conn,$_POST['shift']));
	$fathername = test_input(mysqli_real_escape_string($conn,$_POST['fathername']));
	$occupation =test_input( mysqli_real_escape_string($conn,$_POST['occupation']));
	$income = test_input(mysqli_real_escape_string($conn,$_POST['income']));
	$mothername =test_input(mysqli_real_escape_string($conn,$_POST['mothername']));
	$email =test_input( mysqli_real_escape_string($conn,$_POST['email']));
	$bloodgroup = test_input(mysqli_real_escape_string($conn,$_POST['bloodgroup']));
	$nationality = test_input(mysqli_real_escape_string($conn,$_POST['nationality']));
	$nativity = test_input(mysqli_real_escape_string($conn,$_POST['nativity']));
	$religion = test_input(mysqli_real_escape_string($conn,$_POST['religion']));
	$caste = test_input(mysqli_real_escape_string($conn,$_POST['caste']));
	$fatherphone = test_input(mysqli_real_escape_string($conn,$_POST['fatherphone']));
	$motherphone = test_input(mysqli_real_escape_string($conn,$_POST['motherphone']));
	$studentphone = test_input(mysqli_real_escape_string($conn,$_POST['studentphone']));
	$address = test_input(mysqli_real_escape_string($conn,$_POST['address']));
	$image = $_FILES['file']['name'];
	$tmp_image = $_FILES['file']['tmp_name'];
	$username = test_input(mysqli_real_escape_string($conn,$_POST['username']));
	$password = test_input(mysqli_real_escape_string($conn,$_POST['password']));
	$cpassword = test_input(mysqli_real_escape_string($conn,$_POST['cpassword']));
	
	
	// Form validation starts here...
   if(empty($name)){
	   $msg1="<div class='error'>Name is required*</div>";
   }
   elseif(empty($register_number)){
	   $msg2="<div class='error'>Register Number is required*</div>";
   }
   elseif(empty($class)){
	   $msg3="<div class='error'>Class is required*</div>";
   }
   elseif(empty($age)){
	   $msg3="<div class='error'>Age is required*</div>";
   }
   elseif(empty($dob)){
	   $msg4="<div class='error'>Date of birth is required*</div>";
   }
   elseif(empty($year)){
	   $msg5="<div class='error'>Year is required*</div>";
   }
   elseif(empty($batch)){
	   $msg6="<div class='error'>Batch is required*</div>";
   }
   elseif(empty($shift)){
	   $msg7="<div class='error'>Shift is required*</div>";
   }
   elseif(empty($fathername)){
	   $msg8="<div class='error'>Father name is required*</div>";
   }
   elseif(empty($mothername)){
	   $msg9="<div class='error'>Mother name is required*</div>";
   }
   
//    elseif(!preg_match("/@thenewcollege.edu.in/",$email)){
// 	   $msg32="<div class='error'>Use Your Institutional Email id</div>";
//    }
   
   elseif(email_exists($email,$conn)){
	   $msg30="<div class='error'>Email Already exists</div>";
   }
   elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
	   $msg10="<div class='error'>Enter a Valid email*</div>";
   }

   elseif(empty($bloodgroup)){
	$msg11="<div class='error'>Blood Group is required*</div>";
} 
 	elseif(empty($nationality)){
	$msg12="<div class='error'>Nationality is required*</div>";
}  
	elseif(empty($nativity)){
	$msg13="<div class='error'>Nativity is required*</div>";
}  
	elseif(empty($religion)){
	$msg14="<div class='error'>Religion is required*</div>";
}  
	elseif(empty($caste)){
	$msg15="<div class='error'>Caste is required*</div>";
}
	elseif(empty($fatherphone)){
	$msg16="<div class='error'>Father mobile Number is required*</div>";
}
	elseif(empty($motherphone)){
	$msg17="<div class='error'>Mother mobile Number is required*</div>";
}
	elseif(empty($studentphone)){
	$msg18="<div class='error'>Student mobile Number is required*</div>";
}
	elseif(empty($address)){
	$msg19="<div class='error'>Address is required*</div>";
}
	elseif(empty($username)){
	$msg20="<div class='error'>Username is required</div>";
}
	elseif(strlen($password)<5){
	$msg21="<div class='error'> Password must contain atleast 6 Character</div>";
}

	elseif($password!==$cpassword){
	$msg22="<div class='error'>Confirm password are not matched</div>";
}
elseif(username_exists($username,$conn)){

	$msg24="<div class='error'>Username Already exists</div>";
}

	else{ 
		$img_ext= explode(".",$image);
		$img_exten= $img_ext['1'];
		$image =rand(1,10000).rand(1,1000).time().".".$img_exten;
		
		if($img_exten=='jpg' || $img_exten=='JPG' || $img_exten=='jpeg' || $img_exten=='JPEG' || $img_exten=='PNG' || $img_exten=='png'){
            move_uploaded_file($tmp_image,"images/$image");
			$code = rand(999999, 111111);
			$status = "notverified";
		
     $pass =password_hash($password,PASSWORD_BCRYPT);
	$sql = "INSERT INTO users_login (id, name, register_number, class,Age, dob, yos, batch, shift,email ,fathername,occupation,income,mothername, bloodgroup,nationality, nativity, religion, caste, fatherphone, motherphone, studentphone, address, file, username, password, cpassword,code,status) VALUES (NULL, '$name', '$register_number', '$class','$age', '$dob', '$year', '$batch', '$shift','$email','$fathername','$occupation','$income', '$mothername', '$bloodgroup', '$nationality', '$nativity', '$religion', '$caste', '$fatherphone', '$motherphone', '$studentphone', '$address', '$image', '$username', '$pass', '$cpassword','$code','$status')";
	$result = (mysqli_query($conn,$sql)); 
		
		}
	
		
	if($result){

	// $mail->SMTPDebug = 2;									
	// $mail->isSMTP();											
	// $mail->Host	 = 'smtp.gmail.com;';					
	// $mail->SMTPAuth = true;							
	// $mail->Username = 'tonhan549@gmail.com';				
	// $mail->Password = 'sujdkkqqwzqkshlu';						
	// $mail->SMTPSecure = 'tls';							
	// $mail->Port	 = 587;

	// $mail->setFrom('tonhan549@gmail.com', 'Noob-Hacker');		
	// $mail->addAddress("$email");
	// $mail->addAddress("$email", "$name");
	
	// $mail->isHTML(true);								
	// $mail->Subject = 'Verify Your Email-TheNewCollege';
	// $mail->Body = "<center><img src='https://thenewcollege.edu.in/images/logo%20png%20bgm.png' height='100px' width='100px'/></center><br><b>Your OTP to Verify Email is</b>&nbsp;$code<hr>OTP will expire in 15 mins...";
	// $mail->AltBody = 'nothing';
	// $mail->send();
	// echo "Mail has been sent successfully!";
	$to=$email;
            $subject='Password Reset Code';
            $Message="<center><img src='https://thenewcollege.edu.in/images/logo%20png%20bgm.png' height='100px' width='100px'/></center><br><b>Your OTP Verification Code is</b>&nbsp;$code"; 
            $header='From: tonhan549@gmail.com' ;
            $header .="MIME-Version: TheNewCollege" ."\r\n";
            $header .="Content-type:text/html;charset=UTF-8"."\r\n";
            $mail = mail($to,$subject,$Message,$header);
       
	}

    
    if($mail){
		$msg23= "<div class='success'>Your account has been created<br><a href='#'></a> </div>";
		
                $info = "We've sent a verification code to your email - $email";
				session_start();
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                $_SESSION['username'] = $username;
                header("location: user-otp.php");
                session_regenerate_id(true);
                exit();
 
            }
            
            else{
                $errors['otp-error'] = "Failed while sending code!";
            }
        }
        }
    else{
        $errors['email'] = "This email address does not exist!";
    }

	$name='';$register_number='';$class='';$age='';$dob='';$email='';$year='';$batch='';$shift='';$fathername='';$occupation='';$income='';$mothername='';$bloodgroup='';$nationality='';$nativity='';$religion='';$caste='';$fatherphone='';$motherphone='';$studentphone='';$address='';	
	
	
	



?>
<html>

<head>
	<meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<title>Register</title>
        <link rel="stylesheet" href="style.css">

</head>

<body>
	<?php echo $msg31; ?>
        
<div class="rule">
	<img class="logo" src="images/logo.png" width="150px" height="150px" />
<h1>THE NEW COLLEGE</h1>
<h2>DEPARTMENT OF COMPUTER SCIENCE</h2>
<h6>Read the Following Instrutions Before Creating Your Account:</h6>
<ul class="ul">
	<li class="item">To Create Your Account you must be a student of Our Department</li>
	<li class="item">Use Only Your Institutional Email Id provided By Our College</li>
	<li class="item">Do not Upload unwanted Images ,except your real Image</li>
	<li class="item">Image size should be less than 1 mb</li>
	<li class="item">Use Your Full Register Number</li>
	<li class="item">By Creating Your account You are accepting our Terms and Policys</li>
	
</ul>
	<div class="container">
		<div class="row">
			<div class="panel panel-primary">
				<div class="panel-body">
					<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" role="form">
						<div class="form-group">
							<?php echo $msg23;?>
							<h3>Create account</h3>
						</div>
						<div class="form-group">
							<label class="control-label" for="signupname">Your name</label>
							<input id="signupname" type="text" name="name" maxlength="50" class="form-control"
								placeholder="Your Name" value="<?php echo $name ;?>">
							<?php  echo $msg1;?>
						</div>

						<div class="form-group">
							<label class="control-label" for="registernum">Your Register Number</label>
							<input id="registernum" name="register_number" type="text" maxlength="50"
								class="form-control" placeholder="Your full Register Number"
								value="<?php echo $register_number; ?>">
							<?php  echo $msg2;?>
						</div>
						<div class="form-group">
							<label class="control-label" for="class">Course</label>
							<input list="class" type="text" name="class" maxlength="50" class="form-control"
								placeholder="Class" value="<?php echo $class; ?>">
							<datalist id="class">
								<option value="Bsc.Computer Science"></option>
								<option value="Msc.Computer Science"></option>
								
							</datalist>
							<?php  echo $msg3;?>
						</div>
						<div class="form-group">
							<label class="control-label" for="age">Your Age</label>
							<input id="age" type="text" name="age" maxlength="50" class="form-control"
								placeholder="Enter your Age" value="<?php echo $age ;?>">
							<?php  echo $msg26;?>
						</div>
						<div class="form-group">
							<label class="control-label" for="dob">Your Date of Birth</label>
							<input id="dob" type="date" name="dob" maxlength="50" class="form-control"
								placeholder="Date of Birth" value="<?php echo $dob; ?>">
							<?php  echo $msg4;?>
						</div>
						<div class="form-group">
							<label class="control-label" for="year">Year</label>
							<input list="year" type="text" name="yos" maxlength="50" class="form-control"
								placeholder="Year" value="<?php echo $year; ?>">
							<datalist id="year">
								<option value="FIRST YEAR"></option>
								<option value="SECOND YEAR"></option>
								<option value="THIRD YEAR"></option>
							</datalist>
							<?php  echo $msg5;?>
						</div>
						<div class="form-group">
							<label class="control-label" for="batch">Batch</label>
							<input list="batch" type="text" name="batch" maxlength="50" class="form-control"
								placeholder="Batch" value="<?php echo $batch; ?>">
							<datalist id="batch">
								<option value="Batch A"></option>
								<option value="Batch B"></option>
							</datalist>
							<?php  echo $msg6;?>
						</div>
						<div class="form-group">
							<label class="control-label" for="shift">Shift</label>
							<input list="shift" type="text" name="shift" maxlength="50" class="form-control"
								placeholder="Enter your shift" value="<?php echo $shift ;?>">
							<datalist id="shift">
								<option value="SHIFT-I"></option>
								<option value="SHIFT-II"></option>
							</datalist>
							<?php  echo $msg7;?>
						</div>
						<div class="form-group">
							<label class="control-label" for="fathername">Father Name</label>
							<input id="fathername" type="text" name="fathername" maxlength="50" class="form-control"
								placeholder="Father Name" value="<?php echo $fathername;?>">
							<?php  echo $msg8;?>
						</div>
						<div class="form-group">
							<label class="control-label" for="occupation">Father Occupation</label>
							<input id="occupation" type="text" name="occupation" maxlength="50" class="form-control"
								placeholder="Father occupation" value="<?php echo $occupation;?>">
							<?php  echo $msg27;?>
						</div>
						<div class="form-group">
							<label class="control-label" for="income">Father Annual Income</label>
							<input id="income" type="text" name="income" maxlength="50" class="form-control"
								placeholder="Father Income" value="<?php $income;?>">
							<?php  echo $msg28;?>
						</div>
						<div class="form-group">
							<label class="control-label" for="mothername">Mother Name</label>
							<input id="mothername" type="text" name="mothername" maxlength="50" class="form-control"
								placeholder="Mother name" value="<?php echo $mothername ;?>">
							<?php  echo $msg9;?>
						</div>
						<div class="form-group">
							<label class="control-label" for="signupEmail">Your Email</label>
							<input id="signupEmail" type="email" name="email" maxlength="50" class="form-control"
								placeholder="Your email" value="<?php echo $email ;?>">
							<?php echo $msg10; ?>
							<?php echo $msg30; ?>
							<?php echo $msg32; ?>

						</div>
						<div class="form-group">
							<label class="control-label" for="bloodgroup">Blood group</label>
							<input id="blood group" type="text" name="bloodgroup" maxlength="50" class="form-control"
								placeholder="Bloodgroup" value="<?php echo $bloodgroup ;?>">
							<?php  echo $msg11;?>
						</div>
						<div class="form-group">
							<label class="control-label" for="nationality">Nationality</label>
							<input id="nationality" type="text" name="nationality" maxlength="50" class="form-control"
								placeholder="Nationality" value="<?php echo $nationality ;?>">
							<?php  echo $msg12;?>
						</div>
						<div class="form-group">
							<label class="control-label" for="Nativity">Nativity</label>
							<input id="nativity" type="text" name="nativity" maxlength="50" class="form-control"
								placeholder="ex:Urban or Rural" value="<?php echo $nativity ;?>">
							<?php  echo $msg13;?>
						</div>
						<div class="form-group">
							<label class="control-label" for="religion">Religion</label>
							<input id="religion" type="text" name="religion" maxlength="50" class="form-control"
								placeholder="Religion" value="<?php echo $religion ;?>">
							<?php  echo $msg14;?>
						</div>
						<div class="form-group">
							<label class="control-label" for="caste">Caste</label>
							<input id="caste" type="text" name="caste" maxlength="50" class="form-control"
								placeholder="Caste" value="<?php echo $caste ;?>">
							<?php  echo $msg15;?>
						</div>
						<div class="form-group">
							<label class="control-label" for="fatherphone">Father Phone Number</label>
							<input id="fatherph" type="text" name="fatherphone" maxlength="50" class="form-control"
								placeholder="Father's  Mobile number" value="<?php echo $fatherphone ;?>">
							<?php  echo $msg16;?>
						</div>
						<div class="form-group">
							<label class="control-label" for="motherphone">Mother Phone Number</label>
							<input id="motherph" type="text" name="motherphone" maxlength="50" class="form-control"
								placeholder="Mother mobile number" value="<?php echo $motherphone ;?>">
							<?php  echo $msg17;?>
						</div>
						<div class="form-group">
							<label class="control-label" for="studentphone">Student Mobile Number</label>
							<input id="studentph" type="text" name="studentphone" maxlength="50" class="form-control"
								placeholder="Student mobile number" value="<?php echo $studentphone ;?>">
							<?php  echo $msg18;?>
						</div>
						<div class="form-group">
							<label class="control-label" for="address"> Your Address</label>
							<input id="address" type="text" name="address" maxlength="150" class="form-control"
								placeholder="Your address" value="<?php echo $address ;?>">
							<?php  echo $msg19;?>
						</div><br>
						<div class="form-group">
							<label class="control-label" for="profilepic">Upload your passport size photo</label>
							<input type="file" name="file" required>
							<?php echo $msg25; ?>
							<!-- <input type="submit" name="upload" value="Upload" class="btn"> -->
						</div>
						<div class="form-group">
							<label class="control-label" for="username"> Username</label>
							<input id="username" type="text" name="username" maxlength="50" class="form-control"
								placeholder="Username">
							<?php  echo $msg20;?>
							<?php echo $msg24;?>
						</div>
						<div class="form-group">
							<label class="control-label" for="signupPassword">Password</label>
							<input id="signupPassword" name="password" type="password" maxlength="50"
								class="form-control" placeholder="Choose a strong password" length="40">
							<?php  echo $msg21;?>
						</div>
						<div class="form-group">
							<label class="control-label" for="signupPasswordagain">Password again</label>
							<input id="signupPasswordagain" name="cpassword" type="password" maxlength="50"
								class="form-control" placeholder="Confirm password">
							<?php  echo $msg22;?>
						</div>
						<div class="form-group">
							<button id="signupSubmit" name="submit" type="submit" class="btn btn-info btn-block">Create
								your account</button>
						</div>
						<p class="form-group">By creating an account, you agree to our <a href="#">Terms of Use</a> and
							our <a href="#">Privacy Policy</a>.</p>
						<hr>
						<p></p>Already have an account? <a href="login.php">Sign in</a></p>
					</form>
				</div>
			</div>
		</div>
	</div>

</body>

</html>