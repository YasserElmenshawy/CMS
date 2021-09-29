<?php

if(isset($_POST['creat_post'])){
        $post_title = $_POST['title'];
        $post_auther = $_POST['auther'];
        $post_category_id = $_POST['post_category'];
        $post_status = $_POST['post_status'];
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        $post_tag = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');
    
    move_uploaded_file($post_image_temp,"../image/$post_image");
    
    $query = "
INSERT INTO posts(post_category_id,post_title,post_auther,post_date,post_image,post_contant,post_tag,post_status)";
    $query.="VALUE({$post_category_id},'{$post_title}','{$post_auther}',now(),'{$post_image}','{$post_content}','{$post_tag}','{$post_status}')";

    $creat_post_query = mysqli_query($connection, $query);
    
    
    confirmquery($creat_post_query);
    
     $p_id = mysqli_insert_id($connection);   
    echo "<p class='bg-success'> Post Created. <a href='../post.php?p_id={$p_id}'>View Post</a> or <a href='post.php'> Edit More Post</a></p> ";
            }
                ?>
   <form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
       <lable for="">post title</lable>
       <input type="text" class="form-control" name="title">
        
    </div>
    
     <div class="form-group">
<select name="post_category" id="post_category">
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
       <input type="text" class="form-control" name="auther">
        
    </div>
    
     <div class="form-group">
       <select name="post_status" id="">
           <option value="draft">post status</option>
           <option value="draft">draft</option>
           <option value="publisher">publisher</option>

       </select>       
        
    </div>
    
     <div class="form-group">
       <lable for="">post image</lable>
       <input type="file" class="form-control" name="image">
        
    </div>
    
    
    
     <div class="form-group">
       <lable for="">post tags</lable>
       <input type="text" class="form-control" name="post_tags">
        
    </div>
    
     <div class="form-group">
       <lable for="">post content</lable>
         <textarea  class="form-control" name="post_content" id="body"  cols="30" rows="10"></textarea>
        
    </div>
    
     <div class="form-group">
      
       <input  class="btn btn-primary"
       type="submit" class="form-control" name="creat_post" value="publisher post">
        
    </div>
    

</form>