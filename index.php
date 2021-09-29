<?php include("include/db.php"); ?>
<?php session_start(); ?>

<?php include("include/header.php"); ?>
<?php include'admin/functions.php' ?>

    <!-- Navigation -->
<?php include("include/navigation.php"); ?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
<?php
            
         if(isset($_GET['page'])){
         $page =  $_GET['page'];
             
         } else{
          $page = "";
      }    
        if($page == ""  || $page == 1 ){
            $page_1 = 0;
        }else{
            $page_1= ($page*5)-5;
        }        

    
    if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
     $query = "SELECT * FROM posts";

                } else{
     $query = "SELECT * FROM posts WHERE post_status = 'publisher'";

                }            
            
            
     $find_count = mysqli_query($connection, $query);
     $count = mysqli_num_rows($find_count);
    if($count <1){
                    echo "<h1 class='text-center'> NO POST AVAIBLE</h1> ";

    } else{       
     $count = ceil($count/5);           
                $query = "SELECT * FROM posts LIMIT $page_1 , 5 ";
                $select_all_post_query = mysqli_query($connection,$query);
                while($row =mysqli_fetch_assoc($select_all_post_query) ){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_auther = $row['post_auther'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_contant = substr($row['post_contant'],0,50);
                    $post_status = $row['post_status'];
                
                ?>
               
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id ;?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="auther_post.php?p_auther=<?php echo $post_auther ;?>&p_id=<?php echo $post_id ;?>"><?php echo $post_auther ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                <hr>
                
                <a href="post.php?p_id=<?php echo $post_id ;?>">
                <img class="img-responsive" src="image/<?php echo $post_image;?>" alt="">
            
                </a>
                  <hr>
                <p><?php echo $post_contant ?></p>
               <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ;?>">Read More <spam class="glyphicon glyphicon-chevron-right"></spam></a> 

                <hr>
               
                <?php  } } ?>
            </div>
            <!-- Blog Sidebar Widgets Column -->
       <?php include("include/sidebar.php"); ?>

        </div>
    <ul class="pager">    <!-- /.row -->
<?php
        
        for($i=1;$i<=$count;$i++){
    echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";

        }
          
        
        ?>
        </ul>
        <hr>

        <!-- Footer -->
       <?php include("include/footer.php"); ?>
