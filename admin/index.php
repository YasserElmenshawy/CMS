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
                            <small><?php  echo $_SESSION['username']; ?></small>
                        </h1>
                       
                    </div>
                </div>
                <!-- /.row -->
                
                       
                <!-- /.row -->
                
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
     
                        
       <div class='huge'><?php echo $post_count = recordcount('posts');?></div>                 
                    
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="post.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                       
    <div class='huge'><?php echo $comment_count = recordcount('comment');?></div>
                    
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comment.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                          
        <div class='huge'><?php echo $user_count = recordcount('users');?></div>
                   
                    
                    
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="user.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                          
             <div class='huge'><?php echo $category_count = recordcount('category');?></div>
                  
                       
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categors.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
            
      
    <?php
  
     $post_publisher_count =checkstatus('posts','post_status','publisher');              
     $post_draft_count =checkstatus('posts','post_status','draft');               
     $commant_unapprove_count =checkstatus('comment','comment_stutas','Unapprove');            
     $user_subcruiber_count = checkpostrole('users','user_role','subcruiber');                   
             
    ?>            
               <div class="row">
                   
                    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
                      ['Data', 'count'],

     <?php
            $element_text = ['ALL posts','Active Post','Draft Post','comments','Pending Comment','users','Subscribar','categorys'];
            $element_count = [$post_count,$post_publisher_count,$post_draft_count ,$comment_count,$commant_unapprove_count, $user_count,$user_subcruiber_count, $category_count];
            
            
            for($i =0;$i < 8; $i++){
               
              echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}], ";
            }
            
           ?>      
          
        ]);

        var options = {
          chart: {
            title: 'Company Performance',
            subtitle: 'Sales, Expenses, and Profit: 2014-2017',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
              
     <div id="columnchart_material" style="width:'auto'; height: 500px;"></div>

               </div> 
        
               </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php include 'include/admin_footer.php'; ?>