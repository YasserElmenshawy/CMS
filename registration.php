<?php  include "include/db.php"; ?>
<?php  include "include/header.php"; ?>
<?php

if(isset($_POST['submit'])){
    
    
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = $_POST['password'];

    
    
    if(!empty($username) && !empty($email) &&  !empty($password)){
    
    $usrname  = mysqli_real_escape_string($connection,$username);
    $email    = mysqli_real_escape_string($connection,$email);
    $password = mysqli_real_escape_string($connection,$password);
    
     $password = password_hash($password, PASSWORD_BCRYPT, array(['cost' => 12]));   
    
    $query = "INSERT INTO users (user_name,user_email,user_password,user_role ) ";
    $query .= "VALUE ('{$username}' , '{$email}' , '{$password}' , 'subcruiber')";
    $registration_user_query = mysqli_query($connection, $query);
    
    if(!$registration_user_query){
        die("Query failed" . mysqli_error($connection));
    }
        $massage = "YOUR Registration Success";
    
    }else{
        
        $massage = "Field cannot be empty";
        }
    
        }else{
    
        $massage = " ";
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
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                       <h6 class='text-center'><?php echo $massage; ?></h6>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "include/footer.php";?>
