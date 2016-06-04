<?php
	//start session
	require_once('startsession.php');

//check if user is logged in
if($_SESSION['logged_in']==false){
		header('Location:logout');
    }

	  
	 
	 if(!isset($_GET['s'])){
	 	header('location:home:php');
	 }

	 $storyID = $_GET['s'];

//check if story exists
	 require_once('db.php') ;
	 $getuserid = "SELECT * FROM stories WHERE storyID = $storyID";
	 $result = mysql_query($getuserid);
	 if(!mysql_num_rows($result)==1){
	 	header('location:logout');
	 }
	 else{
	 	$row  = mysql_fetch_array($result,MYSQL_ASSOC);
	 	// check if user is the writer of the story
	 	if($_SESSION['userID']!=$row['userID']){
	 		header('location:logout');
	 		
	 	}
	 }

	 $title = $row['title'];
	 $catID = $row['catID'];
	 $filelink = 'stories/'.$row['link'];
	 $file = fopen($filelink, "r") or die("Unable to open file!");

// Output one line until end-of-file


   $story = file_get_contents($filelink) or die("Unable to get file");

fclose($file);

	//get edited content and save to file and database
	if(isset($_POST['save'])){
		$newtitle = $_POST['title'];
		$newstory = $_POST['story'];
		$newcategory = $_POST['category'];
		$userID = $_SESSION['userID'];
		$filename = $filelink;

//write to file
		$filewrite = fopen($filename,"w") or die();
         file_put_contents($filename, $newstory) or die();
         fclose($filewrite);

         //save edited data to database 
         $savequery = "UPDATE stories SET title = '$newtitle', catID = '$newcategory' WHERE storyID = '$storyID' ";
         mysql_query($savequery);

         $_SESSION['savealert'] = 
        '<div class="alert alert-success"> Story <a class="alert-link" href="read?s='
         		.$row['storyID'].'">'
         		.ucfirst($newtitle)
         		.'</a>'
         		.' has been edited successfully</div>';
         		mysql_close();
         header('Location:'.$_SERVER['PHP_SELF'].'?s='.$storyID);
	}

	require_once('header.php');
	require_once('navbar.php');
	 ?>
	 <div class="container" id="wrap" align="center">
		<div class="jumbotron" >
			<div class="container page-header">
				<h4> Edit Story</h4>
			</div>
				<div>	
		<form action="" method="post" class="form-horizontal" role="form">
			<?php if(isset($_SESSION['savealert'])){ echo $_SESSION['savealert']; } unset($_SESSION['savealert']); ?>

			<div class="form-group">
				<label class="control-label col-xs-3" for="title"> Title:</label>
				<div class="col-xs-6">
					<input class="form-control" placeholder="Enter Story Title" name="title" type="text" id="title" value="<?php echo @$title; ?>" />					
				</div>
			</div>
				<div class="form-group">
 			<label for="category"  class="control-label col-xs-3"> Category </label>
 			<div class="col-xs-6"> <select name="category" id="category" class=" form-control black" > 
 				<option <?php if($catID == 1){echo("selected");}?> value="1"> Action </option>
 				<option <?php if($catID == 2){echo("selected");}?> value="2"> Adventure </option>
 				<option <?php if($catID == 3){echo("selected");}?> value="3"> Fiction </option>
 				<option <?php if($catID == 4){echo("selected");}?> value="4"> Gospel </option>
 				<option <?php if($catID == 5){echo("selected");}?> value="5"> Poetry </option>
 				</select>
 			</div>
 			</div>

			<div class="form-group">
				<label class="control-label col-xs-3" for="title"> Story:</label>
				<div class="col-xs-8 col-xs-offset-3">
					<textarea class="form-control" name="story" type="text" id="story" style="height:350px">  <?php echo $story; ?></textarea>
				</div>
			</div>

			<div class="form-group">
				<div class="col-xs-offset-5 col-xs-4">
				<input name="save" type="submit" id="save" value="Save" class="btn-success btn-lg" />
				<input name="cancel" type="submit" id="cancel" value="Cancel" class="btn-default btn-lg" />
				
				</div>
			</div>
		
		</form>
	</div>
		</div>
	</div>


<?php require_once('footer.php'); ?> 