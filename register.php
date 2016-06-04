<?php

include "db.php"; 
@$lastname=mysql_escape_string(trim($_POST['lastname']));
@$firstname=mysql_escape_string(trim($_POST['firstname']));
@$password=mysql_escape_string(trim($_POST['password']));
@$password2=mysql_escape_string(trim($_POST['password2']));
@$username=mysql_escape_string(trim($_POST['username']));
@$email=mysql_escape_string(trim($_POST['email']));

if(isset($_POST['signup'])){
	//check if given email exists
	$query = "SELECT * FROM user WHERE email = '$email'"  ;
		$result =   mysql_query($query);

			if(mysql_num_rows($result) >= 1)
			{
				@$alert  = '<div class="alert alert-danger"> E-mail is already registered to an account. </div>';

			}
			else{
			 	
			 	//check if given username exists
				$query = "SELECT * FROM user WHERE username = '$username'"  ;
				$result =   mysql_query($query);
				if(mysql_num_rows($result) >= 1){
				@$alert =  '<div class="alert alert-danger"> Username Already Exists, Pls choose another. </div>';
			}
			else {
	 			$regme = "INSERT INTO user(lastname,firstname,username,password,email,userID,joined) VALUES
     			('$lastname','$firstname','$username',sha('$password'),'$email','',NOW())";
	 			mysql_query($regme) or die(mysql_error());
				@$alert = '<div class="alert alert-success"> Congratulations, '.ucfirst($username).
				' , you have been registered successfully!.<a href="login" class="alert-link"> Login. </a> </div>';
}}
}

 	$pagetitle = "|Sign Up";
	require_once('header.php');
	require_once('navbar.php');

?>
                                     




	<div class="container" id="wrap" align="center">
		<div class="jumbotron" >
		<div class="container page-header">
	<h2> Sign Up</h2>
	</div>
	<div align="center">
			<form action="" method="post" class="form-horizontal" role="form" enctype="multipart/form-data" >
			<div class="form-group">
      			<label class="control-label col-sm-5" for="firstname"> Firstname </label>
			   <div class="col-sm-4">
			  <input class="form-control" placeholder="Enter first name" name="firstname" type="text" id="firstname" value="<?php echo $firstname; ?>" required />
			 </div>  
			</div>
			<div class="form-group"> 
				<label class="control-label col-sm-5" for="lastname">Lastname </label> 
			<div class="col-sm-4">
			  <input placeholder="Enter Last Name" class="form-control" name="lastname" type="text" id="lastname" value="<?php echo $lastname; ?>" required />
			 </div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-5" for="username"> Username </label>
				<div class="col-sm-4">
				  <input placeholder="Enter Username" class="form-control" name="username" type="text" id="username" value="<?php echo $username; ?>" required />
				</div>
			</div>	
			<div class="form-group">
				<label class="control-label col-sm-5" for="email"> E-mail </label>
				<div class="col-sm-4">	
				 <input placeholder="Enter E-mail" size="5" class="form-control" name="email" type="email" id="email" value="<?php echo $email; ?>" required />
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-5" for="password"> Password </label>
				<div class="col-sm-4">	
				 <input class="form-control" placeholder="Enter Password" name="password" type="password" id="password" value="<?php echo $password; ?>" required />
				</div>
			</div>
			 <div class="form-group">
				<label class="control-label col-sm-5" for="password2"> Re-type Password </label>
				<div class="col-sm-4">	
				 <input class="form-control" name="password2" placeholder="Re-enter Password" type="password" id="password2" required />
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-5 col-sm-4">
				<input name="signup" type="submit" id="signup" value="Sign Up" class="btn-primary" />
					<a href="login.php"> Already a member? Login </a>
				</div>
			</div>	
				</form>
                	
			 </div> 
             <div style="size:50px; color:red; "> <?php echo @$alert; ?> </div>
             </div>
             </div>
             <script src="js/validatereg.js"></script>
<?php require_once('footer.php'); ?>