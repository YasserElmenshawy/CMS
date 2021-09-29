           <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>username</th>
                                    <th>firstname</th>
                                    <th>lastname</th>
                                    <th>email</th>
                                    <th>role</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                   
                                   
            <?php
             $query ="SELECT * FROM users ";
             $select_user = mysqli_query($connection,$query);  
            while($row = mysqli_fetch_assoc($select_user)){  
                  $user_id = $row['user_id'];
                  $user_name = $row['user_name']; 
                  $user_firstname = $row['user_firstname'];
                  $user_lastname = $row['user_lastname'];
                  $user_email = $row['user_email'];
                  $user_image = $row['user_image'];
                  $user_role = $row['user_role'];

                
                    echo"<tr>";
                
                    echo"<td>$user_id</td>";
                    echo"<td>$user_name</td>";
                    echo"<td>$user_firstname</td>";
                    echo"<td>$user_lastname</td>";                        
                    echo"<td>$user_email</td>";
                    echo"<td>$user_role</td>";
      
            echo"<td><a href='user.php?change_to_admin={$user_id}'>change_to_admin</a></td>";
            echo"<td><a href='user.php?change_to_sub={$user_id}'>change_to_sub</a></td>";
            echo"<td><a href='user.php?delete={$user_id}'>Delete</a></td>";  
            echo"<td><a href='user.php?source=edit_user&user_id={$user_id}'>Edit</a></td>";    

                
                echo"</tr>";
            }
         
            ?>                       
                                
                                </tr>
                            </tbody>
                        </table>
                        
            <?php

         if(isset($_GET['delete'])){
                         
           if(isset($_SESSION['role'])){
                if($_SESSION['role'] == 'admin'){
                    $the_user_id = mysqli_real_escape_string($connection,$_GET['delete']);
                    $query = "DELETE FROM users WHERE user_id = {$the_user_id}";
                    $delete_query = mysqli_query($connection, $query);
                    
                    header("location: user.php");
                             } 
                        }
                  
                }
                    

                if(isset($_GET['change_to_sub'])){
                    $the_user_id = $_GET['change_to_sub'];
                    $query = "UPDATE users SET user_role = 'subcruiber' WHERE user_id = $the_user_id ";                    
                    $change_to_sub_query = mysqli_query($connection, $query);
                    
                   header("location: user.php");
                }
                if(isset($_GET['change_to_admin'])){
                    $the_user_id = $_GET['change_to_admin'];
                    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $the_user_id ";                    
                    $change_to_admin_query = mysqli_query($connection, $query);
                    
                   header("location: user.php");
                }

            ?>
                      
                        