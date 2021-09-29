<?php  include "include/db.php"; ?>
<?php  include "include/header.php"; ?>
<?php include'admin/functions.php' ?>
<?php session_start(); ?>
<?php
    if(isset($_POST['login'])){
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $username = mysqli_real_escape_string($connection,$username);
        $password = mysqli_real_escape_string($connection,$password);
 
        $query = "SELECT * FROM users WHERE user_name = '{$username}'";
        
        $select_user_query = mysqli_query($connection, $query);

        if(!$select_user_query){
            die ("Query failed" . mysqli_error($connection));
        }
        
        
        while($row = mysqli_fetch_array($select_user_query)){
            $dp_user_id = $row['user_id']; 
            $dp_user_name = $row['user_name']; 
            $dp_user_password = $row['user_password']; 
            $dp_user_firstname = $row['user_name']; 
            $dp_user_lastname = $row['user_name']; 
            $dp_user_role = $row['user_role']; 

        }
               
      if(password_verify($password,$dp_user_password) ){
            
            $_SESSION['username'] = $dp_user_name;
            $_SESSION['firstname'] = $dp_user_firstname;
            $_SESSION['lastname'] = $dp_user_lastname;
            $_SESSION['role'] = $dp_user_role;
            
            
            
            header("Location: admin ");

        }else{
                        header("Location: login.php ");

        }
        
        }
?>



<!-- Navigation -->

<?php  include "include/navigation.php"; ?>


<!-- Page Content -->
<div class="container">

	<div class="form-gap"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="text-center">


							<h3><i class="fa fa-user fa-4x"></i></h3>
							<h2 class="text-center">Login</h2>
							<div class="panel-body">


								<form id="login-form" role="form" autocomplete="off" class="form" method="post">

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-user color-blue"></i></span>

											<input name="username" type="text" class="form-control" placeholder="Enter Username">
										</div>
									</div>

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
											<input name="password" type="password" class="form-control" placeholder="Enter Password">
										</div>
									</div>

									<div class="form-group">

										<input name="login" class="btn btn-lg btn-primary btn-block" value="Login" type="submit">
									</div>


								</form>

							</div><!-- Body-->

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<hr>

	<?php include "include/footer.php";?>

</div> <!-- /.container -->
