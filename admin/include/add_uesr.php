<?php
if(isset($_POST['creat_user'])){
        $user_name = $_POST['user_name'];
        $user_password = $_POST['user_password'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];
        $user_image = $_FILES['image']['name'];
        $user_image_temp = $_FILES['image']['tmp_name'];
        $user_role = $_POST['user_role'];
    
    move_uploaded_file($user_image_temp,"../image/$user_image");
    
     $user_password = password_hash($user_password, PASSWORD_BCRYPT, array(['cost' => 12]));
    $query = "
INSERT INTO users (user_name,user_password,user_firstname,user_lastname,user_email,user_image,user_role)";
    $query .= "VALUE('{$user_name}','{$user_password}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_image}','{$user_role}')";

    $creat_user_query = mysqli_query($connection, $query);
    
    confirmquery($creat_user_query);
    echo " User Created" . " " . "<a href='user.php'>View User</a>";
   
}

?>

   
   
   
   
   
   
   
   <form action="" method="post" enctype="multipart/form-data">
    
     <div class="form-group">
       <lable for="">FristName</lable>
       <input type="text" class="form-control" name="user_firstname">
        
    </div>
    
     
     <div class="form-group">
       <lable for="">LastName</lable>
       <input type="text" class="form-control" name="user_lastname">
        
    </div>
    
    
    
     <div class="form-group">
      <select name="user_role" id="">
          <option value="subscriber">Select Option</option>
          <option value="admin">Admin</option>
          <option value="subscriber">subscriber</option>

      </select>
        
    </div>
    
    <div class="form-group">
       <lable for="">UserName</lable>
       <input type="text" class="form-control" name="user_name">
        
    </div>
    
     <div class="form-group">
       <lable for="">password</lable>s
     <input type="password" class="form-control" name="user_password">

    </div>
    
  
 
    
     <div class="form-group">
       <lable for="">email</lable>
       <input type="email" class="form-control" name="user_email">
        
    </div>
    
     <div class="form-group">
       <lable for="">post image</lable>
       <input type="file" class="form-control" name="image">
        
    </div>
    
    
    
    
    
    
     <div class="form-group">
      
       <input  class="btn btn-primary"
       type="submit" class="form-control" name="creat_user" value="Craet User">
        
    </div>
    
    
    
    
</form>