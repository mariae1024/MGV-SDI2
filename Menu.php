<?php
session_start();
require_once('connect.php');

$ReadSql = "SELECT * FROM packages";
$res = mysqli_query($connection, $ReadSql);

?>


<html>
<head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>MGV - Online meal ordering</title>

    <link href="mylogin.css" rel="stylesheet">
    <script type="text/javascript" src="ContactUs.js"></script>


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
    <a class="nav-link active" href="Menu.php">Menu</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="Cntctus.php">Contact Us</a>
  </li>
</ul>
  
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span><!-- collapse item means that appears when in clicked, data-target and controls is pointing the content that is gonna be showed when it collapse-->
    </button>
  </nav>
  <hr class="mb-5">
  <div class="container">
      <div class="row mt-5" >
  <?php 
    
    
    while($r = mysqli_fetch_assoc($res)):?>
   
       <!--<div class="row">
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
       <img src="<?php// echo $r['image']?>" />
       <div class="caption">
        <h3><?php //echo $r['name']; ?></h3>
       <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
      </div>
    </div>
  </div>
</div>
      <hr class="mb-5">-->
              <?php if($r['id'] == 1) {?>
               <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
            <div class="caption">
             <h4><?php echo $r['name']; ?></h4>
            </div>
             <a href="meals_pckg_1.php?id=<?php echo $r['id']; ?>"><img src="<?php echo $r['image'] //"meals_pckg_1.php?id='.$r['id'].'"?>" style="width:250px;height:450px;"/> </a> 
            <div class="row">
              <h5 class="mt-5 ml-5"><b>Price:  $ </b><?php echo $r['price']; ?></h5>
        
              <?php
               if(isset($_SESSION["is_auth"])) {
                 echo '<a href="payment.php"><button type="button" class="btn btn-sm btn-primary mt-5 ml-5">Buy Now</button></a>';
                  }?>
        </div>
                                                </div>
                   </div>
                    
                                     <?php
                                      } else
                  if ($r['id'] == 2) {
                ?>
                <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
            <div class="caption">
             <h4><?php echo $r['name']; ?></h4>
            </div>
            
                        
        <a href="meals_pckg_1.php?id=<?php echo $r['id']; ?>"><img src="<?php echo $r['image']?>" style="width:250px;height:450px;"/></a>
                
            
            <div class="row">
              <h5 class="mt-5 ml-5"><b>Price:  $ </b><?php echo $r['price']; ?></h5>
        
              <?php
               if(isset($_SESSION["is_auth"])) {
                echo '<a href="payment.php"><button type="button" class="btn btn-sm btn-primary mt-5 ml-5">Buy Now</button></a>';
                  }?>
        </div>    
            </div>
       </div>
      </div>
         <div class="row mt-5 mb-5">
                                     <?php
                                      } else
                      if($r['id'] == 3){?>
                      <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
            <div class="caption">
             <h4><?php echo $r['name']; ?></h4>
            </div>
        <a href="meals_pckg_1.php?id=<?php echo $r['id']; ?>"><img src="<?php echo $r['image']?>" style="width:250px;height:450px;"/></a>
          <div class="row">
              <h5 class="mt-5 ml-5"><b>Price:  $ </b><?php echo $r['price']; ?></h5>
        
             <?php
               if(isset($_SESSION["is_auth"])) {
               echo '<a href="payment.php"><button type="button" class="btn btn-sm btn-primary mt-5 ml-5 mb-3">Buy Now</button></a>';
               }?>
        </div>
                                    
            </div>
           </div>
       
         
                                     <?php
                                      } else 
                          if($r['id'] == 4) {?>
                          <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
            <div class="caption">
             <h4><?php echo $r['name']; ?></h4>
            </div>
        <a href="meals_pckg_1.php?id=<?php echo $r['id']; ?>"><img src="<?php echo $r['image']?>" style="width:250px;height:450px;"/></a>
          <div class="row">
              <h5 class="mt-5 ml-5"><b>Price:  $ </b><?php echo $r['price']; ?></h5>
        
              <?php
               if(isset($_SESSION["is_auth"])) {
                echo '<a href="payment.php"><button type="button" class="btn btn-sm btn-primary mt-5 ml-5">Buy Now</button></a>';
                  }?>
        </div>
               </div>
           </div>
      </div>
          
         
                                     <?php
                                      }?>
                
            
            
            
  
    
  <?php  endwhile; ?>
    
    </div>
  
  
  
  

    
<footer class="container-fluid bg-dark mt-5">
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
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
</body>
</html>