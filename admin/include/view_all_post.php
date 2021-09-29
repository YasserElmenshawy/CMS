<?php

if(isset($_POST['checkboxarray'])){
    
    foreach($_POST['checkboxarray'] as $postvalue_id){
        
        $bulk_option =$_POST['bulk_option'];
        
        switch($bulk_option){
        case 'publisher':
                $query = "UPDATE posts SET post_status = '{$bulk_option}' WHERE post_id = {$postvalue_id}";
                $update_to_publish_state = mysqli_query($connection, $query);
                confirmquery($update_to_publish_state);
                
                break;
             case 'draft':
                $query = "UPDATE posts SET post_status = '{$bulk_option}' WHERE post_id = {$postvalue_id}";
                $update_to_draft_state = mysqli_query($connection, $query);
                confirmquery($update_to_draft_state);
                
                break; 
            case 'delete':
                $query = "DELETE FROM posts WHERE post_id = {$postvalue_id}";
                $update_to_delete_state = mysqli_query($connection, $query);
                confirmquery($update_to_delete_state);
                
                break;  
                
              case 'clone':
                 $query ="SELECT * FROM posts WHERE  post_id = {$postvalue_id}";
                 $select_posts = mysqli_query($connection,$query);  
                 $row = mysqli_fetch_assoc($select_posts);  
       
                  $post_category_id = $row['post_category_id']; 
                  $post_title = $row['post_title'];
                  $post_auther = $row['post_auther'];
                  $post_image = $row['post_image'];
                  $post_date = $row['post_date'];
                  $post_content = $row['post_contant'];
                  $post_tag = $row['post_tag'];
                  $post_status = $row['post_status'];
                
                $query = "INSERT INTO posts(post_category_id,post_title,post_auther,post_date,post_image,post_contant,post_tag,post_status)";
               $query.="VALUE({$post_category_id},'{$post_title}','{$post_auther}',now(),'{$post_image}','{$post_content}','{$post_tag}','{$post_status}')";

    $creat_post_query = mysqli_query($connection, $query);
    
    
    confirmquery($creat_post_query);
                
                break;      
        }
        
    }
}



?>
 <form action="" method="post">                             
<table class="table table-bordered table-hover">
                           
 <div id="bulkOptionContainer" class="col-xs-4">
     <select class="form-control"  name="bulk_option" id="">
         <option value="">option select</option>
         <option value="publisher">publisher</option>
         <option value="draft">draft</option>
         <option value="delete">delete</option>
         <option value="clone">clone</option>

     
     </select>   

 </div>
     <div class="col-xs-4">
           <input type="submit" name="submit" class="btn btn-success" value="Apply" >
            <a class="btn btn-primary" href="post.php?source=add_post">Add New</a>                   
                  </div>
                           
                           
             <thead>
              <tr>
                 <th> <input type="checkbox" id="selectallbox"> </th>
                 <th>ID</th>
                 <th>Category</th>
                 <th>Title</th>
                 <th>auther</th>
                 <th>imagde</th>
                 <th>date</th>
                 <th>comment</th>
                 <th>tag</th>
                 <th>status</th>
                 <th>view post</th>
                 <th>Edit</th>
                 <th>delete</th>
                 <th>Views</th>



             </tr>
            </thead>
            <tbody>
          <tr>
                                   
                                   
            <?php
             $query ="SELECT * FROM posts ";
             $select_posts =mysqli_query($connection, $query);  
            while($row = mysqli_fetch_assoc($select_posts)){  
                  $post_id = $row['post_id'];
                  $post_category_id = $row['post_category_id']; 
                  $post_title = $row['post_title'];
                  $post_auther = $row['post_auther'];
                  $post_image = $row['post_image'];
                  $post_date = $row['post_date'];
                  $post_comment_count = $row['post_comment_count'];
                  $post_tag = $row['post_tag'];
                  $post_status = $row['post_status'];
                  $post_views = $row['post_views'];             
                echo"<tr>";
                
                ?>
                   <td> <input type="checkbox" class="checkbox" name="checkboxarray[]" value="<?php echo $post_id; ?>"> </td>
                   <?php
                    echo"<td>$post_id</td>";
                $query = "SELECT * FROM category WHERE cat_id = $post_category_id";
                $send_category_query = mysqli_query($connection, $query);
                while($row = mysqli_fetch_array($send_category_query)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title']; 
                }
                    echo "<td> {$cat_title} </td>";
         
                    echo"<td>$post_title</td>";
                    echo"<td> $post_auther</td>";
                    echo"<td><img class='img-responsive' src='../image/$post_image'> </td>";
                    echo"<td>$post_date</td>";
                
                $query = "SELECT * FROM comment WHERE comment_post_id = $post_id";
                $send_count_query = mysqli_query($connection, $query);
               while($row = mysqli_fetch_array($send_count_query)){
                $comment_id = $row['comment_id'];
                
               }
                $comment_count = mysqli_num_rows($send_count_query);
                    echo"<td><a href='post_comment.php?id={$post_id}'>$comment_count</a></td>";
                    echo"<td>$post_tag</td>";
                    echo"<td>$post_status</td>";
                    echo"<td><a class='btn btn-primary' href='../post.php?p_id={$post_id}'>View post</a></td>";    
                    echo"<td><a class='btn btn-info' href='post.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                ?>
                   
                   <form method="post">
                      <input type="hidden" name="post_id" value="<?php echo $post_id ?>">
                  <?php 
              echo '<td><input class="btn btn-danger" type="submit" value="DELETE" name="delete" ></td>';  
                ?>
                   </form>
                   
                
                <?php
                    echo"<td><a href='post.php?view={$post_id}'>$post_views</a></td>";
                echo"</tr>";
            }
                 
            ?>                       
                                
                                </tr>
                            </tbody>
                        </table>
                                                
</form>
            <?php
                if(isset($_POST['delete'])){
                    $the_post_id = $_POST['post_id'];
                    $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
                    $delete_query = mysqli_query($connection, $query);
                     confirmquery($delete_query);

                   header("location: post.php");
                }
                    
                 if(isset($_GET['view'])){
                    $the_post_id = $_GET['view'];
                    $query = "UPDATE posts SET post_views = 0 WHERE post_id = {$the_post_id}";
                    $update_query = mysqli_query($connection, $query);
                    
                   header("location: post.php");
                }
                     
            ?>
                      
                        