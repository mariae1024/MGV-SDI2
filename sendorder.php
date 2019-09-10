<?php 
require_once('connect.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
/* Include the Composer generated autoload.php file */
require 'C:\xampp\composer\vendor\autoload.php';


if(isset($_POST['orders'])){
    $ccnumber=$_POST['creditcard'];
    if(!isset($_POST['inlineRadioOptions1'])){
        echo '<script type="text/javascript">
         alert("Select payment method"); 
         window.location.href ="payment.php";
         </script>';
    }else if(!isset($_POST['inlineRadioOptions'])){
        echo '<script type="text/javascript">
         alert("Select type of card"); 
         window.location.href ="payment.php";
         </script>';
    }else if(!isset($_POST['TandC'])){
        echo '<script type="text/javascript">
         alert("Check Terms and conditions"); 
         window.location.href ="payment.php";
         </script>';
    }else if(strlen(strval($ccnumber))<16 || strlen(strval($ccnumber))>16){
        echo '<script type="text/javascript">
         alert("Invalid credit card number, it must have 16 characters"); 
         window.location.href ="payment.php";
         </script>';
    }
    else{
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $userid = $_POST['userId'];
    $packageid=$_POST['packageId'];
    $address=$_POST['address'];
    $discount = $_POST['discount_percentaje'];
    $price = $_POST['price'];
    $tprice = $_POST['total_price'];
    $order_comment = $_POST['order_comment'];
    $sql = "INSERT INTO orders (first_name, last_name, email, phone,user_id,package_id,address,discount,price,total_price,status_supplier,status_delivery,order_comment) VALUES ('$fname','$lname','$email','$phone','$userid','$packageid','$address','$discount','$price','$tprice','Pending','Delivering','$order_comment')";
    if(mysqli_query($connection,$sql))
    {
        echo "Database was updated";
        sendBookingRequest($email,$fname,$lname);
        echo '<script type="text/javascript">
         alert("Your payment have been completed"); 
         window.location.href ="landingpage.php";
         </script>';
        //header('Location: landingpage.php');
    }
    else
    {
        echo mysqli_error($connection);
    }
}
}
function sendBookingRequest($email,$fname,$lname){
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
                    $mail->Body = 'Hi, ' . $fname . ' ' . $lname .'\r\n\r\n Thank you for choosing our company. Your meal is going to arrive soon during the week.';
                    
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