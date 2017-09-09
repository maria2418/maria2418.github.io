<?php
	session_start();
	require_once('dbconfig/config.php');
	
	
?>
<?php
if(isset ($_GET["id"]) && $_GET["id"] != "" )
{
	
	$id = $_GET["id"] ;
  $client_id = '92d98ec4a7b2927';
	
  $ch = curl_init();
  curl_setopt($ch,CURLOPT_URL,'http://api.imgur.com/3/gallery/'."$id");
  //curl_setopt($ch,CURLOPT_URL,'http://api.imgur.com/3/gallery/'.$id.'');
  curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 5);
  curl_setopt($ch,CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
  $result = curl_exec($ch);
  curl_close($ch);

  $json = json_decode($result, true);
  
 
	
  $chc = curl_init();
  curl_setopt($chc,CURLOPT_URL,'http://api.imgur.com/3/gallery/'.$id.'/comments/new');
  
  curl_setopt($chc,CURLOPT_CONNECTTIMEOUT, 5);
  curl_setopt($chc,CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($chc,CURLOPT_RETURNTRANSFER, true);
  curl_setopt($chc, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
  $resultc = curl_exec($chc);
  curl_close($chc);

  $jsonc = json_decode($resultc, true);
  
  
  
  
  
if(isset($json["data"]["images"][0]["link"]) && isset($jsonc["data"]) )
{
$link = 	$json["data"]["images"][0]["link"];
 $comment  = $jsonc["data"] ;
}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Home Page</title>
<link rel="stylesheet" href="style.css" type="text/css" media="all"/>

</head>
<body>
	<div id="main-wrapper">
		
		<center><h1 style=' font-family: French Script MT;font-size: 50px;'>Welcome <?php echo $_SESSION['username']; ?></h1></center>
		
		
		
			<div class="inner_container">
			<label><b style=' font-family: Comic Sans MS;font-size:20px;'>Please enter an Image Id</b></label><br/><br/>
			<form action="homepage.php">
				<input   type="text" placeholder="Image Id" name="id" id="Imgid" value = "" style='width: 555px;background-color: #f1f1f1;border-radius: 4px;padding: 12px 11px;' /><br/><br/>
				<button class = "retrieve_btn" style='font-family: Comic Sans MS;' >Submit</button>
				</form >
				<form action = "login.php">
				<button class="logout_button" style='font-family: Comic Sans MS;' >Log Out</button
				</form>
			</div>
		
		<br/>
		<div class="image_container">
		<?php 
		if(isset ($_GET["id"]) )
{ 
if($_GET["id"] != "" && isset($link) && isset($comment))
	
{             

 
 echo "<h1 style = 'text-align: center; font-family: Comic Sans MS;'>".$json["data"]["title"]."</h1>" ;
               echo '<img id="" width="660px" height="480px" src ="'.$link.'" 
               style="border: 4px solid black;display: block; margin: auto; max-width: 660px; max-height: 500px; border-radius: 8px;"/>' ;
			   echo "<br/><h2 style='font-family: Comic Sans MS;'>Comments:</h2><br/>" ;
			   foreach( $comment as $c){
echo '<span style = "color : blue;font-family: Comic Sans MS;" >ID : '.$c["id"].'</span><br/><br/> <span style = "color : green;font-family: Comic Sans MS;" >==>'.$c["comment"].'</span><hr><br/><br/>';
}
			   }

else
{
echo "<h3 style = 'color : red; text-align: center'>Please Enter proper ID  e.g. ghY2v</h3>" ;
}
}


	?>
		</div>
		

	</div>
</body>
</html>

