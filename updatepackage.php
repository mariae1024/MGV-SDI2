<?php

require_once('connect.php');
$id = $_GET['id'];
$SelSql = "SELECT * FROM packages WHERE id=$id";
$res = mysqli_query($connection, $SelSql);
$r = mysqli_fetch_assoc($res);
if(isset($_POST) & !empty($_POST)){
	$name = $_POST['name'];
	$image = $_POST['image'];
    $price = $_POST['price'];
    $status = $_POST['status'];
	$UpdateSql = "UPDATE packages SET name='$name', image='$image', price='$price', status='$status' WHERE id=$id";
	$res = mysqli_query($connection, $UpdateSql);
	if($res){
		header('Location: adminpackages.php');
	}else{
        $fmsg = "Failed to update data." . mysqli_error($connection);
        echo $fmsg;
	}
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
    <title>MGV - Online meal ordering</title>
</head>
<body>
<body>
    <div class="container">
    <div class="row">
    <div class="col">
    
		<form method="POST" class="form-horizontal col-md-6 col-md-offset-3">
		<h2>UPDATE Package</h2>
		    <div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">ID</label>
			    <div class="col-sm-10">
			      <input type="text" name="id"  class="form-control" id="input7" value="<?php echo $r['id']; ?>" disabled />
			    </div>
			</div>
		
			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">Name</label>
			    <div class="col-sm-10">
			      <input type="text" name="name"  class="form-control" id="input7" value="<?php echo $r['name']; ?>" pattern="[A-Za-z ]{1,50}" placeholder="Insert name" required />
			    </div>
			</div>

			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">Image</label>
			    <div class="col-sm-10">
			      <input type="text" name="image"  class="form-control" id="input3" value="<?php echo $r['image']; ?>" placeholder="Insert name of file of image" required/>
			    </div>
			</div>
			
			
			
			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">Price</label>
			    <div class="col-sm-10">
			      <input type="number" name="price"  class="form-control" id="input3" value="<?php echo $r['price']; ?>" pattern="[0-9]{1,15}" placeholder="Insert price" required />
			    </div>
			</div>
			
			
                  <div class="form-group">
                        <label for="inputRole" class="col-sm-2 control-label"><b>Status</b></label>
                         <div class="col-sm-10">
                          <select name="status">
                            <option value="available">Available</option>  
                            <option value="unavailable">Unavailable</option>
                            
                        </select>
                      </div>
                        
                        
                        
                    </div>
                
			
			<input type="submit" class="btn btn-primary col-md-2 col-md-offset-10" value="submit" />
		</form>
    </div>
    </div>
    </div>





<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
</body>
</html>