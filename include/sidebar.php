            <div class="col-md-4">

                 <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="post">
                    <div class="input-group">
                        <input type="text" name='search' class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" name='submit' type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                 
                       <!-- /.input-group -->
                    </form>

                </div>
  
                  <!-- login  -->
       
                <div class="well">
                   <?php if(isset($_SESSION['role'])):  ?>
                   
                   <h4>Logged in as <?php echo $_SESSION['role'] ?> </h4>
                   <a class='btn btn-primary' href="/cms/include/logout.php">Logout</a>
                   <?php else:  ?>
                       <h4>Login</h4>
                    <form action="include/login.php" method="post">
                    <div class="form-group">
                        <input type="text" name='username' class="form-control" placeholder="Enter UserName">
                        
                        </div>
                        <div class="input-group">
                           <input type="password" name="password" class="form-control" placeholder="Enter Password" >    
                        <span class="input-group-btn">
                            <button class="btn btn-primary" name='login' type="submit">Login
                        </button>
                        </span>
                    </div>
                    <div class="form-group">
                        <a href="forgot.php?forgot=<?php echo uniqid(true) ?>">Forgot Password</a>
                    </div>
                    <!-- /.input-group -->
                     </form>

                   
                   <?php endif;  ?>
                    
                </div>
      
                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                              <?php
                                $query = "SELECT * FROM category ";
                                $select_query = mysqli_query($connection,$query);
                                while($row = mysqli_fetch_assoc($select_query)){
                                    $cat_id = $row['cat_id'];
                                    $cat_title = $row['cat_title'];
                                   
                        echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a>
                                </li>";
                                }  
                                    ?>
                                 
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                 <!--
                  
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
             <?php include 'widget.php' ?>
</div>