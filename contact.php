<?php 
 require_once('startsession.php');
 if(isset($_POST['logout'])){

session_destroy();
header('Location: http://' . $_SERVER['HTTP_HOST'] . '/readly/login.php');
    exit;
    }
  $pagetitle = "| Contact";
  require_once('header.php');
  
  require_once('navbar.php');
?>
              <div class="container back" id="wrap">
                <fieldset>
                  
                <div class="contact-form">
                  
                  <form class="form-horizontal col-md-8" role="form">

                    <div class="form-group">
                      <label for="name" class="col-md-2">Name</label>
                      <div class="col-md-10">
                        <input type="text" class="form-control" id="name" placeholder="Name">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="email" class="col-md-2">Email</label>
                      <div class="col-md-10">
                        <input type="email" class="form-control" id="email" placeholder="Email">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="subject" class="col-md-2">Subject</label>
                      <div class="col-md-10">
                        <input type="subject" class="form-control" id="subject" placeholder="Subject">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="message" class="col-md-2">Message</label>
                      <div class="col-md-10">
                        <textarea class="form-control" id="message" placeholder="Message"></textarea>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-lg btn-primary">Submit your message!</button>
                      </div>
                    </div>
                  </form> 
                </div>
              </fieldset>
              </div>
            
  
 <?php require_once('footer.php'); ?>