<?php
	require_once('startsession.php');

	if(!($_SESSION['logged_in']=true))
{
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/readly/login.php');
    exit;


}

if(isset($_POST['logout'])){

session_destroy();
header('Location: http://' . $_SERVER['HTTP_HOST'] . '/readly/login.php');
    exit;
    }
	$pagetitle = ' | Write';
	require_once('header.php');
	
	require_once('navbar.php');

	if(isset($_POST['publish'])){

		$story = $_POST['story'];
		$title = $_POST['title']; 
		$userID = $_SESSION['userID'];
		$category = $_POST['category'];
		$filename = $_SESSION['userID'].time().'.txt';
		$filenamewithpath = 'stories/'.$_SESSION['userID'].time().'.txt';

		 $file = fopen($filenamewithpath,"w+") or die();
         file_put_contents($filenamewithpath, $story) or die();
         fclose($file);

         require_once('db.php');

         $query = " INSERT INTO stories(link,userID,hits,title,catID,date_created) VALUES ('$filename','$userID','0','$title','$category','NOW()')";
         mysql_query($query) or die(mysql_error());

         $getstoryID = "SELECT storyID FROM stories WHERE link = '$filename'";
         $result = mysql_query($getstoryID);
         $row  = mysql_fetch_array($result);

         //increase reads remaining for user
		 $reduceReads = "UPDATE user SET readsRem = readsRem + 2 WHERE userID = $userID";
 		 mysql_query($reduceReads);

         mysql_close();

         $alert = '<div class="alert alert-success"> Story <a class="alert-link" href="read?s='
         		.$row['storyID'].'">'
         		.ucfirst($title)
         		.'</a>'
         		.' has been published successfully</div>';

	}

	if(isset($_POST['cancel']))
	{
		header('location:write');
	}

?>

<div align="center" class="jumbotron container">
;	<div class="page-header">
		Write New Story
	</div>
	<div>	
		<form action="" method="post" class="form-horizontal" role="form">
			<?php if(isset($alert)) echo $alert; ?>
			<div class="form-group">
				<label class="control-label col-xs-3" for="title"> Title:</label>
				<div class="col-xs-6">
					<input class="form-control" placeholder="Enter Story Title" name="title" type="text" id="title" value="<?php echo @$title; ?>" />					
				</div>
			</div>
				<div class="form-group">
 			<label for="category"  class="control-label col-xs-3"> Category </label>
 			<div class="col-xs-6"> <select name="category" id="category" class=" form-control black" > 
 				
 				<option value="1"> Action </option>
 				<option value="2"> Adventure </option>
 				<option value="3"> Fiction </option>
 				<option value="4"> Gospel </option>
 				<option value="5"> Poetry </option>
 				</select>
 			</div>
 			</div>

			<div class="form-group">
				<label class="control-label col-xs-3" for="title"> Story:</label>
				<div class="col-xs-8 col-xs-offset-3">
					<textarea class="form-control" name="story" type="text" id="story" style="height:350px"></textarea>
				</div>
			</div>

			<div class="form-group">
				<div class="col-xs-offset-5 col-xs-4">
				<input name="publish" type="submit" id="publish" value="Publish" class="btn-success btn-lg" />
				<input name="cancel" type="submit" id="cancel" value="Cancel" class="btn-default btn-lg" />
				
				</div>
			</div>
		
		</form>
	</div>


</div>
<?php  require_once('footer.php'); ?>