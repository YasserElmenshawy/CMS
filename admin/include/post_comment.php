<?php include 'include/admin_header.php'; ?>
   
    <div id="wrapper">

        <!-- Navigation -->

<?php include 'include/admin_navigation.php'; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            WELLCOME
                            <small>Subheading</small>
                        </h1>
                    
                           
                                   
                <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Auther</th>
                                    <th>comment</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>In response to</th>
                                    <th>Date</th>
                                    <th>Approve</th>
                                    <th>UnApprove</th>
                                    <th>delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                   
                                   
            <?php
             $query ="SELECT * FROM comment WHERE comment_post_id = " . mysqli_real_escape_string($_GET['id']) ." ";
             $select_comment = mysqli_query($connection,$query);  
            while($row = mysqli_fetch_assoc($select_comment)){  
                  $comment_id = $row['comment_id'];
                  $comment_post_id = $row['comment_post_id']; 
                  $comment_auther = $row['comment_auther'];
                  $comment_email = $row['comment_email'];
                  $comment_contant = $row['comment_contant'];
                  $comment_stutas = $row['comment_stutas'];
                  $comment_date = $row['comment_date'];
                  
                
                    echo"<tr>";
                
                    echo"<td>$comment_id</td>";
                    echo"<td>$comment_auther</td>";
                    echo"<td>$comment_contant</td>";   
                    echo"<td>$comment_email</td>";
                    echo"<td> $comment_stutas</td>";

                $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
                $select_post_id_query = mysqli_query($connection,$query);
                while($row = mysqli_fetch_assoc($select_post_id_query)){
                    $post_id =$row['post_id'];
                    $post_title = $row['post_title'];
                        
                        
                   echo"<td> <a href='../post.php?p_id=$post_id'> $post_title</a>   </td>";

                }

            echo"<td>$comment_date</td>";
            echo"<td><a href='post_comment.php?Approve={$comment_id}'>Approve</a></td>";    
            echo"<td><a href='post_comment.php?Unapprove={$comment_id}'>Unapprove</a></td>";
            echo"<td><a href='post_comment.php?delete={$comment_id}&id=" . $_GET['id'] . " '>Delete</a></td>";    
                
                echo"</tr>";
            }
                                    
                                    
            ?>                       
                                
                                </tr>
                            </tbody>
                        </table>
                        
            <?php

                if(isset($_GET['Approve'])){
                    $the_comment_id = $_GET['Approve'];
                    $query = "UPDATE comment SET comment_stutas = 'approve' WHERE comment_id = $the_comment_id";
                    $approve_comment_query = mysqli_query($connection, $query);
                    
                   header("location: post_comment.php");
                }

                if(isset($_GET['Unapprove'])){
                    $the_comment_id = $_GET['Unapprove'];
                    $query = "UPDATE comment SET comment_stutas = 'Unapprove' WHERE comment_id = $the_comment_id";                    
                    $unapprove_comment_query = mysqli_query($connection, $query);
                    
                   header("location: post_comment.php");
                }

                if(isset($_GET['delete'])){
                    $the_comment_id = $_GET['delete'];
                    $query = "DELETE FROM comment WHERE comment_id = {$the_comment_id}";
                    $delete_query = mysqli_query($connection, $query);
                    
                   header("location: post_comment.php?id=" . $_GET['id'] . " ");
                }
                    
            ?>
                         
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php include 'include/admin_footer.php'; ?>
