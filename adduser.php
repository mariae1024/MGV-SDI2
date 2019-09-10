<?php

require_once('connect.php');

if(isset($_POST) & !empty($_POST)){
	$fname = $_POST['first_name'];
	$lname = $_POST['last_name'];
	$email = $_POST['email'];
    $pnumber = $_POST['phone_number'];
    $address = $_POST['address'];
    $dob = $_POST['dob'];
    $pass = $_POST['password'];
    $role = $_POST['role'];
    $status = $_POST['status'];
	$UpdateSql = "INSERT INTO users (first_name,last_name,email,phone_number,address,dob,password,role,status) 
         VALUES ('$fname','$lname', '$email', '$pnumber', '$address','$dob','$pass','$role','$status')";
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
		<h2>ADD user</h2>
			<div class="form-row">
            <div class="form-group col-md-12">
			    <label for="inputFirstName" >First Name</label>
			    
			      <input type="text" name="first_name"  class="form-control" id="input7" pattern="[A-Za-z ]{1,20}" placeholder="Insert First name" required/>
			    
			</div>
            </div>

			<div class="form-row">
            <div class="form-group col-md-12">
			    <label for="input1" >Last Name</label>
			    
			      <input type="text" name="last_name"  class="form-control" id="input7" pattern="[A-Za-z ]{1,20}" placeholder="Insert Last name" required/>
			    
			</div>
            </div>
			
			<div class="form-row">
						  <div class="form-group col-md-12">
								<label for="inputEmail"><b>Email</b></label>
								<input type="email" name="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="example@example.com" required="email">
							</div>
						</div>
						
			<div class="form-row">
						  <div class="form-group col-md-12">
								<label for="inputphone"><b>Phone number</b></label>
								<input type="number" name="phone_number" pattern='[\+]\d{2}[\(]\d{2}[\)]\d{4}[\-]\d{4}' class="form-control" placeholder="Insert phone number" required="phone number">
							</div>
						</div>
			
			
			
			<div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="inputAddress"><b>Address</b></label>
                     <input type="text" id="address" name="address"  class="form-control" pattern="[a-zA-Z0-9 ]{2,50}"  placeholder="Insert address"  required>
                        
                    </div>
                </div>
                
                <div class="form-row">
                  <div class="form-group col-md-12">
                        <label for="date"><b>Date of Birth</b></label>
                        <input type="date" name="dob" class="form-control" placeholder="mm/dd/yyyy" required="date">  
                    </div>
                </div>
			<div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="inputPassword"><b>Password</b></label>
                     <input type="text" id="password" name="password"  class="form-control" pattern="(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"  placeholder="Insert password"  required>
                        
                    </div>
                </div>
                <div class="form-group">
                        <label for="inputRole" class="col-sm-2 control-label"><b>Role</b></label>
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
                        <label for="inputStatus" class="col-sm-2 control-label"><b>Status</b></label>
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