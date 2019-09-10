
 

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <link href="login.css" rel="stylesheet">
    <script type="text/javascript" src="login.js"></script>
  <title>MGV - Online meal ordering</title>
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
                <div class="offset-md-2"><!-- moving content ro rigth-->
                <h4 class="text-white">Tools</h4>
                            <ul class="list-unstyled">
                            <?php
                                  if(!isset($_SESSION["is_auth"])) {
                                    echo '<li><a href="Register.php" class="text-white">Register</a></li>';
                                    echo '<li><a href="login.php" class="text-white">Log in</a></li>';
                                  }
                                
                            
                            ?>
                            </ul>
                </div>
            </div>
        </div>
  </div>
  <nav class="navbar fixed-top navbar-dark bg-dark nav-pills"><!-- hovering with jqury not working-->
   <a class="navbar-brand nav-link" href="landingpage.php">MGV</a>
   <ul class="nav nav-pills mr-auto m-n3"><!-- m-n3 margin negative 3 mr-auto moving group to left by putting margin on right-->
  <li class="nav-item">
    <a class="nav-link" href=" ">Menu</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="Cntctus.php">Contact Us</a>
  </li>
</ul>
  
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span><!-- collapse item means that appears when in clicked, data-target and controls is pointing the content that is gonna be showed when it collapse-->
    </button>
  </nav>
     
        
        
							<?php    //email and password validation with PHP//

										/*use PHPMailer\PHPMailer\PHPMailer;
										use PHPMailer\PHPMailer\Exception;

										/* Include the Composer generated autoload.php file */
										//require 'C:\xampp\composer\vendor\autoload.php';
										// define variables and set to empty values
										/*$emailErr = $passwordErr = "";
										$email = $password = "";

										if ($_SERVER["REQUEST_METHOD"] == "POST") {
										  

										  if (empty($_POST["email"])) {
											$emailErr = "Email is required";
										  } else {
											  //first check if this email is actually a valid email address
											  if(filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){

												  $email =$_POST["email"];
											  }
											  else{
												  $emailErr="This is an invalid email format";
											  }

										  }

										  if(empty($_POST["password"])){   //change it according to database//
												$passwordErr = "Password is required";
												} else {
												if(preg_match("/^.*(?=.{6,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $password = $_POST["password"])){
													 $password = $_POST["password"];
												 } else {
													$passwordErr = "Invalid Password";
													}
												   }

								}*/

								?>   
   
                
    
      
<div class="container">
        <div class="row mt-5 justify-content-center">
            <div class="col-lg-8 mt-3" >
            <form class="form-signin ml-5" method="post" action="loginserv.php" nonvalidate>
                <h1 class="h3 font-weight-normal ml-5">Please sign in</h1>
                <p class="ml-5"><span class="error"><?php //echo $error;?></span></p>
                
                <div class="form-row ml-5">
						  <div class="form-group col-md-12">
								<label for="inputEmail"><b>Email</b></label>
								<input type="email" name="email" class="form-control" placeholder="example@example.com" onchange="emailregular()" id="loginMail" required autofocus>
								<!--<span class="error"><?php //echo $emailErr;?></span>-->

							</div>
						</div>
                
                <div class="form-row ml-5">
                  <div class="form-group col-md-12">
                        <label for="inputPassword"><b>Password</b></label>
                        <input type="password" id="inputPassword" name="password"   class="form-control" placeholder="Password" required>
                        <!--<span class="error"><?php //echo $passwordErr;?></span>-->
                    </div>
                </div>
                     
                     
                      <!--Google recaptch -->
                <div class="form-row">
                    <div class="form-group ml-5">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-3">
                        <div class="g-recaptcha" data-sitekey="6LfzyJgUAAAAAPeuAgsLodKfOAlChhzJ43I_S6Ql" ></div>
                        </div>
                    </div>
                </div>
                    
                    <div class="form-group ml-5">
                        <button class="btn btn-primary btn-lg ml-2" type="submit">Log in</button>

                        <button type="reset" class="btn btn-danger btn-lg" >Reset</button>

                        <span class="psw">Forgot <a href="PassRecovery.php">password?</a></span>
                
                </div>
        
    </form>
    
                      </div>
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
      
      
      
      
       <script src="https://www.google.com/recaptcha/api.js" async defer></script> 
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
       

</html>