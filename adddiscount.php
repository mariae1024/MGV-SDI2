<?php

require_once('connect.php');

if(isset($_POST) & !empty($_POST)){
	$disccode = $_POST['disc_code'];
    $percentage = $_POST['percentage'];
	$Sql = "INSERT INTO discount (disc_code,percentage) 
         VALUES ('$disccode', '$percentage')";
	$res = mysqli_query($connection, $Sql);
	if($res){
		header('Location: admindiscount.php');
	}else{
        $fmsg = "Failed to update data." . mysqli_error($connection);
        echo $fmsg;
	}
}
?>


<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>MGV - Online meal ordering</title>
    
    <!--<link href="login.css" rel="stylesheet">
    <style>
    .error {color: #FF0000;}
    </style>-->
    
</head>
<body>
    
   
  
   
<div class="container">
        <div class="row mt-5 mb-5 justify-content-center">
            <div class="col-md-6 mt-3" >
            <form method="POST" class="form-horizontal col-md-6 col-md-offset-3">
                <h1 class="h3 font-weight-normal">Please fill the values to create discount</h1>
                
                <div class="form-row">
                  <div class="form-group col-md-12">
                        <label for="inputdisccode"><b>Dicount code</b></label>
                        <input type="text" name="disc_code" class="form-control" placeholder="Discount code" required>
                        
                        
                    </div>
                </div>
                                
                 <div class="form-row">
                  <div class="form-group col-md-12">
                        <label for="inputpercentage"><b>Percentage</b></label>
                        <input type="number" name="percentage" class="form-control" placeholder="Percentage" pattern="[0-9]{1-15}" required>
                        
                        
                    </div>
                </div>
                
              <div class="form-row">
                    <div class="form-group">
                        <button class="btn btn-primary btn-lg ml-2" type="submit">Add discount</button>

                        <button type="reset" class="btn btn-danger btn-lg" >Reset</button>
                    </div>
                </div>
        
    </form>
    
                      </div>
                  </div>
</div>
   
   

    

     

      
      
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body> 
</html>