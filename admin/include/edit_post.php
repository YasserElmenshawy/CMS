<?php
            if(isset($_GET['p_id'])){  
            $p_id = $_GET['p_id'];
            }
             $query ="SELECT * FROM posts WHERE post_id = {$p_id}";
             $select_posts = mysqli_query($connection,$query);  
                  while($row = mysqli_fetch_assoc($select_posts)){  
                  $post_id = $row['post_id'];
                  $post_category_id = $row['post_category_id']; 
                  $post_title = $row['post_title'];
                  $post_auther = $row['post_auther'];
                  $post_image = $row['post_image'];
                  $post_date = $row['post_date'];
                  $post_comment_count = $row['post_comment_count'];
                  $post_tag = $row['post_tag'];
                  $post_contant = $row['post_contant'];
                  $post_status = $row['post_status'];

                  }

        if(isset($_POST['edit_post'])){
            $post_title = $_POST['title'];
            $post_auther = $_POST['auther'];
            $post_category_id = $_POST['postcategory'];
            $post_status = $_POST['post_status'];
            $post_image = $_FILES['image']['name'];
            $post_image_temp = $_FILES['image']['tmp_name'];
            $post_tag = $_POST['post_tags'];
            $post_content = $_POST['post_content'];
            
            
            move_uploaded_file($post_image_temp,"../image/$post_image");
            
    
            if(empty($post_image)){
                $query = "SELECT * FROM posts WHERE post_id = $p_id ";
                $select_image = mysqli_query($connection , $query);
                
                while($row = mysqli_fetch_array($select_image)){
                    $post_image = $row['post_image'];
                }
            }

             $query = "UPDATE posts SET "; 
             $query.= " post_title = '{$post_title}', ";
             $query.= " post_category_id = '{$post_category_id}', ";
             $query.= " post_auther = '{$post_auther}', ";
             $query.= " post_date = now() , ";
             $query.= " post_image = '{$post_image}', ";
             $query.= " post_contant = '{$post_content}', ";
             $query.= " post_tag = '{$post_tag}', ";
             $query.= " post_status = '{$post_status}' ";
             $query.= " WHERE post_id = {$p_id}";
            
             $edit_posts = mysqli_query($connection, $query); 
            
            
            confirmquery($edit_posts);
            
            echo "<p class='bg-success'> Post Update. <a href='../post.php?p_id={$p_id}'>View Post</a> or <a href='post.php'> Edit More Post</a></p> ";
       }
 
   ?>
 
   <form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
       <lable for="">post title</lable>
       <input value="<?php echo $post_title ; ?>" type="text" class="form-control" name="title">
        
    </div>
    
     <div class="form-group">
       <lable for="">post category</lable>
       <select name="postcategory" id="postcategory">
           <?php
            $query = "SELECT * FROM category";
            $select_category = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($select_category)) {
                $cat_id=$row['cat_id'];
                $cat_title = $row['cat_title'];
                
                echo "<option value ='{$cat_id}' >{$cat_title}</option>";
            }   
           ?>
       </select>
     
    </div>
    
    
     <div class="form-group">
       <lable for="">post auther</lable>
       <input value="<?php echo $post_auther ; ?>"
       type="text" class="form-control" name="auther">
        
    </div>
    
     <div class="form-group">
      
      <select name="post_status" id="">
        <option value="<?php echo $post_status; ?>"><?php echo $post_status ; ?></option>
          
          <?php
            if($post_status == 'publisher'){
                echo "<option value = 'draft'>Draft</option>";
            }else{
                echo "<option value ='publisher'>publisher</option>";
            }
          
          ?>
      </select>
     
        
    </div>
    
     <div class="form-group">
<img width ="100" src="../image/<?php echo $post_image ; ?>" alt="">       <input value="<?php echo $post_image ; ?>"
       type="file" name="image">
        
    </div>
    
    
    
     <div class="form-group">
       <lable for="">post tags</lable>
       <input value="<?php echo $post_tag ; ?>"
       type="text" class="form-control" name="post_tags">
        
    </div>
    
     <div class="form-group">
       <lable for="">post content</lable>
       <textarea value="<?php echo $post_contant ; ?>" class="form-control" name="post_content" id="body" cols="30" rows="10"><?php echo $post_contant ; ?></textarea>
        
    </div>
    
     <div class="form-group">
      
       <input  class="btn btn-primary"
       type="submit" class="form-control" name="edit_post" value="edit post">
        
    </div>
</form>