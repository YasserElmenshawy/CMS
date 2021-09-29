<?php include 'include/admin_header.php'; ?>

<?php
  
  if(isset($_SESSION['username'])){
      $username = $_SESSION['username'];
      $query = "SELECT * FROM users WHERE user_name = '{$username}' ";
      $select_user_profile_query = mysqli_query($connection, $query);
      while($row = mysqli_fetch_array($select_user_profile_query)){
          
        $user_id = $row['user_id'];
        $user_name = $row['user_name'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
      }
      
        }
    
?>
 <?php

if(isset($_POST['edit_user'])){
        $user_name = $_POST['user_name'];
        $user_password = $_POST['user_password'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];
        $user_role = $_POST['user_role'];
        
     $user_password = password_hash($user_password, PASSWORD_BCRYPT, array(['cost' => 12]));
     $query = "UPDATE users SET " ;
     $query .= "user_firstname = '{$user_firstname}', ";
     $query .= "user_lastname = '{$user_lastname}', ";
     $query .= "user_role= '{$user_role}', " ;
     $query .= "user_name = '{$user_name}', " ;
     $query .= "user_password = '{$user_password}', " ;
     $query .= "user_email = '{$user_email}' ";
     $query .= "WHERE user_name  = '{$username}' ";
    

             $update_user = mysqli_query($connection,$query);  
    
    confirmquery($update_user);

            }
                ?>
  
    <div id="wrapper">

        <!-- Navigation -->

<?php include 'include/admin_navigation.php'; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            WELLCOME
                            <small>Subheading</small>
                        </h1>
             
                     <form action="" method="post" enctype="multipart/form-data">
    
     <div class="form-group">
       <lable for="">FristName</lable>
       <input type="text" value =" <?php echo  $user_firstname ; ?>" class="form-control" name="user_firstname">
        
    </div>
    
     
     <div class="form-group">
       <lable for="">LastName</lable>
       <input type="text" value ="<?php echo $user_lastname  ; ?>" class="form-control" name="user_lastname">
        
    </div>
    
    
    
     <div class="form-group">
      <select name="user_role" id="">
          <option value="subscriber"> <?php echo $user_role ; ?> </option>
          <?php
          
          if($user_role == 'admin' ){
                           echo " <option value ='subscriber'>subscriber</option>";


          }else{
                      echo  " <option value ='admin'>admin</option>";
          }
              
?>
      </select>
        
    </div>
    
    <div class="form-group">
       <lable for="">UserName</lable>
       <input type="text"  value = "<?php echo $user_name; ?> " class="form-control" name="user_name">
        
    </div>
    
     <div class="form-group">
       <lable for="">password</lable>s
     <input autocomplete="off" type="password"   class="form-control" name="user_password">

    </div>
    
  
 
    
     <div class="form-group">
       <lable for="">email</lable>
       <input type="email"value = " <?php echo $user_email ; ?> " class="form-control" name="user_email">
        
    </div>
    
     <div class="form-group">
       <lable for="">post image</lable>
<img width ="100" src="../image/<?php echo $user_image ; ?>" alt="">       <input value="<?php echo $user_image ; ?>"
       type="file" name="image">        
    </div>
    
    
    
    
    
    
     <div class="form-group">
      
       <input  class="btn btn-primary"
       type="submit" class="form-control" name="edit_user" value="update Profile">
        
    </div>
    
    
    
    
</form>
            
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php include 'include/admin_footer.php'; ?>

    