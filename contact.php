<?php  include "include/db.php"; ?>
<?php  include "include/header.php"; ?>
<?php

if(isset($_POST['submt'])){
    $to      = "yassermagdy430gmail.com";
    $subject = wordwrap($_POST['subject']);
    $body    = $_POST['body'];
    $header    ="From:" . $_POST['email'];

    mail($to, $subject, $body, $header );
    
}
?>
    <!-- Navigation -->
    
    <?php  include "include/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact</h1>
                    <form role="form"  method="post" id="login-form" autocomplete="off">
                       
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                        
                         <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter your Subject">
                        </div>
                        
                         <div class="form-group">
                            <textarea class="form-group" name="body" id="body" cols="75" rows="10"></textarea>
                        </div>
                
                        <input type="submit" name="submt" id="btn-login" class="btn btn-custom btn-lg btn-block" value="submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "include/footer.php";?>
