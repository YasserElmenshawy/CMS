<?php include("include/db.php"); ?>
<?php session_start(); ?>
<?php include'admin/functions.php' ?>

<?php include("include/header.php"); ?>

    <!-- Navigation -->
<?php include("include/navigation.php"); ?>

<?php

    if(isset($_POST['liked'])){
        
     $post_id = $_POST['post_id'];
     $user_id = $_POST['user_id'];

      //1 =  FETCHING THE RIGHT POST

     $query = "SELECT * FROM posts WHERE post_id=$post_id";
     $postResult = mysqli_query($connection, $query);
     $post = mysqli_fetch_array($postResult);
     $likes = $post['likes'];
    
       // 2 = UPDATE - INCREMENTING WITH LIKES
        
     mysqli_query($connection, "UPDATE posts SET likes=$likes+1 WHERE post_id=$post_id");

     // 3 = CREATE LIKES FOR POST

     mysqli_query($connection, "INSERT INTO likes(user_id, post_id) VALUES($user_id, $post_id)");
     exit();
    
    }



    if(isset($_POST['unliked'])){
        
     $post_id = $_POST['post_id'];
     $user_id = $_POST['user_id'];

      //1 =  FETCHING THE RIGHT POST

     $query = "SELECT * FROM posts WHERE post_id=$post_id";
     $postResult = mysqli_query($connection, $query);
     $post = mysqli_fetch_array($postResult);
     $likes = $post['likes'];
    
     // 2 = DELETE LIKES FOR POST

     mysqli_query($connection, "DELETE FROM likes WHERE post_id=$post_id AND user_id=$user_id");
    
       // 3 = UPDATE - INCREMENTING WITH LIKES
        
     mysqli_query($connection, "UPDATE posts SET likes=$likes-1 WHERE post_id=$post_id");

     // 2 = DELETE LIKES FOR POST
     exit();    
    }

?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

              <?php
                
                  if(isset($_GET['p_id'])){
                    $p_id = $_GET['p_id'];
                
                
              $query = "UPDATE posts  SET post_views = post_views +1  WHERE post_id = $p_id " ;
               $send_query = mysqli_query($connection, $query);
                
                if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
                     $query = "SELECT * FROM posts WHERE post_id = $p_id " ;

                }else{
                $query = "SELECT * FROM posts WHERE post_id = $p_id AND post_status = 'publisher'";

                }    
                    
                
                $select_all_post_query = mysqli_query($connection,$query);
                while($row =mysqli_fetch_assoc($select_all_post_query) ){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_auther = $row['post_auther'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_contant = $row['post_contant'];
                    $post_like = $row['likes'];
                              
                ?>
               
                <h1 class="page-header">
                    POST
                </h1>
                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id ;?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_auther ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="image/<?php echo $post_image;?>" alt="">
                <hr>
                <p><?php echo $post_contant ?></p>
                
                <?php if(isLoggedIn()){ ?>
                
                <?php if(UserLikePost($post_id)): ?>
                  <div class="row">
                      <p class="pull-right"><a class="unlike" href="/cms/post.php?p_id=<?php echo $post_id; ?>"><span class="glyphicon glyphicon-thumbs-down"></span>UnLike</a></p> 
                </div>
                
                <?php else: ?>
                
                <div class="row">
                      <p class="pull-right"><a class="like"  href="/cms/post.php?p_id=<?php echo $post_id; ?>"><span class="glyphicon glyphicon-thumbs-up"></span>Like</a></p> 
                </div>
               <?php endif; 
                    }else{?>
                      <div class="row">
                        <p class="pull-right login-to-post">You need to <a href="/cms/login.php">Login</a> to like </p>
                    </div>
              <?php  }  ?>
               
                <div class="row">
                      <p class="pull-right">Like: 
                      <?php 
                          $result = query("SELECT * FROM likes WHERE post_id = $post_id");
                          $count_like = mysqli_num_rows($result);
                          echo $count_like;
                          ?> 
                      </p> 
                </div>
                <div class="cleatfix"></div>
                <?php }   ?>
            <!-- Blog Comments -->
                <?php
                
                    if(isset($_POST['creat_comment'])){
                        $the_p_id = $_GET['p_id'];
                        
                        $comment_auther= $_POST['comment_auther'];
                        $comment_email = $_POST['comment_email'];
                        $comment_content = $_POST['comment_contant'];
                            if(!empty($comment_auther) && !empty($comment_auther) &&  !empty($comment_auther)){
                        
                        
                        $query = "INSERT INTO comment (comment_post_id,comment_auther ,comment_email,comment_contant,comment_stutas,comment_date)";
                        $query .= "VALUES($the_p_id , '{$comment_auther}' , '{$comment_email}',
                        '{$comment_content}',
                        'unaprove', now())";
                    
                        
                        $create_comment_query = mysqli_query($connection,$query);
                        if(!$create_comment_query){
                            die('queye failed ' . mysqli_error($connection));
                            
                        }
                        $query = "UPDATE posts SET post_comment_count = post_comment_count+1 WHERE post_id = $the_p_id " ; 
                         $update_comment_query = mysqli_query($connection,$query);

                        
                    }else{
                                echo" <script> alert('Fields connot be empty') </script>";
                            }
                    }
                
                
                ?>
                

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post">
                       <div class="form-group">
                           <lable for="Author">Author</lable>
                           <input type="text" name="comment_auther" class="form-control">
                       </div>
                       <div class="form-group">
                           <lable for="Email">Email</lable>
                           <input type="email" name="comment_email" class="form-control">
                       </div>
                        <div class="form-group">
                           <lable for="comment">Your comment</lable>
                            <textarea class="form-control" name="comment_contant" rows="3"></textarea>
                        </div>
                        <button type="submit" name="creat_comment"  class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

         <?php
                $the_p_id = $_GET['p_id'];
         $query = "SELECT * FROM comment WHERE comment_post_id = {$the_p_id} " ;
         $query .= "AND comment_stutas = 'approve' ";
         $query .= "ORDER BY comment_id DESC ";
         $select_comment_query = mysqli_query($connection, $query);
                if(!$select_comment_query){
                    die('faield' . mysqli_error($connection));
                }
        while($row = mysqli_fetch_assoc($select_comment_query)){
            $comment_auther = $row['comment_auther'];
            $comment_date = $row['comment_date'];
            $comment_contant= $row['comment_contant'];
                
        ?>      
  
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_auther ; ?>
                            <small><?php echo $comment_date ;?></small>
                        </h4>
                       <?php echo $comment_contant; ?>
                    </div>
                </div>
           
           
           <?php }   }else{
                    header('Location: index.php');
                }  ?>
            </div>
            

            <!-- Blog Sidebar Widgets Column -->
       <?php include("include/sidebar.php"); ?>


        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
       <?php include("include/footer.php"); ?>
       
      
     
      <script>
            $(document).ready(function(){

                  var post_id = <?php echo $p_id; ?>;
                  var user_id = <?php echo LoggedInUserId(); ?>

                // LIKING

                $('.like').click(function(){
                    
                    $.ajax({
                        url: "/cms/post.php?p_id=<?php echo $p_id; ?>",
                        type: 'post',
                        data: {
                            'liked': 1,
                            'post_id': post_id,
                            'user_id': user_id
                        }
                    });
                });
                
                 $('.unlike').click(function(){
                    
                    $.ajax({
                        url: "/cms/post.php?p_id=<?php echo $p_id; ?>",
                        type: 'post',
                        data: {
                            'unliked': 1,
                            'post_id': post_id,
                            'user_id': user_id
                        }
                    });
                });


            });




        </script>

