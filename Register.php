<?php 
 include 'connect.php';
 $sql1="Select * from users";
            $res=mysqli_query($connection,$sql1);
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    
    <link href="mylogin.css" rel="stylesheet">
    <style>
    .error {color: #FF0000;}
    </style>
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
                <div class="offset-md-2"><!-- moving content to rigth-->
                <h4 class="text-white">User tools</h4>
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
   <a class="navbar-brand nav-link" href="landingpage.php">MGV</a>
   <ul class="nav nav-pills mr-auto m-n3"><!-- m-n3 margin negative 3 mr-auto moving group to left by putting margin on right-->
  <li class="nav-item">
    <a class="nav-link" href="Menu.php">Menu</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="Cntctus.php">Contact Us</a>
  </li>
</ul>
  
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span><!-- collapse item means that appears when in clicked, data-target and controls is pointing the content that is gonna be showed when it collapse-->
    </button>
  </nav>
   
<?php
    
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* Include the Composer generated autoload.php file */
require 'C:\xampp\composer\vendor\autoload.php';
// define variables and set to empty values
$fnameErr = $lnameErr = $emailErr = $phoneErr = $addressErr  = $dobErr = $passwordErr = "";
$fname = $lname = $email = $phone = $address = $dob = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["fname"])) {
    $fnameErr = "First name is required";
  } else {
      
      if (preg_match("/^[a-zA-Z ]+$/",$fname =$_POST["fname"])) {
        $fname =$_POST["fname"];
      }
      else{
        $fnameErr="First name is invalid";  
      }
    
  }
    
if (empty($_POST["lname"])) {
    $lnameErr = "Last name is required";
  } else {
    if (preg_match("/^[a-zA-Z ]+$/",$lname =$_POST["lname"])) {
        $lname =$_POST["lname"];
      }
      else{
        $lnameErr="Last name is invalid";  
      }
    
  }
  
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
    if(empty($_POST["address"])){
        $addressErr = "Address is required";
    } else {
        $address =$_POST["address"];
    }
    
     if(empty($_POST["dob"])){
        $dobErr = "Date of birth is required";
    } else {
        $dob =$_POST["dob"];
    }

  if(empty($_POST["password"])){
    $passwordErr = "Password is required";
    } else {
   if(preg_match("/^.*(?=.{6,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $password = $_POST["password"])){
   $password = $_POST["password"];
   } else {
   $passwordErr = "Password must be at least 6 characters and must contain at least one lower case letter, one upper case letter and one digit";
    }
     }
    
if (empty($_POST["phone"])) {
    $phoneErr = "Phone number is required";
  } else {
    if (preg_match("/^[0-9 ]+$/",$phone =$_POST["phone"])) {
        $phone =$_POST["phone"];
      }
      else{
        $phoneErr="Phone number is invalid";  
      }
    
  }

  
}


?>   
  
  <?php
   
    
    function sendAccountConfirmationEmail($email,$fname,$lname){
                /* Create a new PHPMailer object. Passing TRUE to the constructor enables exceptions */
                $mail= new PHPMailer(TRUE);

                /* Open the try/catch block. */
                try{
                    /* Set the mail sender. */
                    $mail->setFrom('mm.gdit.ip@gmail.com','Maria GDIT Support');
                    /*echo "Hmm<br><br>"; /* just a debug trace statement */

                    /* Add a recipient. */
                    $mail->addAddress($email,$fname);

                    /* Set the subject */
                    $mail->Subject = "PHP Confirm Account Registration Test Email";

                    /* Set the mail message body. */
                    $mail->Body = 'Hi, ' . $fname . ' Your account has successfully been created. Your last name is ' . $lname . ' and your email address is ' . $email ;
                    /*echo "Howdy<br><br>"; /* just a debug trace statement */

                    /* SMTP parameters. */
                    $mail->isSMTP();

                    /*SMTP server address */
                    $mail->Host = 'smtp.gmail.com';

                    /* Use SMTP authentication. */
                    $mail->SMTPAuth = TRUE;

                    /* Set the encryption system */
                    $mail->SMTPSecure = 'tls';

                    /*SMTP authentication username. */
                    $mail->Username = 'mm.gdit.ip@gmail.com';

                    /*SMTP authentication password */
                    $mail->Password = 'Mailer@123';

                    /*Set the SMTP port */
                    $mail->Port = 587;

                    /* Finally send the email */
                    $mail->send();
                    /*echo "<b>Mail sent sucessfully<b><br><br>";/* just a debug trace statement */ 
                }
                catch (Exception $e){
                    /* PHPMailer exception*/
                    echo "First catch<br>";
                    echo $e->errorMessage();
                }
                catch (\Exception $e){
                    /* PHP exception (note the backslash to select the global namespace Exception class)*/
                    echo "Second catch<br>";
                    echo $e->getMessage();
                }

            }
    
    if($fname != "" && $lname != ""  && $email != "" && $password !="" && $phone !="" && $address !="" && $dob !=""){
        if($fnameErr == "" && $lnameErr == ""  && $emailErr == "" && $passwordErr =="" && $phoneErr =="" && $addressErr =="" && $dobErr ==""){
           
                
        $sql="INSERT INTO users (first_name,last_name,phone_number,email,address,dob,password,role,status) 
         VALUES ('$fname', '$lname','$phone', '$email', '$address', '$dob', '$password', 'customer', 'unavailable')";
        if(mysqli_query($connection,$sql)){
            echo ('<br><br><h3 class="mt-5 ml-5" style="color:green;">'. $fname . ', your account with email address ' . $email . ' has been created.You will receive a confirmation email shortly</h3><br><br>');
            sendAccountConfirmationEmail($email,$fname,$lname);
            
        }
        else{
            echo "Error inserting new user account: " . mysqli_error($connection);;
        }
        }
    }
    else{
        echo "<h3>Please ensure all fields are filled in and are valid</h3>";
    }
?>
   
<div class="container">
        <div class="row mt-5 mb-5 justify-content-center">
            <div class="col-md-6 mt-3" >
            <form class="form-signin" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" novalidate>
                <h1 class="h3 font-weight-normal">Please fill the values to register</h1>
                
                <div class="form-row">
                  <div class="form-group col-md-12">
                        <label for="inputfname"><b>First Name</b></label>
                        <input type="text" name="fname" class="form-control" placeholder="First Name">
                        <span class="error"><?php echo $fnameErr;?></span>
                        
                    </div>
                </div>
                
                <div class="form-row">
                  <div class="form-group col-md-12">
                        <label for="inputlname"><b>Last Name</b></label>
                        <input type="text" name="lname" class="form-control" placeholder="Last Name">
                        <span class="error"><?php echo $lnameErr;?></span>
                        
                    </div>
                </div>
                
                <div class="form-row">
                  <div class="form-group col-md-12">
                        <label for="inputEmail"><b>Email</b></label>
                        <input type="email" name="email" class="form-control" placeholder="example@example.com">
                        <span class="error"><?php echo $emailErr;?></span>
                        
                    </div>
                </div>
                
                 <div class="form-row">
                  <div class="form-group col-md-12">
                        <label for="inputphone"><b>Phone number</b></label>
                        <input type="number" name="phone" class="form-control" placeholder="Phone number">
                        <span class="error"><?php echo $phoneErr;?></span>
                        
                    </div>
                </div>
                
                <div class="form-row">
                  <div class="form-group col-md-12">
                        <label for="inputaddress"><b>Address</b></label>
                        <input type="text" name="address" class="form-control" placeholder="Address">
                        <span class="error"><?php echo $addressErr;?></span>
                        
                    </div>
                </div>
                
                <div class="form-row">
                  <div class="form-group col-md-12">
                        <label for="inputdob"><b>Date of birth</b></label>
                        <input type="date" name="dob" class="form-control" placeholder="dd/mm/yyyy">
                        <span class="error"><?php echo $dobErr;?></span>
                        
                    </div>
                </div>
                
                <div class="form-row">
                  <div class="form-group col-md-12">
                        <label for="inputPassword"><b>Password</b></label>
                        <input type="password" id="inputPassword" name="password"  class="form-control" placeholder="Password">
                        <span class="error"><?php echo $passwordErr;?></span>
                    </div>
                </div>
                      
               

                      
                <div class="form-row">
                    <div class="form-group">
                        <button class="btn btn-primary btn-lg ml-2" type="submit">Sign in</button>

                        <button type="reset" class="btn btn-danger btn-lg" >Reset</button>
                    </div>
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
      
      
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body> 
</html>