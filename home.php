<?php 
 session_start();
 $userID = $_SESSION['userID'];

if(!($_SESSION['logged_in']==true))
{
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/readly/login');
    exit;


}
	



 require_once('db.php');
	$pagetitle = "| Home";

	require_once('header.php');
	
	require_once('navbar.php');
?>


<div class="container" id="wrap">
	<?php if(isset($_SESSION['readalert'])){ echo $_SESSION['readalert'];  } unset($_SESSION['readalert']); ?>
		<div class="jumbotron container row">
		<div class="container col-md-4 back ">
			<div class="container page-header">
			<h2> User Menu </h2>
			</div>
			<p> <a href="upload"> Upload New Story </a> </p>
			<p> <a href="write"> Write New Story </a> </p>
			<p> <a href=<?php echo '"userstories.php?id='.
					$userID.'"' ;?>
				> My Stories </a> </p>

			
		</div>
		
		
		
		<div class="col-md-4 container back">
		<div class="container page-header ">
		<h2> <a href="topstories"> Top Stories </a> </h2>  

		</div>
<div>
	 <ul class="list-group">
	 	<?php

	 	    $query = " SELECT * FROM stories INNER JOIN user USING(userID) ORDER BY hits DESC LIMIT 5 ";
    @$result = mysql_query($query);

    while (@$row = mysql_fetch_array($result)){
    	echo '<li class="list-group-item"><a href="read?s='.$row['storyID'].'">'.ucfirst($row['title']).
    		'</a> <small> By: <a href="user?id='.$row['userID'].'">'
    		.ucfirst($row['username']).' </a> </small> <span class="badge">*'.$row['hits'].' views* </span> </li>' ;

    }
	  
		 
	  ?>
	 </ul>
	</div>
	</div>
	
	<div class="container col-md-4 back">
			<div class="page-header container">
				<h2> <a href="recentstories"> Recent Stories </a> </h2>
			</div>
			<div>
				<ul class="list-group">
	 	<?php

	 	    $queryrecent = " SELECT * FROM stories INNER JOIN user USING(userID) ORDER BY storyID DESC LIMIT 5 ";
    @$resultrecent = mysql_query($queryrecent);

    while (@$rowrecent = mysql_fetch_array($resultrecent)){
    	echo '<li class="list-group-item"><a href="read?s='.$rowrecent['storyID'].'">'.ucfirst($rowrecent['title']).
    		'</a> <small> By: <a href="user?id='.$rowrecent['userID'].'">'
    		.ucfirst($rowrecent['username']).' </a> </small> <span class="badge">*'.$rowrecent['hits'].' views* </span> </li>' ;

    }
	  
		 
	  ?>
	 </ul>

			</div>
		</div>
		
		</div>
		</div>
  <?php require_once('footer.php'); ?>