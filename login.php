<?php
require_once('startsession.php');
if(isset($_SESSION['logged_in'])==true)

{
	if($_SESSION['logged_in'] == true){
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/readly/home');
    exit;
}

	else{
		session_destroy();
	}


}



@$username=mysql_escape_string(trim($_POST['username']));
@$password=mysql_escape_string(trim($_POST['password']));
@$username=strtolower($username);
@$password=strtolower($password);
		


   
	  	$pagetitle = "| Login";
	require_once('header.php');
	
	require_once('navbar.php');
?>

		<div class="container" id="wrap">
		<div class="container jumbotron row">
	<div class="col-md-6">
	<h2 > Welcome to Readly. A world where readers and writers connect.<br/>
	<small> Readly makes it possible for readers to also be writers, as it makes you write before you read. </small> </h2>
	<img class="col-lg-12 col-md-12 col-sm-12 col-xs-12" src="screenshots/profilecapture.jpg" class="thumbnail" />
	</div>
		<div class="col-md-6" >
		<div class="container page-header">
			<h2 align="center"> Login</h2>
		</div>	
			<div align="center"> 
			<form action="loginscript.php" method="post" class="form-horizontal">
				  <div class="form-group">
				  	 <div class="col-md-offset-3 col-md-6">
				  		<input class="black  form-control" name="username" type="text" placeholder="Enter Username" id="username" required /> 
				  	</div>
				  </div>	
				<div class="form-group">
					<div class="col-md-6 col-md-offset-3">
						<input class="black form-control" name="password" type="password" placeholder="Enter Password" id="password" required />
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-offset-3 col-md-6">
				 		<input name="login" type="submit" id="login" value="Login" class="btn-primary"/> 
                		<a href="register"> Not a member? Register </a> 
            		</div>
            	</div>

			</form>
                <?php if(isset($_SESSION['alert'])){ echo $_SESSION['alert'] ; session_destroy();} ?>		
			 </div>	
</div>			 
		</div>
		</div>
<?php require_once('footer.php'); ?>