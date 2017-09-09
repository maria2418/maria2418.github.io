<?php
	session_start();
	require_once('dbconfig/config.php');

?>
<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body>
	<div id="main-wrapper">
	<center><h1 style=' font-family: French Script MT;font-size: 40px;'>Register</h1></center>
		<form action="index.php" method="post">
			
			<div class="inner_container">
				<label><b style=' font-family: Comic Sans MS;font-size:18px;'>Username</b></label>
				</br>
				<input type="text" placeholder="Enter Username" name="username" required style='width: 555px;background-color: #f1f1f1;border-radius: 4px;padding: 12px 11px;' />
				<label><b style=' font-family: Comic Sans MS;font-size:18px;'>Email-Id</b></label><br/>
				
				<input type="text" placeholder="Enter Email-Id" name="email" required/ style='width: 555px;background-color: #f1f1f1;border-radius: 4px;padding: 12px 11px;' >
				<label><b style=' font-family: Comic Sans MS;font-size:18px;'>Password</b></label><br/>
				<input type="password" placeholder="Enter Password" name="password" required/ style='width: 555px;background-color: #f1f1f1;border-radius: 4px;padding: 12px 11px;' >
				<label><b style=' font-family: Comic Sans MS;font-size:18px;'>Confirm Password</b></label><br/>
				<input type="password" placeholder="Enter Password" name="cpassword" required/ style='width: 555px;background-color: #f1f1f1;border-radius: 4px;padding: 12px 11px;' ><br/><br/>
				<button name="reg" class="sign_up_btn" type="submit" style='font-family: Comic Sans MS;'>Sign Up</button>
				
				<a href="login.php"><button type="button" class="back_btn" style='font-family: Comic Sans MS;'>Existing User? Please Login</button></a>
			</div>
		</form>
		
		<?php
			if(isset($_POST['reg']))
			{
				@$username=$_POST['username'];
				@$email=$_POST['email'];
				@$password=$_POST['password'];
				@$cpassword=$_POST['cpassword'];
				
				if($password==$cpassword)
				{
					$query = "select * from userinfo where username='$username'";
					//echo $query;
				$query_run = mysqli_query($con,$query);
				//echo mysql_num_rows($query_run);
				if($query_run)
					{
						if(mysqli_num_rows($query_run)>0)
						{
							echo '<script type="text/javascript">alert("This Username Already exists.. Please try another username!")</script>';
						}
						else
						{
							$query = "insert into userinfo values('$username','$email','$password')";
							$query_run = mysqli_query($con,$query);
							if($query_run)
							{
								echo '<script type="text/javascript">alert("User Registered.. Welcome")</script>';
								$_SESSION['username'] = $username;
								$_SESSION['email'] = $email;
								$_SESSION['password'] = $password;
								header( "Location: homepage.php");
							}
							else
							{
								echo '<p class="bg-danger msg-block">Registration Unsuccessful due to server error. Please try later</p>';
							}
						}
					}
					else
					{
						echo '<script type="text/javascript">alert("DB error")</script>';
					}
				}
				else
				{
					echo '<script type="text/javascript">alert("Password and Confirm Password do not match")</script>';
				}
				
			}
			else
			{
			}
		?>
	</div>
</body>
</html>