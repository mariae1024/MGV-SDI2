<?php
session_start();
if($_SESSION["is_auth"] == false){
    header("Location: landingpage.php");
}
require_once('connect.php');
//$id = $_GET['id'];
$id =1;
$ReadSql = "SELECT * FROM packages WHERE id='$id'";
$res = mysqli_query($connection, $ReadSql);
//$ReadSql1 = "SELECT * FROM discount";
//$res1 = mysqli_query($connection, $ReadSql1);
$total_price=0;
$percentage =0;
?>


<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <link href="landing.css" rel="stylesheet">
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
   <a class="navbar-brand nav-link active" href="landingpage.php">MGV</a> <!--connecting landing page to MGV button-->
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
    
  if($_SERVER["REQUEST_METHOD"] == "POST"){
      if(empty($_POST['discount_code'])){
          echo '<script type="text/javascript">
         alert("Inser discount code"); 
         
         </script>';
          
      }else{
        $discount_code = $_POST['discount_code'];
        $conn = mysqli_connect("localhost", "root", "");
        //Selecting Database
        $db = mysqli_select_db($conn, "mgv");
        $query = mysqli_query($conn, "SELECT * FROM discount WHERE disc_code='$discount_code'");
        $R=mysqli_fetch_assoc($query);
        $rows = mysqli_num_rows($query);
          if($rows == 1){
              /*echo '<script type="text/javascript">
                alert("Found"); 
         
         </script>';*/
              //$total_price = 100;
              
              $percentage=$R['percentage'];
              
          
          }else{
              
              echo '<script type="text/javascript">
                alert("Code not found"); 
         
         </script>';
          }
      }
  }
    ?>
 
  <div class="container">
        <div class="row mt-5 mb-5 justify-content-center">
            <div class="col-md-6 mt-3" >
            <form class="form-signin" method="post" action="sendorder.php">
                <h1 class="h3 font-weight-normal" style="background-color:lightskyblue;border: 1px solid grey;">Buy Package</h1>
                
                <div class="form-row">
                  <div class="form-group col-md-6">
                        <label for="inputfname"><b>First Name</b></label>
                        <input type="text" name="fname" class="form-control" pattern="[A-Za-z ]{1,15}" value="<?php echo $_SESSION['first_name']; ?>" placeholder="Insert your first name" required>
                        
                        
                    </div>
                  <div class="form-group col-md-6">
                        <label for="inputlname"><b>Last Name</b></label>
                        <input type="text" name="lname" class="form-control" pattern="[A-Za-z ]{1,15}" value="<?php echo $_SESSION['last_name']; ?>" placeholder="Insert your last name" required>
                        
                        
                    </div>
                </div>
                
                <div class="form-row">
                  <div class="form-group col-md-12">
                        <label for="inputEmail"><b>Email</b></label>
                        <input type="email" name="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?php echo $_SESSION['email']; ?>" placeholder="Insert your email" required>
                        
                        
                    </div>
                </div>
                
                <div class="form-row">
                  <div class="form-group col-md-12">
                        <label for="inputPhone"><b>Phone Number</b></label>
                        <input type="number" id="phone" name="phone"  class="form-control" pattern="[0-9 ]{1,20}" value="<?php echo $_SESSION['phone_number']; ?>" placeholder="Insert your phone number" required>
                        
                    </div>
                </div>
                    
                 <div class="form-row">
                  <div class="form-group col-md-12">
                        <label for="inputPhone"><b>Address</b></label>
                        <input type="text" id="address" name="address"  class="form-control" pattern="[a-zA-Z0-9 ]{2,50}" value="<?php echo $_SESSION['address']; ?>" placeholder="Insert your address" required>
                        
                    </div>
                </div>
                   
                   <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="inputTypeCC"><b>Payment Method</b></label><br>
                
                   <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="inlineRadioOptions1" id="Master" value="option1">
                      <label class="form-check-label" for="inlineRadio1">Credit Card</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="inlineRadioOptions1" id="Visa" value="option2">
                      <label class="form-check-label" for="inlineRadio2">Debit Card</label>
                    </div>
                    
                    </div>
                </div>
                   
                    <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="creditcardNumber"><b>Card Number</b></label>
                        <input class="form-control" type="number" name="creditcard"  pattern="[0-9]{13,16}" placeholder="XXXX XXXX XXXX XXXX" id="CC" required>
                        </div>
                </div>
                
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="inputTypeCC"><b>Type of card</b></label><br>
                
                   <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="Master" value="option1">
                      <label class="form-check-label" for="inlineRadio1"><img src="MasterCard.jpg" width="70" height="40"></label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="Visa" value="option2">
                      <label class="form-check-label" for="inlineRadio2"><img src="visa.jpg" width="70" height="40"></label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="AmEx" value="option3">
                      <label class="form-check-label" for="inlineRadio3"><img src="AmEx.jpg" width="70" height="40"></label>
                    </div>
                    </div>
                </div>
                         
                    <div class="form-row">
                  <div class="form-group col-md-12">
                        <label for="inputPhone"><b>Special Requirements</b></label>
                        <textarea class="form-control mb-3" val="" rows="3" type="textarea" name="order_comment" required="text" placeholder="Insert extra comments here e.g no onions,no spicy,no garlic,no sauce, etc."></textarea>
                        
                    </div>
                </div>
                     
                     <div class="form-row">
                  <div class="form-group col-md-12">
                        <label for="inputPrice"><b>Final Price:</b></label><span>
                          
                           <?php while($r=mysqli_fetch_assoc($res)):?>
                           <?php $total_price = ($r['price']-($r['price']*($percentage/100)));
                                if($total_price==0){
                                $total_price = $r['price'];
                                }else{}
                            ?>
                            <label for="inputPrice"><?php echo $total_price;  ?></label>
                        </span>
                         </div>
                </div>
                     <div class="form-row">
                  <div class="form-group col-md-12">
                     <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" name="TandC" value="option1">
                      <label class="form-check-label" for="inlineCheckbox1">Terms and Conditions</label>
                    </div>
                         </div>
                </div>
                    
                     
                     
                      
               <div hidden>
                   <input type="text" name="userId" value="<?php echo $_SESSION['id']; ?>">
                    
                   <input type="text" name="packageId" value="<?php echo $r['id']; ?>">
                   <input type="number" name="price" value="<?php echo $r['price']; ?>">
                   <input type="number" name="total_price" value="<?php echo $total_price; ?>">
                   <input type="number" name="discount_percentaje" value="<?php echo $percentage; ?>">
                    <?php endwhile; ?>
                    <?php /*while($r1=mysqli_fetch_assoc($res1)):?>
                        <input type="number" name="discount_percentaje" value="<?php echo $r1['percentage']; ?>">
                        <?php endwhile; */?>    
               </div>

                      
                <div class="form-row">
                    <div class="form-group">
                        <button class="btn btn-primary btn-lg ml-2" type="submit" name="orders">Send</button>

                        <button type="reset" class="btn btn-danger btn-lg" >Reset</button>
                    </div>
                </div>
        
    </form>
    
    <form class="form-discount" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                             <label for="inputDiscount"><b>Discount Code</b></label>
                        <div class="form-row">
                          <div class="form-group col-md-8">

                                <input type="text" id="discount" name="discount_code"  class="form-control" pattern="[a-zA-Z0-9 ]{2,50}" placeholder="Insert your discount code">
                            </div>
                            <div class="form-group col-md-4">
                                <button class="btn btn-primary btn-m ml-2" type="submit" name="Add_code">Add</button>





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