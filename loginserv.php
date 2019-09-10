<?php
session_start();

$post_data = http_build_query(
    array(
        'secret' => '',
        'response' => $_POST['g-recaptcha-response'],
        'remoteip' => $_SERVER['REMOTE_ADDR']
    )
);
$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => $post_data
    )
);
$context  = stream_context_create($opts);
$response = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
$result = json_decode($response);
if (!$result->success || empty($result->success)) {
    echo '<script type="text/javascript">
         alert("Please check Rechaptcha"); 
         window.location.href ="login.php";
         </script>';
}else{




$error=''; //Variable to Store error message;
    if(empty($_POST['email']) || empty($_POST['password'])){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
           //header("Location: login.php");
            //echo $error = "Email or Password is Invalid or empty";
            //$emailErr="This is an invalid email format";
            echo '<script type="text/javascript">
         alert("Email or Password is Invalid or empty"); 
         window.location.href ="login.php";
         </script>';
            
        }
        
        // complete this error check yourself
    }
    else
    {
        //Define $user and $pass
        $user=$_POST['email'];
        $pass=$_POST['password'];
        //Establishing Connection with server by passing server_name, user_id and pass as a parameter
        $conn = mysqli_connect("localhost", "root", "");
        //Selecting Database
        $db = mysqli_select_db($conn, "mgv");
        //sql query to fetch information of registered user and find user match.
        $query = mysqli_query($conn, "SELECT * FROM users WHERE password='$pass' AND email='$user'");
        $rows = mysqli_num_rows($query);
        
    if($rows == 1){
        $row = mysqli_fetch_assoc($query);
        $_SESSION['role'] = $row['role'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['id'] = $row['id'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['first_name'] = $row['first_name'];
        $_SESSION['last_name'] = $row['last_name'];
        $_SESSION['phone_number'] = $row['phone_number'];
        $_SESSION['status'] = $row['status'];
        $_SESSION['address'] = $row['address'];
        $_SESSION['dob'] = $row['dob'];
        
    
        $_SESSION["is_auth"] = true;
        
        // header("Location: landingpage.php"); // Redirecting to other page
        if($_SESSION['role'] == 'admin'){
           header("Location: adminstaffusers.php"); 
        }else if($_SESSION['role']=='supplier1' || $_SESSION['role']=='supplier2'|| $_SESSION['role']=='supplier3' || $_SESSION['role']=='supplier4'){
            header("Location: newmenusuppliers.php");
        }else if ($_SESSION['role']=='delivery'){

            header("Location: allordersdelivery.php");
        }
        else{
            header("Location: landingpage.php"); // Redirecting to other page
        }
         
    }
        
    else
    {
     
         echo '<script type="text/javascript">
         alert("Unknown account or password, please try again"); 
         window.location.href ="login.php";
         </script>';
       
    }
    }
}

?>