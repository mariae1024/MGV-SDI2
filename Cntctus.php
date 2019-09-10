<?php
session_start();
?>

<html>
<head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>MGV- Online meal ordering</title>

    <link href="Cntctus.css" rel="stylesheet">
    <script type="text/javascript" src="Cntctus.js"></script> 
   

</head>
<body>

<div class="collapse" id="navbarToggleExternalContent">
        <div class="bg-dark p-4">
         <div class="row mt-5">
             <div class="col-md-8">
              <h4 class="text-white">About MGV</h4>
                <p class="text-justify text-muted">MGV is an New Zealand pvt, ltd. company based in Auckland offering online meals for Indian, Colombian, Spanish and Korean Cuisines cuisines. You can now order your food online within few minutes. Here at MGV, we make sure that our customers are fully satisfied. 
                </p>
                </div>
                <div class="offset-md-2"><!-- moving content to rigth-->
                <h4 class="text-white">Tools</h4>
                            <ul class="list-unstyled">
                            <?php
                                  if(!isset($_SESSION["is_auth"])) {
                                    echo '<li><a href="Register.php" class="text-white">Register</a></li>';
                                    echo '<li><a href="login.php" class="text-white">Log in</a></li>';
                                  }
                                
                                if(isset($_SESSION["is_auth"])){
                                    
                                    if($_SESSION['role']=='admin'){
                                        echo '<li><a href="adminstaffusers.php" class="text-white">Admin panel</a></li>';
                                    }else if($_SESSION['role']=='supplier1' || $_SESSION['role']=='supplier2'|| $_SESSION['role']=='supplier3' || $_SESSION['role']=='supplier4'){
                                        echo '<li><a href="newmenusuppliers.php" class="text-white">Suppliers panel</a></li>';
                                    }else if ($_SESSION['role']=='delivery'){
                                        
                                        echo '<li><a href="allordersdelivery.php" class="text-white">Delivery panel</a></li>';
                                    }
                                    
                                    }

                                  if(isset($_SESSION["is_auth"])) {
                                    echo '<li><a href="Profile.php?id='. $_SESSION["id"] .'" class="text-white">Profile</a></li>';
                                    echo '<li><a href="logout.php" class="text-white">Log out</a></li>';
                                  }
                                
                            ?>
                            </ul>
                </div>
            </div>
        </div>
  </div>
  <nav class="navbar fixed-top navbar-dark bg-dark nav-pills"><!-- hovering with jqury not working-->
   <a class="navbar-brand nav-link" href="landingpage.php">MGV</a> <!--connecting landing page to MGV button-->
   <ul class="nav nav-pills mr-auto m-n3"><!-- m-n3 margin negative 3 mr-auto moving group to left by putting margin on right-->
  <li class="nav-item">
    <a class="nav-link" href="Menu.php">Menu</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="Cntctus.php">Contact Us</a>
  </li>
</ul>
  
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span><!-- collapse item means that appears when in clicked, data-target and controls is pointing the content that is gonna be showed when it collapse-->
    </button>
  </nav>

  
  						
											
											

<div class="container" style="margin-left:80px;margin-right:80px;">
					  <div class="row mt-5 mb-5">
						  <div class="col-md-6 mt-3">
							  <h3>Contact Us</h3> 
							  <?php  echo '<br>';
							     if(isset($_SESSION["is_auth"])) {  ?>
									 
								 
				<form class="form-signin" method="POST" action="senddatafeedback.php">
                
   
                            
						<div class="form-row">
						  <div class="form-group col-md-12">
								<label for="inputfname"><b>First Name</b></label>
								<input type="text" name="fname" pattern="[A-Za-z]{1,32}"  class="form-control" placeholder="First Name" required="name">									
							</div>
						</div>
                
						<div class="form-row">
						  <div class="form-group col-md-12">
								<label for="inputlname"><b>Last Name</b></label>
								<input type="text" name="lname" pattern="[A-Za-z]{1,32}" class="form-control" placeholder="Last Name" required="name">									
							</div>
						</div>
                
						<div class="form-row">
						  <div class="form-group col-md-12">
								<label for="inputphone"><b>Phone number</b></label>
								<input type="number" name="phone" pattern='[\+]\d{2}[\(]\d{2}[\)]\d{4}[\-]\d{4}' class="form-control" placeholder="Phone number" required="phone number">
							</div>
						</div>
                
						<div class="form-row">
						  <div class="form-group col-md-12">
								<label for="inputEmail"><b>Email</b></label>
								<input type="email" name="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="example@example.com" required="email">
							</div>
						</div>
                
                
						<div class="form-group">
							  <label for="comment">Feedback:</label>
							  <textarea class="form-control"val="" rows="5" type="textarea" name="feedback" required="text" ></textarea>
						</div>
                      
               
                      
						<div class="form-row">
							<div class="form-group">
								<button class="btn btn-primary btn-lg ml-2" type="submit">Submit</button>

								<button type="reset" class="btn btn-danger btn-lg" >Reset</button>
							</div>
						</div> 
            		</form>
    			</div>
                
                 <?php }else{  //&nbsp is for extra space between text
									 echo '<h3 style="color:red; text-shadow: black 0 0 10px;"><marquee width="1200" scrollamount="100" scrolldelay="500" loop="1000">Please log in to place a feedback!!! &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;                                 Please log in to place a feedback!!! &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;  Please log in to place a feedback!!!</marquee></h3>';
								 };
						  ?>
									 
              
                
                <?php   //starting session for location
							     if(isset($_SESSION["is_auth"])) {  ?>
                
                <div class="col-md-6 mt-3">
                    <h3>Our Location </h3><!--not responsive -->
                    
                     <div class="col" id="googleMap" style="width:500px;height:435px;margin-top:40px;"></div>
                     
                    <div class="row text-center mt-2">
                        <div class="col-md-4">
                          <a class="btnlocation smGlobalBtn"></a>
                          <h6>20 Hobson Street, Auckland 1010</h6>
                          <h6>New Zealand</h6>
                        </div>

                        <div class="col-md-4">
                          <a class="btnphone smGlobalBtn"></a>
                          <h6>+ 64 223 299 794</h6>
                          <h6>Avaliable 24/7 through the year</h6>
                        </div>

                        <div class="col-md-4">
                          <a class="btnemail smGlobalBtn"></a>
                          <h6>MGV@gmail.com</h6>
                        </div>
                      </div>
                     </div>
                    
                     
                       <?php }else{    //showing the location to users who are not logged in
									 echo '<div class="container" style="margin-left:680px;margin-right:80px;">
                    <h3>Our Location </h3>
                    
                     <div class="col" id="googleMap" style="width:500px;height:435px;margin-top:40px;"></div>
                     
                    <div class="row text-center mt-2">
                        <div class="col-md-4">
                          <a class="btnlocation smGlobalBtn"></a>
                          <h6>20 Hobson Street, Auckland 1010</h6>
                          <h6>New Zealand</h6>
                        </div>

                        <div class="col-md-4">
                          <a class="btnphone smGlobalBtn"></a>
                          <h6>+ 64 223 299 794</h6>
                          <h6>Avaliable 24/7 through the year</h6>
                        </div>

                        <div class="col-md-4">
                          <a class="btnemail smGlobalBtn"></a>
                          <h6>MGV@gmail.com</h6>
                        </div>
                      </div>
                     </div>';
								 };
						  ?>
                     
          </div>
	</div>
   

  

            
            


<footer class="container-fluid bg-dark">
      <div class="row">
       <div class="col-md-9">
        <div id="social">
        <a class="facebookBtn smGlobalBtn" href="https://www.facebook.com/" ></a>
        <a class="twitterBtn smGlobalBtn" href="https://twitter.com/?lang=en" ></a>
        <a class="linkedinBtn smGlobalBtn" href="https://www.linkedin.com/" ></a>
        <a class="instagramBtn smGlobalBtn" href="https://www.instagram.com/?hl=en" ></a>
    </div>
    </div>
    
       <div class="col-md-3">
        All rights reserved @ MGV.Ltd 2019
        </div>
        </div>
    </footer>
    
    
        
	
	    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMv3qNpKgcRpmqUZ7XgZNBprqcufuY6UQ&callback=myMap"></script>
         <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
</body>
</html>