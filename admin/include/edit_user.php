<?php
if(isset($_GET['user_id'])){
            $user_id = $_GET['user_id'];
}

$query = "SELECT * FROM users WHERE user_id = {$user_id} ";
             $select_user = mysqli_query($connection,$query);  
while($row = mysqli_fetch_assoc($select_user)){
        $user_id = $row['user_id'];
        $user_name = $row['user_name'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
    
}


if(isset($_POST['edit_user'])){
        $user_name = $_POST['user_name'];
        $user_password = $_POST['user_password'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];
        $user_image = $_FILES['image']['name'];
        $user_image_temp = $_FILES['image']['tmp_name'];
        $user_role = $_POST['user_role'];
 
     $user_password = password_hash($user_password, PASSWORD_BCRYPT, array(['cost' => 12]));
    
      $query = "UPDATE users SET " ;
     $query .= "user_firstname = '{$user_firstname}', ";
     $query .= "user_lastname = '{$user_lastname}', ";
     $query .= "user_role= '{$user_role}', " ;
     $query .= "user_name = '{$user_name}', " ;
     $query .= "user_password = '{$user_password}', " ;
     $query .= "user_email = '{$user_email}', ";
     $query .= "user_image = '{$user_image}' ";
     $query .= "WHERE user_id  = $user_id ";

             $update_user = mysqli_query($connection,$query);  
    
                confirmquery($update_user);

}

?>
   
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
          <option value="<?php echo $user_role ; ?>"> <?php echo $user_role ; ?> </option>
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
     <input type="password" value = " <?php echo $user_password ; ?> " class="form-control" name="user_password">

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
       type="submit" class="form-control" name="edit_user" value="edit User">
        
    </div>

    
</form>