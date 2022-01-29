<?php
$err="";
include ('connect.php');
if(isset($_POST['login']))
{
	//start of try block
	
	try{
		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		
       
		
		$username=$_POST['username'];
		$password=$_POST['password'];

	    test_input($username);
		test_input($password);
		
		$username=mysqli_real_escape_string($con,$username);
		$password=mysqli_real_escape_string($con,$password);
		
		 //checking empty fields
		if(empty($username)){
			throw new Exception("Username is required!");
			
		}
		if(empty($password)){
			throw new Exception("Password is required!");
			
		}
		

		
		//establishing connection with db and things
	
		
		//checking login info into database
		// $row=0;
		// $result=mysqli_query($con,"SELECT * from admininfo where username=$username and password=$password and type='$_POST[type]'");
	
		$result=mysqli_query($con,"select * from admininfo where username='$username' and password='$password' and type='$_POST[type]'");
		
		$row=mysqli_num_rows($result);

		if($row>0 && $_POST['type'] == 'teacher'){
			session_start();
			$_SESSION['authorized']=TRUE;
			header('location: teacher/index.php');
		}

		else if($row>0 && $_POST['type'] == 'student'){
			session_start();
			$_SESSION['authorized']=TRUE;
			header('location: student/index.php');
		}

		else if($row>0 && $_POST['type'] == 'admin'){
			session_start();
			$_SESSION['authorized']=TRUE;
			header('location: admin/index.php');
		}

		else{
			throw new Exception("<div class='alert alert-danger alert-dismissible fade in show' role='alert'>
			<strong>Error!</strong> Username or Password or Role is invalid!
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
			  <span aria-hidden='true'>&times;</span>
			</button>
		  </div>");
			
			header('location: login.php');
		}
	}

	//end of try block
	catch(Exception $e){
		$error_msg=$e->getMessage();
	}
	//end of try-catch
}


?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Attendance Management System</title>
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
	 
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
	 
	<link rel="stylesheet" type="text/css" href="styles.css" >
	<link rel="stylesheet"  href="main.css">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
</head>

<body>
	<style type="text/css">
		body{

			background: url(img/svg_waves-3c1f0a785319462f6dce04d227eaf664.jpg)center/cover;
		}
		
	</style>
	<center>

<header>

  <h1>Attendance Management System</h1>

</header>

<h3>Login Panel</h3>

<?php
//printing error message
if(isset($error_msg))
{
	echo $error_msg;
}
echo $err;
?>



<div class="content" style="background-color:none;">
	<div class="row">

		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form-horizontal col-md-6 col-md-offset-3">
			<div class="form-group">
			    <label for="input1" class="col-sm-3 control-label">Username</label>
			    <div class="col-sm-7">
			      <input type="text" name="username"  class="form-control" id="input1" placeholder="Your Username" />
			    </div>
			</div>

			<div class="form-group">
			    <label for="input1" class="col-sm-3 control-label">Password</label>
			    <div class="col-sm-7">
			      <input type="password" name="password"  class="form-control" id="input1" placeholder="Your Password" />
			    </div>
			</div>


			<div class="form-group" class="radio">
			<label for="input1" class="col-sm-3 control-label">Login As:</label>
			<div class="col-sm-6">
			  <label>
			    <input type="radio" name="type" id="optionsRadios1" value="student" checked> Student
			  </label>
			  	  <label>
			    <input type="radio" name="type" id="optionsRadios1" value="teacher"> Teacher
			  </label>
			  <label>
			    <input type="radio" name="type" id="optionsRadios1" value="admin"> Admin
			  </label>
			</div>
			</div>


			<input type="submit" class="btn btn-success col-md-3 col-md-offset-7" style="border-radius:0%" value="Login" name="login" />
		</form>
	</div>
</div>

<p><strong><a href="reset.php" style="text-decoration:none;color:black;">Reset Password</a></strong></p>
<p><strong><a href="signup.php" style="text-decoration:none;color:black;">Create New Account</a></strong></p>

</center>
</body>
</html>
