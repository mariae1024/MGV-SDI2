<?php

require_once('connect.php');
$id = $_GET['id'];
$SelSql = "SELECT * FROM supplier4 WHERE id=$id";
$res = mysqli_query($connection, $SelSql);
$r = mysqli_fetch_assoc($res);
if(isset($_POST) & !empty($_POST)){
	$name = $_POST['name'];
    $description = $_POST['description'];
    $ingredients = $_POST['ingredients'];
    $image = $_POST['image'];
    $price = $_POST['price'];
	$UpdateSql = "UPDATE supplier4 SET name='$name', description = '$description',ingredients ='$ingredients',image ='$image', price = '$price' WHERE id=$id";
	$res = mysqli_query($connection, $UpdateSql);
	if($res){
		header('Location: newmenusuppliers.php');
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
		<h2>UPDATE meal</h2>
			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">Name</label>
			    <div class="col-sm-10">
			      <input type="text" name="name"  class="form-control" pattern="[A-Za-z ]{1,15}"  value="<?php echo $r['name']; ?>" placeholder="Insert name" required/>
			    </div>
			</div>

			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">Description</label>
			    <div class="col-sm-10">
			      <input type="text" name="description"  class="form-control" pattern="[A-Za-z ]{1,100}" value="<?php echo $r['description']; ?>" placeholder="Insert description" required />
			    </div>
			</div>
			
			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">Ingredients</label>
			    <div class="col-sm-10">
			      <input type="text" name="ingredients"  class="form-control" pattern="[A-Za-z ]{1,100}" value="<?php echo $r['ingredients']; ?>" placeholder="Insert ingredients" required/>
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
			      <input type="number" name="price"  class="form-control" pattern="[0-9 ]{1,10}" value="<?php echo $r['price']; ?>" placeholder="Insert price" required/>
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