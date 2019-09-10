<?php
session_start();
require_once('connect.php');


$del_id = $_SESSION['id'];
$ReadSql = "SELECT * FROM orders WHERE delivery_id = $del_id";
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
                <a class="nav-link" href="allordersdeliveryperson.php">
                  <span class="fa fa-fw fa-file"></span>
                  All Orders
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="ordersDeliveryPerson.php">
                  <span class="fa fa-fw fa-shopping-cart"></span>
                  Orders
                </a>
              </li>
                           
            </ul>

            
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <!-- Modal -->
  <div class="modal fade" id="deletebooking" tabindex="-1" role="dialog" aria-labelledby="deleteBooking" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Confirm delete action</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Are you sure you want to delete this order?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            
          
          <a href="ordersDeliveryPerson.php" class="btn btn-danger"  id="modalDelete" >Delete</a>  
          </div>
        </div>
      </div>
    </div>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Orders to do</h1>
        
</div>
<div class="container">
<div class="table-responsive">
<table class="table table-striped table-sm">
  
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Fname</th>
      <th scope="col">Phone</th>
      <th scope="col">Address</th>
      <th scope="col">Status</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
           <?php 
		            while($r = mysqli_fetch_assoc($res)):?>
		            	<tr> 
		            		<td><?php echo $r['id']; ?></td> 
		            		<td><?php echo $r['first_name']; ?></td> 		    
                            <td><?php echo $r['phone']; ?></td>
                            <td><?php echo $r['address']; ?></td>
                            <td><?php echo $r['status_delivery']; ?></td>
                            
                            
                            
                    <td>
                    
                           
                                <?php $status = $r['status_delivery'];
									if($status == "Delivering"){ ?>
                                <a href="delivered.php?id=<?php echo $r['id']; ?>"><button type="button" class="btn btn- btn-success" >Delivered</button></a>
                                
                                <button type="button" class="btn btn btn-warning" data-toggle="modal" data-target="#notdelivered<?php echo $r['id'];?>">Not Delivered</button><!--NOT DELIVERED-->
                                
                                
                                <?php }else if($status == "Delivered"){ ?>
                               <a href="delivered.php?id=<?php echo $r['id']; ?>"><button type="button" class="btn btn- btn-secondary"  disabled>Delivered</button></a>
                               
                                <button type="button" class="btn btn btn-secondary" data-toggle="modal" data-target="#notdelivered<?php echo $r['id'];?>" disabled>Not Delivered</button><!--NOT DELIVERED-->
                                 
                                <?php }else{ ?>
                                <a href="delivered.php?id=<?php echo $r['id']; ?>"><button type="button" class="btn btn- btn-success">Delivered</button></a>
                                
                                <button type="button" class="btn btn btn-secondary" data-toggle="modal" data-target="#notdelivered<?php echo $r['id'];?>" disabled>Not Delivered</button>  <!--NOT DELIVERED-->
                                
                                <?php } ?>
					</td>
                   
                    <div class="modal fade" id="notdelivered<?php echo $r['id'];?>" tabindex="-1" role="dialog" aria-labelledby="accept" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Send Comment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              
			  
           <form method="POST" class="form-horizontal" action="notDelivered.php?id=<?php  echo $r['id']; ?>"  onclick ="Compare()">
            <textarea class="form-control mb-3" val="" rows="3" type="textarea" name="comment"  required="text"></textarea>
             <input type="submit" class="btn btn-success col-md-2 col-md-offset-10" value="submit" name="accept" />
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			
			  </form> 
		
          </div>
        </div>
      </div>
    </div>
                    
               
	  </tr>
                        <?php endwhile; ?>  
              </tbody>
                
                                        
              
            </table>
               
                  
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
    $('#modalDelete').attr('href',' deleteOrder.php?id='+id);
      })
    </script>
    

  </body>
</html>
