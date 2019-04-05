<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" />
  
  <title>State handling in PHP</title>    
</head>
<body>
  
  <div class="container">
    <h1>PHP and MySQL database</h1>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="get">
      <input type="submit" name="btnaction" value="create" class="btn btn-light" />
      <input type="submit" name="btnaction" value="insert" class="btn btn-light" />   
      <input type="submit" name="btnaction" value="select" class="btn btn-light" />
      <input type="submit" name="btnaction" value="update" class="btn btn-light" />
      <input type="submit" name="btnaction" value="delete" class="btn btn-light" />
      <input type="submit" name="btnaction" value="drop" class="btn btn-light" />            
    </form>

<?php 
if (isset($_GET['btnaction']))
{	
   try 
   { 	
      switch ($_GET['btnaction']) 
      {
         case 'create': createTable(); break;
         case 'insert': insertData();  break;
         case 'select': selectData();  break;
         case 'update': updateData();  break;
         case 'delete': deleteData();  break;
         case 'drop':   dropTable();   break;      
      }
   }
   catch (Exception $e)       // handle any type of exception
   {
      $error_message = $e->getMessage();
      echo "<p>Error message: $error_message </p>";
   }   
}
?>



<?php
// require('connect-db.php');

// require: if a required file is not found, reqire() produces a fatal error, the rest of the script won't run
// include: if a required file is not found, include() throws a warning, the rest of the script will run
?>


<?php  
/*************************/
/** get data **/
function selectData()
{
   require('conn.php');

   // To prepare a SQL statement, use the prepare() method of the PDO object
   //    syntax:   prepare(sql_statement)

   // To execute a SQL statement, use the bindValue() method of the PDO statement object
   // to bind the specified value to the specified param in the prepared statement 
   //    syntax:   bindValue(param, value)
   // then use the execute() method to execute the prepared statement

   // Excute a SQL statement that doesn't have params
   $query = "SELECT * FROM users";
   $statement = $db->prepare($query); 
   $statement->execute();

   // fetchAll() returns an array for all of the rows in the result set
   $results = $statement->fetchAll();

   // closes the cursor and frees the connection to the server so other SQL statements may be issued 
   $statement->closecursor();

   foreach ($results as $result)
   {	
      echo $result['userID'] . ":" . $result['passowrd'] . $result['firstname'] . $result['lastname'] . $result['aboutme'] ."<br/>";
   }


   // Execute a SQL statement that has a param, use a colon followed by a param name
   $someid = "id1";
   $query = "SELECT * FROM users WHERE test_id = :someid";
   $statement = $db->prepare($query);
   $statement->bindValue(':someid', $someid);
   $statement->execute();

   // fetchAll() returns an array for all of the rows in the result set
   $results = $statement->fetchAll();

   // closes the cursor and frees the connection to the server so other SQL statements may be issued
   $statement->closecursor();

   foreach ($results as $result)
   {
      echo "select a row where courseID=id1 --->" . $result['userID'] . ":" . $result['passowrd'] . $result['firstname'] . $result['lastname'] . $result['aboutme'] ."<br/>";
   }

// a SELECT statement returns a result set in the PDOStatement object 
}
?>

<?php 
/*************************/
/** create table **/
function createTable()
{
   require('conn.php');

//    $query = "CREATE TABLE `web4640`.`courses` ( 
//              `courseID` VARCHAR(8) PRIMARY KEY, 
//              `course_desc` VARCHAR(20) NOT NULL )";
   $query = "CREATE TABLE users (
             userID VARCHAR(8) PRIMARY KEY,
             username VARCHAR(20) NOT NULL,
             firstname VARCHAR(20) NOT NULL,
             lastname VARCHAR(20) NOT NULL,
             aboutme VARCHAR(20) NOT NULL,
             )";

   $statement = $db->prepare($query);
   $statement->execute();   
   $statement->closeCursor();
}
?>


<?php 
/*************************/
/** drop table **/
function dropTable()
{
   require('conn.php');

//    $query = "DROP TABLE `web4640`.`courses`";
   $query = "DROP TABLE courses";

   $statement = $db->prepare($query);
   $statement->execute();   
   $statement->closeCursor();
}
?>

<?php 
/*************************/
/** insert data **/
function insertData()
{
   require('conn.php');
   
   $user_id = "newid_from_insertData";
   $username = "newusername_from_insertData";
   $password = "newpassword_from_insertData";
   $firstname = "newfirstname_from_insertData";
   $lastname = "newlastname_from_insertData";
   $aboutme = "newaboutme_from_insertData";

   $query = "INSERT INTO courses (userID, username, password, firstname, lastname, aboutme ) VALUES (:user_id, :username, password, firstname, lastname, aboutme)";
   $statement = $db->prepare($query);
   $statement->bindValue(':user_id', $user_id);
   $statement->bindValue(':username', $username);
   $statement->bindValue(':password', $password);
   $statement->bindValue(':firstname', $firstname);
   $statement->bindValue(':lastname', $lastname);
   $statement->bindValue(':aboutme', $aboutme);

   $statement->execute();
   $statement->closeCursor();
}
?>


<?php
/*************************/
/** update data **/
function updateData()
{
   require('conn.php');
   
   $user_id = "id1";
   $username = "newusername_from_insertData";
   //$password = "newpassword_from_insertData";
   $firstname = "newfirstname_from_insertData";
   //$lastname = "newlastname_from_insertData";
   //$aboutme = "newaboutme_from_insertData";
    
   $query = "UPDATE courses SET firstname=:firstname WHERE userID=:user_id";
   $statement = $db->prepare($query);
   $statement->bindValue(':user_id', $user_id);
   $statement->bindValue(':firstname', $firstname);
   $statement->execute();
   $statement->closeCursor();   
}
?>

<?php
/*************************/
/** delete data **/
function deleteData()
{
   require('conn.php');
	
   $userid = "newid_fr";
	
   $query = "DELETE FROM users WHERE courseID=:id";
   $statement = $db->prepare($query);
   $statement->bindValue(':id', $user_id);
   $statement->execute();
   $statement->closeCursor();
}
?>


  </div>
</body>
</html>