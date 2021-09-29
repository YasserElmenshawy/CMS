<?php include("include/db.php"); ?>

<?php include("include/header.php"); ?>

    <!-- Navigation -->
<?php include("include/navigation.php"); ?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

              <?php
                if(isset($_POST['submit'])){
                    
                $search = $_POST['search'];
                $query = "SELECT * FROM posts WHERE post_tag LIKE '%$search%' " ;
                $search_query = mysqli_query($connection,$query);
                if(!$search_query){
                    echo "QUERY FAILED";
                }else{
                    
                    while($row =mysqli_fetch_assoc($search_query) ){
                    $post_title = $row['post_title'];
                    $post_auther = $row['post_auther'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_contant = $row['post_contant'];
  
                
                ?>
               
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title ?></a>
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
                             }?>
            </div>

            <!-- Blog Sidebar Widgets Column -->
       <?php include("include/sidebar.php"); ?>


        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
       <?php include("include/footer.php"); ?>
