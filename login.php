<?php
   //readfile("login.html");

   if(isset($_POST['login'])){

      session_start();
      include('conn.php');
      require('conn.php');
      $username=$_POST['username'];
      $pw=$_POST['password'];
      //$query=mysqli_query($conn,"select * from `user` where username='$username' && password='$pw'");
      $query = "SELECT * FROM users WHERE username = :username";
      $statement = $conn->prepare($query); 
      $statement->bindValue(':username', $username);
      $statement->execute();
         // fetchAll() returns an array for all of the rows in the result set
      $results = $statement->fetchAll();

   // closes the cursor and frees the connection to the server so other SQL statements may be issued 
      $statement->closecursor();
      foreach ($results as $result)
      {
         $row =$result;
      }
   

      if ($row ==0){//mysqli_num_rows($results) == 0){
         $_SESSION['message']="Please try again, username or password not correct";
         header('location:index.php');
      }
      else{
         //$row=mysqli_fetch_array($query);
         //$row =$query;
         
         if (isset($_POST['remember'])){
            //set up cookie
            setcookie("user", $row['username'], time() + (86400 * 30)); 
            setcookie("pass", $row['pw'], time() + (86400 * 30)); 
         }

         $_SESSION['id']=$row['userid'];
         header('location: login_success.php');
      }
   }
   else{
      header('location:index.php');
      $_SESSION['message']="Please Login!";
   }
?>
