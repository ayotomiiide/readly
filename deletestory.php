<?php
	//start session
	require_once('startsession.php');

//check if user is logged in
if($_SESSION['logged_in']==false){
		header('Location:logout');
    }

	  
	 
	 if(!isset($_GET['s'])){
	 	header('location:home');
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
	 	$filelink = 'stories/'.$row['link'];
	 	$title = $row['title'];
	 	// check if user is the writer of the story
	 	if($_SESSION['userID']!=$row['userID']){
	 		header('location:logout');
	 		
	 	}
	 }
	

	//delete story file from disk
	 if (file_exists($filelink)) {
       unlink($filelink);
      //delete sttory from database
	$deletequery = "DELETE FROM stories WHERE storyID = $storyID";
	mysql_query($deletequery) or die("Error in deleting story");

    }

    $_SESSION['deletealert'] = 
        '<div class="alert alert-success"> Story ' 
         		.ucfirst($title)
         		.' has been deleted successfully</div>';
         		
         		mysql_close();

         		header('Location:userstories?id='.$_SESSION['userID'].'');
         		exit();
	 ?>