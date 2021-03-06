<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
?>

<?php  include "include/db.php"; ?>
<?php  include "include/header.php"; ?>
<?php include'admin/functions.php' ?>

<?php
 
    require './vendor/autoload.php';
    require 'classes/Config.php';

    if(ifItIsMethod('post') ){
        
       if(isset($_POST['email'])){
           $email = $_POST['email'];
           $length = 50;
           $token = bin2hex(openssl_random_pseudo_bytes($length));
           
            if(email_exists($email)){
             if($stmt = mysqli_prepare($connection, "UPDATE users SET token='{$token}' WHERE user_email= ?")){
                 
                 
                   mysqli_stmt_bind_param($stmt,"s",$email);
                   mysqli_stmt_execute($stmt);
                   mysqli_stmt_close($stmt);
                 
                 $mail = new PHPMailer(true);

try {
    
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = Config::SMTP_HOST;                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = Config::SMTP_USER;                     //SMTP username
    $mail->Password   = Config::SMTP_PASSWORD;                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = Config::SMTP_PORT;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    $mail->CharSet    = 'UTF-8';

    //Recipients
    $mail->setFrom('yassermagdy636@gmail.com', 'yasser');
    $mail->addAddress($email);     //Add a recipient
    $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');

  
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    =  '<p>Please Click to reset your password 
    
    <a href="http://localhost:8080/cms/reset.php?email='.$email.'&token='.$token.'">https://localhost:8080/cms/reset.php?email=' . $email.'&token='.$token.'</a>
    
    
                     </p>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

   if( $mail->send()){
       $emailsent = true;
   }
    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
  }
     }
        }
           }

?>
<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                                <?php if(!isset($$emailsent)): ?>

                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">




                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->
                                  
                                   <?php else: ?>
                                   
                                   <h2>Please check your email</h2>


                            <?php endIf; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "include/footer.php";?>

</div> <!-- /.container -->

