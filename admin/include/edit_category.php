    <form action="" method="post">
         <div class="form-group">
             <lable for="cat_title">edit category</lable>
              
    <?php
    if(isset($_GET['update'])){
         $cat_id = $_GET['update'];
        $query = "SELECT * FROM category WHERE cat_id = {$cat_id} ";
        $select_query_id = mysqli_query($connection,$query);
       while($row = mysqli_fetch_assoc($select_query_id)){
           $cat_id = $row['cat_id'];
           $cat_title = $row ['cat_title'];
                         
        ?>                                  
              <input value="<?php if(isset($cat_title)){echo $cat_title;}?>" type="text" class="form-control" name='cat_title'>
                 <?php }
                            } 
                  ?>
                                    
        <?php
             
            if(isset($_POST['edit_category'])){
               $the_cat_tile = $_POST['cat_title'];
                $query = "UPDATE category SET cat_title = '{$the_cat_tile}' WHERE cat_id = {$cat_id}";
                $update_query = mysqli_query($connection,$query);
                if(!$update_query){
                    die("query failed " . mysqli_error($connection));
                }
            }
                                    
         ?>                                                                                               
                                </div>
                                <div class="form-grop">
                                    <input type="submit" class="btn btn-primary" name='edit_category' value="edit_category" >
                                </div>
                            </form>
                        