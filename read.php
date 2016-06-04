<?php

	require_once('startsession.php');
	if(!($_SESSION['logged_in']==true))
{
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/readly/login.php');
    exit;


}

	$story = $_GET['s'];
 	$userID = $_SESSION['userID'];
 require_once('db.php');

 	$query =  " SELECT * FROM stories INNER JOIN user USING(userID) WHERE storyID = '$story' ";
 	$result = mysql_query($query);
 	if(mysql_num_rows($result)==1)
 	{
 		$row = mysql_fetch_array($result, MYSQL_ASSOC);
 		$link = "stories/".$row['link'];

 	}
 	else{
 		header('Location:404');
 	}

 	$checkreadsRem = " SELECT * FROM user WHERE userID = $userID ";
 	$getReadsRem = mysql_query($checkreadsRem);
 	$readsRem = mysql_fetch_array($getReadsRem, MYSQL_ASSOC);

 	
 	
 	
 	if($readsRem['readsRem'] <= 0 && $userID != $row['userID']){

 		$_SESSION['readalert'] = '<div class="alert alert-warning"> Sorry, you cannot read a story. You need to <a class="alert-link" href="write">'.
 					'write </a>'.
 					'or <a class="alert-link" href="upload"> Upload </a>'.
 					' one to be able to read 2 stories.  </div>';
 		header('Location:home');
 		exit();
 	}

 

 			//increase story reads by 1
 		

 		//reduce user reads by 1 if user isn't writer of story and increase number of reads
 		if($userID != $row['userID']){
 		$reduceReads = "UPDATE user SET readsRem = readsRem - 1 WHERE userID = $userID";
 		mysql_query($reduceReads);

 		$query1 = "UPDATE stories SET hits = hits + 1 WHERE storyID = '$story' ";
 		mysql_query($query1);
 		}

 		if(isset($_POST['addComment'])){
 			$comment = $_POST['comment'];
 			if(!empty($comment))
 			{
 				$add = "INSERT INTO comments(commentID,commentBody,commentTime,userID,storyID)
 						VALUES ('','$comment',NOW(),'$userID','$story') ";
 				mysql_query($add) or die(mysql_error());
 			}
 		}
 

	$pagetitle = "| ".$row['title'];
	require_once('header.php');
	
	require_once('navbar.php');

?>
<div class="container" id="wrap">
<div align="center" class="jumbotron container row">
	<div class="page-header"> <?php echo ucfirst($row['title']).'<small> by <a href="user?id='.$row['userID'].'">'.ucfirst($row['username']).'</a></small>'; ?> </div>

	<?php
$file = fopen($link, "r") or die("Unable to open file!");
// Output one line until end-of-file
while(!feof($file)) {
   echo fgets($file) . "<br>";
}
fclose($file);
?>
<div> 
	<div class="fb-share-button" data-href="" data-layout="box_count"></div>  
	<div class="g-plus" data-action="share" data-annotation:"vertical-bubble" ></div>
	<div>
	<a class="twitter-share-button" href=""
  data-related="twitterdev"
  data-size="large"
  data-count="none">
Tweet
</a>
</div>
</div>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script src="https://apis.google.com/js/platform.js" async defer></script>

<script>
window.twttr=(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],t=window.twttr||{};if(d.getElementById(id))return;js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);t._e=[];t.ready=function(f){t._e.push(f);};return t;}(document,"script","twitter-wjs"));
</script>
	<?php 
	$getcommentsquery = "SELECT * FROM comments INNER JOIN user USING(userID) WHERE storyID = $story ORDER BY commentTime DESC";
		$getcomments = mysql_query($getcommentsquery);
 ?>
 	<div class="comment container col-xs-6">
	<div class="page-header"> Comments(<?php echo mysql_num_rows($getcomments);?>)
	</div>
	<ul class="media-list  col-md-6 col-md-offset-3">
		<?php 
		
		if(mysql_num_rows($getcomments) >= 1){
			while ($getcommentsrow = mysql_fetch_array($getcomments)) {
				echo '<li class="media center"> <img class="avatar" src="images/userimage/'.
					$getcommentsrow['avatar'].'.jpg"'.
				'alt="'.
				$getcommentsrow['username'].'" />'.
				'<div class="media-body">'.
				$getcommentsrow['commentBody'].'<div> <small> - '.'<a href="user?id='.
				$getcommentsrow['userID'].'">'.
				$getcommentsrow['username'].'</a> </small> </div> </div> '.
				'</li>';
			}
		}

		else{
			echo '<li class="media"> No comments </li>';
		}


		 ?>
	
</ul>


<div class="container">

	<form action="" method="post" class="form-horizontal" role="form">
		<div class="form-group">
			<label class="control-label col-md-4" for="comment"> Comment </label>
			<div class="col-md-4">
				<textarea name="comment" class="black" style="margin: 0px; width: 300px; height: 80px;"> </textarea>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-offset-3 col-md-3">
				<input name="addComment" type="submit" id="addCoomment" value="Comment" class="btn-primary btn" />
			</div>
		</div>
	</form>



</div>
</div>
<div class="col-xs-6">
	<div class="page-header"> Stories You May Like</div>


	</div>

</div>
</div>

<?php require_once('footer.php'); ?>