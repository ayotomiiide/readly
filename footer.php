
 </div>
 	<script src="js/jquery.js"></script>
   <script src="js/bootstrap.min.js"></script>
   
  
   <script type="text/javascript">
    $(function() {
        $.fn.scrollToTop = function() {
      $(this).hide().removeAttr("href");
      if ($(window).scrollTop() != "0") {
          $(this).fadeIn("slow")
      }
      var scrollDiv = $(this);
      $(window).scroll(function() {
          if ($(window).scrollTop() == "0") {
        $(scrollDiv).fadeOut("slow")
          } else {
        $(scrollDiv).fadeIn("slow")
          }
      });
      $(this).click(function() {
          $("html, body").animate({
        scrollTop: 0
          }, "slow")
      })
        }
    });
    $(function() {
        $("#scroll-to-top").scrollToTop();
    });

</script>
<a id="scroll-to-top" style="display: block;"></a>

   <div id="footer">
      
         <div class="container">
          <?php if(isset($_SESSION['logged_in'])){ ?>
        <div class="row">
          <div class="col-xs-3">
              <ul class="list-unstyled">
                  <li><a href="home">Home</a></li>
                  <li><a href="">Categories</a></li>
                  <li><a href="write">Write</a></li>
                  <li><a href="upload">Upload</a></li>
                  <li><a href="<?php  echo 'user?id='.$_SESSION['userID']; ?>">My Profile</a></li>
                  
                </ul>
          </div> <?php } ?>
          <div class="col-xs-3">
                <ul class="list-unstyled">
                  <li><a href="">Help & FAQ</a></li>
                  <li><a href="">Contact Us</a></li>
                  <li><a href="">Facebook</a></li>
                  <li><a href="">Twitter</a></li>
                </ul>
          </div>

          <div class="col-xs-6 text-right">All rights reserved. Copyright &copy; 2015 by Readly.
            <div>Designed and Created By   <a href="http://twitter.com/ayotomiiide">Oladipo Ayotomide </a></div>
          </div>
      
        
    </div>

    </div>     
     </div>


   
	  
  </body>
 </html>