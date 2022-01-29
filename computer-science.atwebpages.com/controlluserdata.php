<?php 
ob_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
session_start();
require "dbconnect.php";
$email = "";
$name = "";
$errors = array();
session_regenerate_id(false);

if(isset($_POST['check-email'])){
    $email = mysqli_real_escape_string($conn, test_input($_POST['email']));
    $check_email = "SELECT * FROM users_login WHERE email='$email'";
    $run_sql = mysqli_query($conn, $check_email);
    if(mysqli_num_rows($run_sql) > 0){
        $code = rand(999999, 111111);
        $_SESSION['email'] = $email;
        $insert_code = "UPDATE users_login SET code = $code WHERE email = '$email'";
        $run_query =  mysqli_query($conn, $insert_code);
        if($run_query){
            $to=$email;
            $subject='Password Reset Code';
            $Message="<center><img src='https://thenewcollege.edu.in/images/logo%20png%20bgm.png' height='100px' width='100px'/></center><br><b>Your OTP for Password Reset is</b>&nbsp;$code"; 
            $header='From: tonhan549@gmail.com' ;
            $header .="MIME-Version: TheNewCollege " ."\r\n";
            $header .="Content-type:text/html;charset=UTF-8"."\r\n";
            $mail = mail($to,$subject,$Message,$header);
// $mail = new PHPMailer(true);

// try {
// 	$mail->SMTPDebug = 2;									
// 	$mail->isSMTP();											
// 	$mail->Host	 = 'smtp.gmail.com;';					
// 	$mail->SMTPAuth = true;							
// 	$mail->Username = 'tonhan549@gmail.com';				
// 	$mail->Password = 'sujdkkqqwzqkshlu';						
// 	$mail->SMTPSecure = 'tls';							
// 	$mail->Port	 = 587;

// 	$mail->setFrom('tonhan549@gmail.com', 'The New College');		
// 	$mail->addAddress("$email");
// 	$mail->addAddress("$email", "$name");
	
// 	$mail->isHTML(true);								
// 	$mail->Subject = 'Password Reset Code';
// 	$mail->Body = "<center><img src='https://thenewcollege.edu.in/images/logo%20png%20bgm.png' height='100px' width='100px'/></center><br><b>Your OTP for Password Reset is</b>&nbsp;$code";
// 	$mail->AltBody = 'nothing';
// 	$mail->send();
// 	echo "Mail has been sent successfully!";
       
    
// } catch (Exception $e) {
// 	echo "Message could not be sent. Mailer Error";
// }
    
    if($mail){
                $info = "We've sent a passwrod reset otp to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                header("location: reset-code.php");
                exit();
               
            }
            
            else{
                $errors['otp-error'] = "Failed while sending code!";
            }
        }else{
            $errors['db-error'] = "Something went wrong!";
        }
    }else{
        $errors['email'] = "This email address does not exist!";
    }
}

//if user click check reset otp button
if(isset($_POST['check'])){
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($conn, test_input($_POST['otp']));
    $check_code = "SELECT * FROM users_login WHERE code = $otp_code";
    $code_res = mysqli_query($conn, $check_code);
    if(mysqli_num_rows($code_res) > 0){
        $fetch_data = mysqli_fetch_assoc($code_res);
        $email = $fetch_data['email'];
        $_SESSION['email'] = $email;
        $info = "Please create a new password that you don't use on any other site.";
        $_SESSION['info'] = $info;
        header('location: new-password.php');
        exit();
    }else{
        $errors['otp-error'] = "You've entered incorrect code!";
    }
}

//if user click change password button
if(isset($_POST['change-password'])){
    $_SESSION['info'] = "";
    $password = mysqli_real_escape_string($conn, test_input($_POST['password']));
    $cpassword = mysqli_real_escape_string($conn, test_input($_POST['cpassword']));
    if($password !== $cpassword){
        $errors['password'] = "Confirm password not matched!";
    }else{
        $code = 0;
        $email = $_SESSION['email']; //getting this email using session
        $encpass = password_hash($password,PASSWORD_BCRYPT);
        $update_pass = "UPDATE users SET code = $code, password = '$encpass' WHERE email = '$email'";
        $run_query = mysqli_query($conn, $update_pass);
        if($run_query){
            $info = "Your password changed. Now you can login with your new password.";
            $_SESSION['info'] = $info;
            header('Location: login/');
        }else{
            $errors['db-error'] = "Failed to change your password!";
        }
    }
}
// if user click on check for code verfication...
if(isset($_POST['verify'])){
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($conn,($_POST['otp']));
    $check_code = "SELECT * FROM users_login WHERE code = $otp_code";
    $code_res = mysqli_query($conn, $check_code);
    if(mysqli_num_rows($code_res) > 0){
        $fetch_data = mysqli_fetch_assoc($code_res);
        $fetch_code = $fetch_data['code'];
        $email = $fetch_data['email'];
        $code = 0;
        $status = 'verified';
        $update_otp = "UPDATE users_login SET code = $code, status = '$status' WHERE code = $fetch_code";
        $update_res = mysqli_query($conn, $update_otp);
        if($update_res){
            $_SESSION['name'] = $name;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            echo "<script>alert('Email has been verified successfully')</script>";
            header('location: account.php');
            exit();
        }else{
            $errors['otp-error'] = "Failed while updating code!";
        }
    }else{
        $errors['otp-error'] = "You've entered incorrect code!";
    }
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

ob_end_flush();
?>