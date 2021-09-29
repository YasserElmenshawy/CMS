<?php include("include/db.php"); ?>
<?php session_start(); ?>

<?php include("include/header.php"); ?>

    <!-- Navigation -->
<?php include("include/navigation.php"); ?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

              <?php
                        if(isset($_SESSION['role'])){

                if(isset($_GET['category'])){
                    $post_category_id = $_GET['category'];
                
                
            if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
            $query = "SELECT * FROM posts WHERE post_category_id= $post_category_id " ;

                }else{
               $query = "SELECT * FROM posts WHERE post_category_id= $post_category_id AND post_status = 'publisher' " ;

                }                
   
                $select_all_post_query = mysqli_query($connection,$query);
                $count_category = mysqli_num_rows($select_all_post_query);
                if($count_category<1){
                     echo "<h1 class='text-center'> NO CATEGORY AVALABLE </h1>";

                            }else{
                while($row =mysqli_fetch_assoc($select_all_post_query) ){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_auther = $row['post_auther'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_contant = substr($row['post_contant'],0,50);
        
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
                    by <a href="index.php"><?php echo $post_auther ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="image/<?php echo $post_image ?>" alt="">
                <hr>
                <p><?php echo $post_contant ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
               
                <?php }
                        }
                          }
                            }else{
                                echo "<h1 class='text-center'> NO CATEGORY AVALABLE </h1>";
                                    }
                ?>
            </div>

            <!-- Blog Sidebar Widgets Column -->
       <?php include("include/sidebar.php"); ?>


        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
       <?php include("include/footer.php"); ?>
