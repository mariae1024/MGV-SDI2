<?php 

require_once('connect.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
/* Include the Composer generated autoload.php file */
require 'C:\xampp\composer\vendor\autoload.php';

$id = $_GET['id'];
$SelSql = "SELECT * FROM supplier3 WHERE id=$id";
$res = mysqli_query($connection, $SelSql);
$r = mysqli_fetch_assoc($res);
    
$name = $r['name'];
$comment = $_POST['comment'];
$role="supplier3";
$ReadSql1 = "SELECT * FROM users WHERE role='$role'";
$res1 = mysqli_query($connection, $ReadSql1);
$r1 = mysqli_fetch_assoc($res1);
$email = $r1['email'];
//sendBookingRequest($name,$comment,$email);

  
        sendRequest($name,$comment,$email);
        header('Location: adminnewmenu.php');
    


//$connection->close();



function sendRequest($name,$comment,$email){
     /* Create a new PHPMailer object. Passing TRUE to the constructor enables exceptions */
                $mail= new PHPMailer(TRUE);

                /* Open the try/catch block. */
                try{
                    /* Set the mail sender. */
                    $mail->setFrom('mm.gdit.ip@gmail.com','Maria GDIT Support');
                    /*echo "Hmm<br><br>"; /* just a debug trace statement */

                    /* Add a recipient. */
                    $mail->addAddress($email);
                    
                    /* Set the subject */
                    $mail->Subject = "Rental request";
                    
                    /* Set the mail message body. */
                    $mail->Body = 'Hi,\r\n\r\n Thank you for place a new meal with name ' . $name . '.This email in to inform that your meal is been rejected and the comments that I have about it are: ' . $comment .'';
                    
                     /* SMTP parameters. */
                    $mail->isSMTP();

                    /*SMTP server address */
                    $mail->Host = 'smtp.gmail.com';

                    /* Use SMTP authentication. */
                    $mail->SMTPAuth = TRUE;

                    /* Set the encryption system */
                    $mail->SMTPSecure = 'tls';

                    /*SMTP authentication username. */
                    $mail->Username = 'mm.gdit.ip@gmail.com';

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