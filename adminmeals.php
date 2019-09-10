<?php
session_start();
if($_SESSION["is_auth"] == false){
    header("Location: landingpage.php");
}
require_once('connect.php');
$page = 1;
$ReadSql = "SELECT * FROM meals";
$res = mysqli_query($connection, $ReadSql);


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
   <a class="navbar-brand nav-link" href="landingpage.php">MGV</a> <!--connecting landing page to MGV button-->
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
                <a class="nav-link" href="adminreport.php">
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
                <a class="nav-link active" href="adminmeals.php">
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
        <!-- Modal -->
  <div class="modal fade" id="deletemeal" tabindex="-1" role="dialog" aria-labelledby="deletemeal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Confirm delete action</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Are you sure you want to delete this meal?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            
          
          <a href="#" class="btn btn-danger"  id="modalDelete" >Delete</a>  
          </div>
        </div>
      </div>
    </div>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Our Meals</h1>
        
</div>

            <nav>
					<div class="nav nav-tabs" id="nav-tab" role="tablist">
						<a class="nav-item nav-link active" data-toggle="tab" href="#nav-package1">Package 1</a>
						<a class="nav-item nav-link" data-toggle="tab" href="#nav-package2">Package 2</a>
						<a class="nav-item nav-link" data-toggle="tab" href="#nav-package3">Package 3</a>
						<a class="nav-item nav-link" data-toggle="tab" href="#nav-package4">Package 4</a>
					</div>
				</nav>
				<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
					<div class="tab-pane active" id="nav-package1" role="tabpanel" >
					
					
<div class="table-responsive">
<table class="table table-striped table-sm">
  
  <thead>
    <tr>
      
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Ingredients</th>
      <th scope="col">Image</th>
      <th scope="col">Price</th>
      <th scope="col">Status</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
           <?php 
		            while($r = mysqli_fetch_assoc($res)):
                    if( $r['package_id']==1){
      ?>
		            
		            	<tr> 
		            		 
		            		<td><?php echo $r['name']; ?></td> 
		            		<td><?php echo $r['description']; ?></td> 
		            		<td><?php echo $r['ingredients']; ?></td> 
		            		<td><?php echo $r['image']; ?></td>
                            <td><?php echo $r['price']; ?></td>
                            <td><?php echo $r['status']; ?></td>
                    <td>
                    <a href="updatemeal.php?id=<?php echo $r['id']; ?>"><button type="button" class="btn btn-primary">Edit</button></a>
                    
		            			<!--write the delete code yourself-->
                      
                      <button type="button" class="btn btn-danger trash" data-toggle="modal" data-id="<?php echo $r['id']; ?>" data-target="#deletemeal" > Delete</button></td>
                        <?php };
                       endwhile;
                            ?>
              </tbody>
                
                       
              
            </table> 
         
          </div>
					</div>
					<div class="tab-pane" id="nav-package2" role="tabpanel">
						<div class="table-responsive">
<table class="table table-striped table-sm">
  
  <thead>
    <tr>
      
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Ingredients</th>
      <th scope="col">Image</th>
      <th scope="col">Price</th>
      <th scope="col">Status</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
           <?php 
                    $ReadSql = "SELECT * FROM meals";
                    $res = mysqli_query($connection, $ReadSql);
		            while($r = mysqli_fetch_assoc($res)):
                    if( $r['package_id']==2){
      ?>
		            
		            	<tr> 
		            		 
		            		<td><?php echo $r['name']; ?></td> 
		            		<td><?php echo $r['description']; ?></td> 
		            		<td><?php echo $r['ingredients']; ?></td> 
		            		<td><?php echo $r['image']; ?></td>
                            <td><?php echo $r['price']; ?></td>
                            <td><?php echo $r['status']; ?></td>
                    <td>
                    <a href="updatemeal.php?id=<?php echo $r['id']; ?>"><button type="button" class="btn btn-primary">Edit</button></a>
                    
		            			<!--write the delete code yourself-->
                      
                      <button type="button" class="btn btn-danger trash" data-toggle="modal" data-id="<?php echo $r['id']; ?>" data-target="#deletemeal" > Delete</button></td>
                        <?php };
                       endwhile;
                            ?>
              </tbody>
                
                       
              
            </table> 
					</div>
                    </div>
					<div class="tab-pane" id="nav-package3" role="tabpanel">
						<div class="table-responsive">
<table class="table table-striped table-sm">
  
  <thead>
    <tr>
      
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Ingredients</th>
      <th scope="col">Image</th>
      <th scope="col">Price</th>
      <th scope="col">Status</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
           <?php 
                    $ReadSql = "SELECT * FROM meals";
                    $res = mysqli_query($connection, $ReadSql);
		            while($r = mysqli_fetch_assoc($res)):
                    if( $r['package_id']==3){
      ?>
		            
		            	<tr> 
		            		 
		            		<td><?php echo $r['name']; ?></td> 
		            		<td><?php echo $r['description']; ?></td> 
		            		<td><?php echo $r['ingredients']; ?></td> 
		            		<td><?php echo $r['image']; ?></td>
                            <td><?php echo $r['price']; ?></td>
                            <td><?php echo $r['status']; ?></td>
                    <td>
                    <a href="updatemeal.php?id=<?php echo $r['id']; ?>"><button type="button" class="btn btn-primary">Edit</button></a>
                    
		            			<!--write the delete code yourself-->
                      
                      <button type="button" class="btn btn-danger trash" data-toggle="modal" data-id="<?php echo $r['id']; ?>" data-target="#deletemeal" > Delete</button></td>
                        <?php };
                       endwhile;
                            ?>
              </tbody>
                
                       
              
            </table> 
					</div>
                    </div>
					
					<div class="tab-pane" id="nav-package4" role="tabpanel">
						<div class="table-responsive">
<table class="table table-striped table-sm">
  
  <thead>
    <tr>
      
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Ingredients</th>
      <th scope="col">Image</th>
      <th scope="col">Price</th>
      <th scope="col">Status</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
           <?php 
                    $ReadSql = "SELECT * FROM meals";
                    $res = mysqli_query($connection, $ReadSql);
		            while($r = mysqli_fetch_assoc($res)):
                    if( $r['package_id']==4){
      ?>
		            
		            	<tr> 
		            		 
		            		<td><?php echo $r['name']; ?></td> 
		            		<td><?php echo $r['description']; ?></td> 
		            		<td><?php echo $r['ingredients']; ?></td> 
		            		<td><?php echo $r['image']; ?></td>
                            <td><?php echo $r['price']; ?></td>
                            <td><?php echo $r['status']; ?></td>
                    <td>
                    <a href="updatemeal.php?id=<?php echo $r['id']; ?>"><button type="button" class="btn btn-primary">Edit</button></a>
                    
		            			<!--write the delete code yourself-->
                      
                      <button type="button" class="btn btn-danger trash" data-toggle="modal" data-id="<?php echo $r['id']; ?>" data-target="#deletemeal" > Delete</button></td>
                        <?php };
                       endwhile;
                            ?>
              </tbody>
                
                       
              
            </table> 
					</div>
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
<script>
    $('.trash').click(function(){
    var id=$(this).data('id');
    $('#modalDelete').attr('href',' deletemeal.php?id='+id);
      })
    </script>
   

  </body>
</html>
