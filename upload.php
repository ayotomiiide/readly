<?php 
 require_once('startsession.php');


if(!($_SESSION['logged_in']=true))
{
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/readly/login.php');
    exit;


}
		require_once('db.php');
	
	if (isset($_POST['submit'])){
	$title = $_POST['title'];
	$category = $_POST['category'];
	$story = $_FILES['story'] ['name'];
	$user_id = $_SESSION['userID'];
	$hits = 0 ;
	$target = $_SESSION['userID'].time().'.txt';
	
		if(!empty($story) && !empty($user_id)) {
		
			move_uploaded_file($_FILES['story']['tmp_name'],'stories/'.$target);
				$query = "INSERT INTO stories(link,userID,hits,title,catID) VALUES ('$target','$user_id','$hits','$title','$category')";

				//increase reads remaining for user
				$reduceReads = "UPDATE user SET readsRem = readsRem + 2 WHERE userID = $user_id";
 				mysql_query($reduceReads);

				@mysql_query($query) or die(mysql_error());
				
				$alert = '<div class="alert alert-success"> Story '.$title.' has been uploaded successfully</div>';
			
			
		}
	
	}
	
if(isset($_POST['logout'])){

session_destroy();
header('Location: http://' . $_SERVER['HTTP_HOST'] . '/readly/login.php');
    exit;
    }
	$pagetitle = "| Upload";
	require_once('header.php');
	
	require_once('navbar.php');
?>
<div align="center" class="jumbotron container row">
	<div align="center" class="col-md-6">
		
			<div class="page-header"> Upload New Story </div>
			<form enctype="multipart/form-data" action="" method="post" class="form-horizontal"> 
			<div class="form-group">
				
				<input type="hidden" name="MAX_FILE_SIZE" value="204800" />	
				<label for="story" class="control-label col-sm-4"> Story: </label>
				<div class="col-sm-6">
					<input type="file" name="story" id="story" class="form-control file"> </input>
 				</div>
 			</div>
 			<div class="form-group">
 			<label class="control-label col-sm-4" for="title"> Story Title </label> 
 			<div class="col-sm-6"> <input type="text" name="title" id="title" class="black form-control" required /> 
 			</div>
 		</div>
 		<div class="form-group">
 			<label for="category"  class="control-label col-sm-4"> Category </label>
 			<div class="col-sm-6"> <select name="category" id="category" class=" form-control black" required> 
 				<option value="1"> Action </option>
 				<option value="2"> Adventure </option>
 				<option value="3"> Fiction </option>
 				<option value="4"> Gospel </option>
 				<option value="5"> Poetry </option>
 				</select>
 			</div>
 			</div> 
			<input type="submit" value="Add" name="submit" class="btn-primary"> 
		</form>
		 <?php echo @$alert; ?>
	</div>
			
			
		
	
	<div class="col-md-6">
		<div class="page-header"> Recent Uploads </div>
		<div class="container">
		<ul class="list-group">
		<?php
			@$user_id = $_SESSION['userID'];
			$query1 = " SELECT * FROM stories WHERE userID=$user_id ORDER BY storyID DESC";
			$result = mysql_query($query1);
			
			
			
			while (@$row = mysql_fetch_array($result)){
			echo '<li class="list-group-item"><a href="read?s='.$row['storyID'].'">'.$row['title'].'</a> </li>' ; 
			}
		?>
		</ul>
		</div>
	</div>
</div>
 <?php require_once('footer.php'); ?>