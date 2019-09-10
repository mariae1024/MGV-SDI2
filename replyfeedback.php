<?php 

require_once('connect.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
/* Include the Composer generated autoload.php file */
require 'C:\xampp\composer\vendor\autoload.php';

$id = $_GET['id'];
$SelSql = "SELECT * FROM feedback WHERE id=$id";
$res = mysqli_query($connection, $SelSql);
$r = mysqli_fetch_assoc($res);
    
    $fname = $r['first_name'];
    $lname = $r['last_name'];
    $email = $r['email'];
    $feedback = $r['feedback'];
    
    
    $comment = $_POST['comment'];
	

$role="admin";
$ReadSql1 = "SELECT * FROM users WHERE role='$role'";
$res1 = mysqli_query($connection, $ReadSql1);
$r1 = mysqli_fetch_assoc($res1);
$email = $r1['email'];
//sendBookingRequest($name,$comment,$email);
if(mysqli_query($connection,$SelSql))
    {
        echo "Comment sent sucessfully";
        sendRequest($name,$comment,$email);
        $sql1 = "DELETE FROM supplier2 WHERE Id=$id";
if ($connection->query($sql1) === TRUE) {
    echo "Record deleted successfully";
    header('Location: feedback.php');
} else {
    echo "Error deleting record: " . mysqli_error($connection);
}
}

    

//$connection->close();



function sendRequest($name,$comment,$email){
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
                    $mail->Subject = "Rental request";
                    
                    /* Set the mail message body. */
                    $mail->Body = 'Hi' . "\r\n\nThank you for the feedback, My comments about your feedback are: " . $comment . '' . "\r\n\r\n Warm Regards, \r\n Team MGV";
                    
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