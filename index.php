<?php
  $pagetitle = "";
	
	//page header
	require_once('header.php');
	
	require_once('navbar.php')

?>

  <div class="container" id="wrap">
   <div class="container jumbotron row" >
	<div class="col-md-6">
	<h2 > Welcome to Readly. A world where readers and writers connect.<br/>
	<small> Readly makes it possible for readers to also be writers, as it makes you write before you read. </small> </h2>
	<img class="col-lg-12 col-md-12 col-sm-12 col-xs-12" src="screenshots/profilecapture.jpg" class="thumbnail" />
	</div>
	<div class="col-md-6 container" >
	<div class="page-header"> <h2>
	Available Free Stories </h2>
	</div>
	<div>
	 <table class="table ">
	  <tbody>
	    <tr>
		 <td> <a href="freestories/freestory1.html"> The Adventure of the Three Gables </a> </td>
		</tr>
		<tr>
		 <td> <a href="freestories/freestory2.html"> Cool Darkness </a> </td>
		</tr>
		<tr>
		 <td> <a href="freestories/freestory3.html"> Revolt of the Cyber Slaves </a> </td>
		</tr>
		<tr>
		 <td> <a href="freestories/freestory4.html"> The Beggars Bowl  </a> </td>
		</tr>
		<tr>
		 <td> <a href="freestories/freestory5.html"> Bureau </a> </td>
		</tr>
	  </tbody>
	 </table>
	 <div class="col-sm-offset-5 col-sm-5">
	 	<a href="login"><button class="btn btn-primary">Log In</button></a>
	 	<a href="register"><button class="btn btn-success">Sign Up</button></a>
	 </div>
	</div>
	</div>
   </div>
   </div>
  <?php require_once('footer.php'); ?>