<?php
 session_start();

if(!($_SESSION['logged_in']==true))
{
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/readly/login');
    exit;


}
	
if(isset($_POST['logout'])){

$_SESSION['logged_in']=false;
session_destroy();
header('Location: http://' . $_SERVER['HTTP_HOST'] . '/readly/login');
    exit;
    }

     require_once('db.php');
	$pagetitle = "| Edit Profile";

	require_once('header.php');
	
	require_once('navbar.php');
	@$lastname = $_POST['lastname'];
	@$firstname = $_POST['firstname'];
	@$password = $_POST['password'];
	@$email = $_POST['email'];
	@$about= $_POST['about'];
	@$profilepic = $_FILES['profilepic']['name'];
	@$profilepic_type = $_FILES['profilepic']['type'];
	@$profilepic_size = $_FILES['profilepic']['size'];
	@$userID = $_SESSION['userID'];
	

	if (isset($_POST['edit'])) {
		$query = "SELECT * FROM user WHERE password = sha1('$password')";
		$result =   mysql_query($query);

			if(mysql_num_rows($result)==1)
			{
			if(!empty($lastname)){
				$q = "UPDATE user SET lastname = '$lastname' WHERE userID ='$userID'";
				mysql_query($q);
				mysql_close();
			}

			else if(!empty($firstname)){
				$q = "UPDATE user SET firstname = '$firstname' WHERE userID ='$userID'";
				mysql_query($q);
				mysql_close();
			}
			else if(!empty($email)){
				$q = "UPDATE user SET email = '$email' WHERE userID ='$userID'";
				mysql_query($q);
				mysql_close();
			}
			else if(!empty($about)) {
				$q = "UPDATE user SET about = '$about' WHERE userID ='$userID'";
				mysql_query($q);
				mysql_close();
			}
			else if(!empty($profilepic))
			{
				if((($profilepic_type == 'image/gif') || ($profilepic_type == 'image/jpeg') || 
					($profilepic_type == 'image/jpg') || ($profilepic_type == 'image/png')) &&
					($profilepic_size > 0) && ($profilepic_size <= 204800)){

				$target = "images/userimage/".$userID.".jpg";
		
			move_uploaded_file($_FILES['profilepic']['tmp_name'],$target);
			$q = "UPDATE user SET avatar = $userID WHERE userID = '$userID'"; 
			mysql_query($q);

			$alert = '<div class="alert alert-success"> Update Successfull! </div>';
			}
			else {
			 $alert = '<div class="alert alert-danger"> Problem uploading image. Image should be in jpg, png, or gif format and not more than 200kb in size </div>';
			 @unlink($_FILES['profilepic']['tmp_name']);

			}

				
			
			}



			}

			
		}

	if (isset($_POST['cancel'])) {
		header('Location: home.php');
	}
	

?>

<div class="container" id="wrap" align="center">
		<div class="jumbotron" >
		<div class="container page-header">
	<h2> Edit Profile</h2>
	</div>
	<div align="center">
			<?php echo @$alert; ?>
			<form action="" method="post" class="form-horizontal" role="form" enctype="multipart/form-data" >
			
			<div class="form-group">
				<label class="control-label col-sm-5" for="profilepic"> Display Picture </label>
				<div class="col-sm-4">
				  <input  class="form-control" name="profilepic" type="file" id="profilepic"  />
				</div>
			</div>

			<div class="form-group">
      			<label class="control-label col-sm-5" for="firstname"> Firstname </label>
			   <div class="col-sm-4">
			  <input class="form-control" placeholder="Enter first name" name="firstname" type="text" id="firstname"  />
			 </div>  
			</div>
			<div class="form-group"> 
				<label class="control-label col-sm-5" for="lastname">Lastname </label> 
			<div class="col-sm-4">
			  <input placeholder="Enter Last Name" class="form-control" name="lastname" type="text" id="lastname"  />
			 </div>
			</div>
	
				
			<div class="form-group">
				<label class="control-label col-sm-5" for="email"> E-mail </label>
				<div class="col-sm-4">	
				 <input placeholder="Enter E-mail" size="5" class="form-control" name="email" type="email" id="email"  />
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-5" for="about"> About Me </label>
				<div class="col-sm-4">	
				 <textarea class="form-control" name="about" placeholder="About Me" type="text" id="about" ></textarea>
				</div>
			</div> 
			<div class="form-group">
				<label class="control-label col-sm-5" for="password"> Password </label>
				<div class="col-sm-4">	
				 <input class="form-control" placeholder="Enter Password to Confirm Change" name="password" type="password" id="password" required />
				</div>
			</div>
			 
			<div class="form-group">
				<div class="col-sm-offset-5 col-sm-4">
				<input name="edit" type="submit" id="edit" value="Edit Profile" class="btn-primary" />
				<input name="cancel" type="submit" id="cancel" value="Cancel" class="btn-default" />
				
				</div>
			</div>	
				</form>
                	
			 </div> 
              
             </div>
             </div>



<?php require_once('footer.php'); ?>