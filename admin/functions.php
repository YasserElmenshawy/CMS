<?php

function redirect($location){


    header("Location:" . $location);
    exit;

}


function query($query){
    global $connection;
    
    return mysqli_query($connection, $query);
}


function ifItIsMethod($method=null){

    if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){

        return true;

    }

    return false;

}

function isLoggedIn(){

    if(isset($_SESSION['role'])){

        return true;


    }


   return false;

}

function LoggedInUserId(){
    if(isLoggedIn()){
        $result = query("SELECT *FROM users WHERE user_name ='" . $_SESSION['username']."'");
        $user = mysqli_fetch_array($result);
        if(mysqli_num_rows($result) >=1 ){
            return $user['user_id'];
        }
    }
    return false;
}

function UserLikePost($post_id=''){
    global $connection;
    
       $result = query("SELECT * FROM likes WHERE user_id=" . LoggedInUserId() . " AND post_id= $post_id");
       return mysqli_num_rows($result) >= 1 ? true : false ;
    
    
}


function checkIfUserIsLoggedInAndRedirect($redirectLocation=null){

    if(isLoggedIn()){

        redirect($redirectLocation);

    }

}




function confirmquery($result){
    global $connection;
    
    if(!$result){
        die("QUERY FAILED ." . mysqli_error($connection));
    }
}





function insert_category(){
    global $connection;
        if(isset($_POST['submit'])){
            
            $cat_title =$_POST['cat_title'];
            if($cat_title == "" || empty($cat_title)){
                echo " this field should not be empty";
            }else{
                
                    $query = "INSERT INTO category (cat_title)";
                    $query.= "VALUE('{$cat_title}') ";
                    $insert_category = mysqli_query($connection,$query);
                if(!$insert_category){
                    die('query failed' . mysqli_error($connection));
                }

        }   
        }
}

function findAllCategory(){
    global $connection;
     
      $query ="SELECT * FROM category";
        $select_categorys = mysqli_query($connection,$query);                      
       while($row = mysqli_fetch_assoc($select_categorys)){
           $cat_id = $row['cat_id'];
           $cat_title = $row['cat_title'];
           
           echo"<tr>";
             echo " <td> {$cat_id} </td>";
             echo "<td> {$cat_title}</td>";
            echo "<td> <a href='categors.php?delete={$cat_id}'>DELETE</a></td>";
           echo "<td> <a href='categors.php?update={$cat_id}'>UPDARE</a></td>";

          echo "</tr>";
       }
}

function deletCategory(){
    global $connection;
     
     if(isset($_GET['delete'])){
         $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM category WHERE cat_id = {$the_cat_id} ";
        $delete_query = mysqli_query($connection,$query);
        // to make refrach for page 
        header("Location: categors.php");
    }
}

function recordcount($table){
    global $connection;
    
     $query = "SELECT * FROM " . $table;
     $select_all_post = mysqli_query($connection, $query);
     $result = mysqli_num_rows($select_all_post); 
  // confirmquery($result);
    
     return $result;
}

function checkstatus($table,$colum,$status){
    global $connection;
    
    $query = "SELECT * FROM $table WHERE $colum = '$status' ";
    $result = mysqli_query($connection, $query);
    
    return mysqli_num_rows($result);
    
}


function checkpostrole($table,$colum,$role){
    global $connection;
    $query = "SELECT * FROM $table WHERE $colum = '$role' ";
    $select_all_subscriber = mysqli_query($connection, $query);
    
    return mysqli_num_rows($select_all_subscriber);
    
}




 function login_user($username, $password)
 {

     global $connection;

     $username = trim($username);
     $password = trim($password);

     $username = mysqli_real_escape_string($connection, $username);
     $password = mysqli_real_escape_string($connection, $password);


     $query = "SELECT * FROM users WHERE user_name = '{$username}'";
     $select_user_query = mysqli_query($connection, $query);
     if (!$select_user_query) {

         die("QUERY FAILED" . mysqli_error($connection));

     }


     while ($row = mysqli_fetch_array($select_user_query)) {

         $db_user_id = $row['user_id '];
         $db_username = $row['user_name'];
         $db_user_password = $row['user_password'];
         $db_user_firstname = $row['user_firstname'];
         $db_user_lastname = $row['user_lastname'];
         $db_user_role = $row['user_role'];


         if (password_verify($password,$db_user_password)) {

             $_SESSION['username'] = $db_username;
             $_SESSION['firstname'] = $db_user_firstname;
             $_SESSION['lastname'] = $db_user_lastname;
             $_SESSION['role'] = $db_user_role;



             redirect("/cms/admin.php");


         } else {


             return false;



         }



     }

     return true;

 }



function email_exists($email){

    global $connection;


    $query = "SELECT user_email FROM users WHERE user_email = '$email'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    if(mysqli_num_rows($result) > 0) {

        return true;

    } else {

        return false;

    }



}


     ?>