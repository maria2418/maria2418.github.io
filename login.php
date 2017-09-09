<?php
	session_start();
	require_once('dbconfig/config.php');

?>

<!DOCTYPE html>
<html>
<head>
<title>Login Page</title>
<link rel="stylesheet" type="text/css" href="style.css"  media="all"/>
</head>
<body>
	<div id="main-wrapper">
	<center><h1 style=' font-family: French Script MT;font-size: 40px;'>Login</h1></center>
			
		<form action="login.php" method="post">
		
			<div class="inner_container">
				<label><b style=' font-family: Comic Sans MS;font-size:18px;'>Username</b></label>
				<input type="text" placeholder="Enter Username" name="username" required style='width: 555px;background-color: #f1f1f1;border-radius: 4px;padding: 12px 11px;'/>
				<label><b style=' font-family: Comic Sans MS;font-size:18px;'>Password</b></label>
				<input type="password" placeholder="Enter Password" name="password" required style='width: 555px;background-color: #f1f1f1;border-radius: 4px;padding: 12px 11px;'/>
				<button class="login_button" name="login" type="submit" style='font-family: Comic Sans MS;'>Login</button>
				<a href="index.php"><button type="button" class="register_btn" style='font-family: Comic Sans MS;'>Register</button></a>
			</div>
		</form>
		
		<?php
			if(isset($_POST['login']))
			{
				@$username=$_POST['username'];
				@$password=$_POST['password'];
				$query = "select * from userinfo where username='$username' and password='$password' ";
				//echo $query;
				$query_run = mysqli_query($con,$query);
				//echo mysql_num_rows($query_run);
				if($query_run)
				{
					if(mysqli_num_rows($query_run)>0)
					{
					$row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
					
					$_SESSION['username'] = $username;
					$_SESSION['password'] = $password;
					
					header( "Location: homepage.php");
					}
					else
					{
						echo '<script type="text/javascript">alert("No such User exists. Invalid Credentials")</script>';
					}
				}
				else
				{
					echo '<script type="text/javascript">alert("Database Error")</script>';
				}
			}
			else
			{
			}
		?>
		
	</div>
</body>
</html>