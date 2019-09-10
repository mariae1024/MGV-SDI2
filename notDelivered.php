<?php
include 'connect.php';
$error=''; //Variable to Store error message;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
/* Include the Composer generated autoload.php file */
require 'C:\xampp\composer\vendor\autoload.php';
$id = $_GET['id'];
$SelSql = "SELECT * FROM orders WHERE id=$id";
$res = mysqli_query($connection, $SelSql);
$r = mysqli_fetch_assoc($res);
    $email = $r['email'];
    $fname = $r['first_name'];
    $lname = $r['last_name'];
	$comments = $_POST['comment'];
    
	$UpdateSql = "UPDATE orders SET status_delivery='Not Delivered',comments='$comments' WHERE id=$id";
       sendAcceptReject($email,$fname,$lname);
	$res = mysqli_query($connection, $UpdateSql);
	if($res){
		header('Location: ordersDeliveryPerson.php');
	}else{
        $fmsg = "Failed to update data." . mysqli_error($connection);
        echo $fmsg;
	}





function sendAcceptReject($email,$fname,$lname){
     /* Create a new PHPMailer object. Passing TRUE to the constructor enables exceptions */
                $mail= new PHPMailer(TRUE);

                /* Open the try/catch block. */
                try{
                    /* Set the mail sender. */
                    $mail->setFrom('gary.gdit@gmail.com','Gurinder GDIT Support');
                    /*echo "Hmm<br><br>"; /* just a debug trace statement */

                    /* Add a recipient. */
                    $mail->addAddress($email);
                    
                    /* Set the subject */
                    $mail->Subject = "Order Confirmation";
                    
                    /* Set the mail message body. */
                    $mail->Body = 'Hi, ' . $fname . ' ' . $lname .    "\r\n\r\nThankyou for ordering from MGV. Unfortunately, Unfortunately at this time we cannot deliver your order. \r\n\r\n Thankyou \r\n Team MGV";
                    
                     /* SMTP parameters. */
                    $mail->isSMTP();

                    /*SMTP server address */
                    $mail->Host = 'smtp.gmail.com';

                    /* Use SMTP authentication. */
                    $mail->SMTPAuth = TRUE;

                    /* Set the encryption system */
                    $mail->SMTPSecure = 'tls';

                    /*SMTP authentication username. */
                    $mail->Username = 'gary.gdit@gmail.com';

                    /*SMTP authentication password */
                    $mail->Password = 'Mailer@123';

                    /*Set the SMTP port */
                    $mail->Port = 587;

                    /* Finally send the email */
                    $mail->send();
                    /*echo "<b>Mail sent sucessfully<b><br><br>";/* just a debug trace statement */ 
                }
                catch (Exception $e){
                    /* PHPMailer exception*/
                    echo "First catch<br>";
                    echo $e->errorMessage();
                }
                catch (\Exception $e){
                    /* PHP exception (note the backslash to select the global namespace Exception class)*/
                    echo "Second catch<br>";
                    echo $e->getMessage();
                }

}

		


?>