<?php
 //Determine which navbar  to use depending on whether user is logged in
	if(isset($_SESSION['userID'])){
		require_once('usernavbar.php');
	}
	else{
		require_once('defaultnavbar.php');
	}
	
 
 ?> 
 
 <div class="container" id="wrap">