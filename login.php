
<?php include "navbar.html"; ?>

<?php
function reject($entry)
{
   echo 'Please log in first.';
   exit();
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && strlen($_POST['Username']) > 0)
{
   $user = trim($_POST['Username']);
   if (!ctype_alnum($user))   // ctype_alnum() check if the values contain only alphanumeric data
      reject('User Name');

   if (isset($_POST['pwd']))
   {
      $pwd = trim($_POST['password']);
      if (!ctype_alnum($pwd))
         reject('Password');
      else
      {
         setcookie('user', $user, time()+3600);
         setcookie('pwd', md5($pwd), time()+3600);
         header('Location: createAnEvent.html');
      }
   }
}

?>
