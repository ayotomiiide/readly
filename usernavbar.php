

	<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
<div class="container">
<div class="navbar-header">
 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar">
      <span class="sr-only">Toggle navigation</span>
       <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
     </button>

<a class="navbar-brand" href="home"><img src="logosmall.png"></a>

	</div>
  <div class="collapse navbar-collapse" id="example-navbar">
<div class=" navbar-left" >
<ul class="nav navbar-nav">
<li><i class=""></i> </li>
<li class="active"><a href="home">Home</a></li>
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
Discover <b class="caret"></b>
</a>
<ul class="dropdown-menu">
  <li class="dropdown-header"> Categories </li>
<li><a href="search?q=&c=2">Adventure</a></li>
<li><a href="search?q=&c=1">Action</a></li>
<li><a href="search?q=&c=3">Fiction</a></li>
<li><a href="search?q=&c=4">Gospel</a></li>
<li class="divider"></li>
<li><a href="search?q=&c=5">Poetry</a></li>
<li class="divider"></li>
<li><a href="search?q=&c=6">Uncategorized</a></li>
<li class="divider"></li>
</ul>
</li>
<li><a href="#" class="dropdown-toggle" data-toggle="dropdown">
  Create <b class="caret"></b></a>
  <ul class="dropdown-menu">
    <li> <a href="write"> Write </a> </li>
    <li> <a href="Upload"> Upload Story </a> </li>
    <li class="divider"></li>

  </ul>

</li>
<li>
  <form class="navbar-form form-inline form-search" action="search" method="get"  > 
  	<input type="text" class="form-control" name="q" placeholder="Search" size="20" />
<input type="submit" class="btn btn-primary"  value="Search" /> </form> </li> </ul>

</div>
<div class=" navbar-right navbar-nav navbar-div" > 
	            <div class="user-name">
                <span><a href="#"> <?php  echo ucfirst(@$_SESSION['firstname']).' '.ucfirst(@$_SESSION['lastname']); ?></a></span>
             
            </div>

            <div class="user-avatar dropdown"><a data-toggle="dropdown" href="#"><img src="images/userimage/<?php if(isset($_SESSION['useravatar'])) echo $_SESSION['useravatar']; ?>.jpg"></a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
              <li role="presentation"><a role="menuitem" tabindex="-1" href=<?php echo'"user?id='.@$_SESSION['userID'].'"'; ?>>My Profile</a></li>
              <li role="presentation"><a role="menuitem" tabindex="-1" href="editprofile">Edit Profile</a></li>
              <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Preferences</a></li>
              <li role="presentation"><a role="menuitem" tabindex="-1" href="logout">Logout</a></li>
              <li role="presentation" class="divider"></li>


            </ul>
            </div>


</div>
</div>
 </div>
</nav>