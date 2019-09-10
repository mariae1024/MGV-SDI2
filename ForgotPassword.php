
<?php
session_start();
include('connect.php');
$error=''; //Variable to Store error message;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
/* Include the Composer generated autoload.php file */
require 'C:\xampp\composer\vendor\autoload.php';


function sendPasswordRecoveryEmail($email,$fname,$lname,$password){
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
                    $mail->Subject = "Password recovery";
                    
                    /* Set the mail message body. */
                    $mail->Body = 'Hi, ' . $fname . ' ' . $lname . "\r\n\r\nYour email to login is "  . $email . ' and your password is ' . $password . "\r\n\r\n Warm Regards, \r\n Team MGV";
                    
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
if(isset($_POST['email']))
{
	if(!empty($_POST['email']))
	{
		$email = $_POST['email'];

		$query = 'select * from users where email="'.$email.'"';
		$result = mysqli_query($connection,$query);
        

		if($r = mysqli_fetch_assoc($result))
		{
            $fname = $r['first_name'];
            $lname = $r['last_name'];
            $password = $r['password'];
			sendPasswordRecoveryEmail($email,$fname,$lname,$password);
            echo '<h3 class="mt-5" style="color:green;"> Your password has been sent to your email!</h3>';
        }
        else {
			echo '<script type="text/javascript">
					window.onload = function () { alert("Account not found please signup now!!"); }
					</script>';
		}
    }
      
}
?>