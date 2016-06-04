<?php
 require_once('db.php');
 require_once('startsession.php');
@$username=$_POST['username'];
@$password=$_POST['password'];
@$username=strtolower($username);
@$password=strtolower($password);


$lo="SELECT * FROM  user WHERE username='$username' AND password=sha1('$password')";
@$mylo=mysql_query($lo) or die(@mysql_error());

 if(mysql_num_rows($mylo)==1){
	
	 @$row = mysql_fetch_array($mylo, MYSQL_ASSOC);
	 @$_SESSION['lastname'] = $row['lastname'];
	 @$_SESSION['firstname'] = $row['firstname'];
	 $_SESSION['userID'] = $row['userID'];
	 $_SESSION['useravatar'] = $row['avatar'];
	 $_SESSION['logged_in'] = true; 
	 $_SESSION['username']= $row['username'];
   header("Location:home");
 }
 else{
$_SESSION['alert'] = '<div class="alert alert-danger"> Error! Invalid Username and/or Password </div>';
	header("Location:login");

 }
 
 ?>