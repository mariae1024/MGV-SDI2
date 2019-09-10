<?php
    session_start();

    require_once('connect.php');


    if (isset($_POST) & !empty($_POST)) { 
		
		
           $id = $_POST['id'];
    $ReadSql = "SELECT * FROM users WHERE id=$id";
    $res = mysqli_query($connection, $ReadSql);
    $r = mysqli_fetch_assoc($res);
		
		
        $newpass = $_POST['npassword'];
        $oldpass = $_POST['opassword'];
        $oldpass_database = $r['password'];
        if($oldpass == $oldpass_database){
            $UpdateSql = "UPDATE users SET password='$newpass' WHERE id=$id";
            $res = mysqli_query($connection, $UpdateSql);
            if($res){
				echo '<script type="text/javascript">
         alert("Password Successfully Changed."); 
         window.location.href ="Profile.php?id='. $id .'";
         </script>';
                //header('Location: profile.php?id='. $id .'');
            }else{
                $fmsg = "Failed to update data." . mysqli_error($connection);
                echo $fmsg;
                }  
        }else{
            echo '<script type="text/javascript">
         alert("Old password doesnt match, please try again"); 
         window.location.href ="changePass.php?id='. $id .'";
         </script>';
        }
    }
    ?>