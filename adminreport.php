<?php
session_start();
if($_SESSION["is_auth"] == false){
    header("Location: landingpage.php");
}
require_once('connect.php');
$ReadSql = "SELECT package_id, SUM(total_price) FROM orders group by package_id";
$res = mysqli_query($connection, $ReadSql);
$chart_data = "";



?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>MGV - Online meal ordering</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


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

       <div class="container-fluid mt-5">
      <div class="row">
           <nav class="col-md-2 d-none d-md-block bg-light sidebar nav-pills mt-3">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="adminreport.php">
                  <span class="fa fa-fw fa-bar-chart"></span><!-- fa-fw ensure proper alignment of the icons-->
                  Reports
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="adminstaffusers.php">
                  <span class="fa fa-fw fa-users"></span><!-- fa-fw ensure proper alignment of the icons-->
                  Admin/Staff/Users
                </a>
              </li>
              
              <li class="nav-item">
                <a class="nav-link" href="adminpackages.php">
                  <span class="fa fa-fw fa-shopping-cart"></span>
                  Packages
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="adminmeals.php">
                  <span class="fa fa-fw fa-cutlery"></span>
                  Meals
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="adminnewmenu.php">
                  <span class="fa fa-fw fa-lightbulb-o"></span>
                  New Menu
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="adminorders.php">
                  <span class="fa fa-fw fa-file"></span>
                  Orders
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="feedback.php">
                  <span class="fa fa-fw fa-inbox"></span>
                  Feedback
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="admindiscount.php">
                  <span class="fa fa-percent"></span>
                  Discount
                </a>
              </li>
              
            </ul>

            
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
       
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Report</h1>
       
        
</div>
         <?php while ($row = mysqli_fetch_array($res)) { 
 
            $packageid[]  = $row['package_id']  ;
            $sales[] = $row['SUM(total_price)'];
        } ?>
                  
                  
                  <div style="width:60%;hieght:20%;text-align:center">
            <h2 class="page-header" > Reports </h2>
           
            <canvas  id="chartjs_bar"></canvas> 
    
            <div class="row">
             <h6> Package 1 - Korean Cuisine :  </h6>
             <img src="Package1.png" style="width:30px;height:15px">
            </div>
           
            <div class="row">
             <h6> Package 2 - Spanish Cuisine :   </h6>
             <img src="Package2.png" style="width:30px;height:15px">
            </div>
          
            <div class="row">
             <h6> Package 3 - Indian Cuisine :   </h6>
             <img src="Package3.png" style="width:30px;height:15px">
            </div>
        
            <div class="row">
             <h6> Package 4 - Colombian Cuisine   :   </h6>
             <img src="Package4.png" style="width:30px;height:15px">    
            </div>
            
                
            </div>
        
          </main>
            </div>
      </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


  </body>
  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script type="text/javascript">
      var ctx = document.getElementById("chartjs_bar").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels:<?php echo json_encode($packageid); ?>,
                        datasets: [{
                            label: "Packages",
                            backgroundColor: [
                               "#5969ff",
                               "#25d5f2",
                                "#ffc750",
                                "#2ec551",
                               
                            ],
                          data:<?php echo json_encode($sales); ?>,
                          
                        }]
                    },
                    options: {
                           legend: {
                                        
                        display: true,
                        position: 'bottom',
 
                        labels: {
                            labeltext: 'Packages',
                            fontColor: '#71748d',
                            fontFamily: 'Circular Std Book',
                            fontSize: 14
                        }
                    },
 
 
                }
                });
    </script>
</html>
