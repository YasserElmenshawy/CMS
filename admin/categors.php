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
                        
                        <div class="col-xs-6">
                        
                           <?php insert_category(); ?>
                            <form action="" method="post">
                                <div class="form-group">
                                    <lable for="cat_title">category</lable>
                                    <input type="text" class="form-control" name='cat_title'>
                                </div>
                                <div class="form-grop">
                                    <input type="submit" class="btn btn-primary" name='submit' value="add_category" >
                                </div>
                            </form>
                            
         <?php
          if(isset($_GET['update']))  {
            $cat_id =  $_GET['update'];
              include'include/edit_category.php';
          }                
                            ?>                      
                 
                        </div>
                        
                      <div class="col-xs-6">             
                          <table class="table table-bordered table-hover">
                              <thead>
                                  <tr>
                                      <th>id</th>
                                      <th>category</th>
                                  </tr>
                              </thead>
                              <tbody>
                              <a href=""></a>
            <!--
            select all category
            -->                  
   <?php findAllCategory(); ?>
  <?php
    /////delete category                              
    deletCategory();
                                  
        ?>                      
                                  
                              </tbody>
                          </table>
                      </div>  
                      
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

    