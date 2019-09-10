<?php
require_once('connect.php');
$id = $_GET['id'];
$SelSql = "SELECT * FROM users WHERE id=$id";
$res = mysqli_query($connection, $SelSql);
$r = mysqli_fetch_assoc($res);
if(isset($_POST) & !empty($_POST)){
	$fname = $_POST['first_name'];
	$lname = $_POST['last_name'];
	$phone = $_POST['phone_number'];
	$address = $_POST['address'];
    $role = $_POST['role'];
    $status = $_POST['status'];
	$UpdateSql = "UPDATE users SET first_name='$fname', last_name='$lname', dob='$dob', phone_number='$phone', address='$address', role='$role', status='$status' WHERE id=$id";
	$res = mysqli_query($connection, $UpdateSql);
	if($res){
		header('Location: adminstaffusers.php');
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
    <div class="container">
    <div class="row">
    <div class="col">
    
		<form method="POST" class="form-horizontal col-md-6 col-md-offset-3">
		<h2>Edit User</h2>
			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">First name</label>
			    <div class="col-sm-10">
			      <input type="text" name="first_name"  class="form-control" id="input7" value="<?php echo $r['first_name']; ?>" placeholder="Enter user's first name" required/>
			    </div>
			</div>

			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">Last name</label>
			    <div class="col-sm-10">
			      <input type="text" name="last_name"  class="form-control" id="input2" value="<?php echo $r['last_name']; ?>" placeholder="Enter user's Last name" required/>
			    </div>
			</div>

			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">Email</label>
			    <div class="col-sm-10">
			      <input type="email" name="email"  class="form-control" id="input3" value="<?php echo $r['email']; ?>" placeholder="Enter your email" disabled />
			    </div>
			</div>
			
			
			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">Date of Birth</label>
			    <div class="col-sm-10">
			      <input type="date" name="dob"  class="form-control" id="input3" value="<?php echo $r['dob']; ?>" placeholder="mm/dd/yyyy" disabled required/>
			    </div>
			</div>
			
			
			
			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">Phone</label>
			    <div class="col-sm-10">
			      <input type="number" name="phone_number"  class="form-control" id="input3" value="<?php echo $r['phone_number']; ?>" placeholder="Enter Phone number" required/>
			    </div>
			</div>
			
			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">Address</label>
			    <div class="col-sm-10">
			      <input type="text" name="address"  class="form-control" id="input2" value="<?php echo $r['address']; ?>" placeholder="Enter user's Address" required/>
			    </div>
			</div>
			
			
			
			
			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">Role</label>
			    <div class="col-sm-10">
		      	<select name="role">
		      	<option value="admin">admin</option>
		      	<option value="customer">customer</option>
		      	<option value="supplier1">supplier1</option>
		      	<option value="supplier2">supplier2</option>
		      	<option value="supplier3">supplier3</option>
		      	<option value="supplier4">supplier4</option>
		      	<option value="delivery">delivery</option>
		      
			      
					</select>
			    </div>
			</div>
			
			
			
			
			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">Status</label>
			    <div class="col-sm-10">
		      	<select name="status">
		      	<option value="Available">Available</option>
		      	<option value="Unavailable">Unavailable</option>
			      
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