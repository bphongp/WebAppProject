<?php
	session_start();
	include('conn.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">  <!-- required to handle IE -->

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" /> 
        <!--first thing need to define bootstrap-->
        <link rel="stylesheet" href="styles/jumbotron_image.css" />
        <link rel="stylesheet" href="styles/nav_styles.css" />

        <meta charset="utf-8">
        <!--the following lines are for the navbar...just going to copy and past fo rnow-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <!--end for navbar-->
        <title>UInvite</title>

        <script type="text/javascript">
            function setFocus(){
                document.getElementById("username").focus();
            }
        </script>

    </head>
    <body onload="setFocus();">
        <!--this is for the navbar the navbar for login/homepage is a little different-->
        <nav class="navbar navbar-expand-md bg-company-blue navbar-dark">
            <a class="navbar-brand" href="#"><h3 class = "nav-logo-orange">UInvite</h3></a>
        </nav>
        <!--the nice photo of the people and learn more thing-->
        <div class="jumbotron">
            <h1 class ="jumbotron_color">UInvite</h1>
            <h2 text-align: center> Easily Create Events and Send Invitations</h2>
            <p>
                <a class="btn btn-primary btn-lg" href=" #" role=" button"> Learn more</a>
            </p>
        </div>
        <!--This whole div is for the username and password for the user to enter-->
        <div class="form-group">
        <form method="POST" action="login.php">
            <label class ="col-sm-2"><b>Username</b></label>
            <div class = "col-sm-5">
                <!--the cookie is so that until if the session ends and user comes back to the page it will be prefilled-->
                <input type="text" class = "form-control" value="<?php if (isset($_COOKIE["user"])){echo $_COOKIE["user"];}?>" name="username" autofocus required>
                <span class="error" id="username-note"></span>
            </div>
            <label class ="col-sm-2"><b>Password</b></label>
            <div class = "col-sm-5">
                <input type="password" class = "form-control" value="<?php if (isset($_COOKIE["pass"])){echo $_COOKIE["pass"];}?>" name="password" required>
                <span class="error" id="password-note"></span>    
            </div>
            <div class = "col-sm-5">
                <!--the remembering of the cookies only happens if the user chooses to check the remember me checkbox-->
                <!--if not then the username and password will not be remembered-->
                <input type="checkbox" name="remember"> Remember me <br>
            </div>
            <div class = "col-sm-5">
                <input type = "submit" id = "Signup" class = "btn btn-secondary" value = Signup onclick= "signup()">

                <input type="submit" value="Login" name="login" class = "btn btn-primary" onclick="login()">
            </div>
        </form>
            <!--this is where the errors will be-->
            <span class="error">
            <?php
                if (isset($_SESSION['message'])){
                    echo $_SESSION['message'];
                }
                unset($_SESSION['message']);
            ?>
            </span>
        </div>
            <!--this div is for the login, singup and forgot password-->
            <div class = "col-sm-5">
                <a href= "#">Forgot Username or Password?</a>
                <br>
                <span id ="redirectstologin"></span>
                <span id ="redirectstosignup"></span>
            </div>
        <script>
            /* *******don't really need now that we have php but will keep it here********
            function login will check to see if the password is empty if it is it will tell the
             user to enter something then try to login again. if login passes... for now just redirect*/
            function login(){
                var un = document.getElementById("username").value;
                var pw = document.getElementById("password").value;
                if (pw === ''){
                    document.getElementById("password").focus();
                    document.getElementById("password-note").innerHTML = "Please enter your password";
                    document.getElementById("redirectstosignup").innerHTML = "";

                }
                else{
                    document.getElementById("password-note").innerHTML = "";
                    document.getElementById("redirectstologin").innerHTML = "if password field and such are successful will login(backend)"
                    document.getElementById("redirectstosignup").innerHTML = "";
                }
            }
            /*signup will not really do anything yet because we are not sure how to redirect*/
            function signup(){
                document.getElementById("redirectstologin").innerHTML = ""
                document.getElementById("redirectstosignup").innerHTML = "Signup clicked--would redirect to signup page"
                //location.href = "www.yoursite.com";
            }
            /*this is an event listener for the username. If the user name is empty
                it ill ask the user to enter in a username to continue*/
            document.getElementById("password").addEventListener("focus", validateUsername);

            /*this is the function to validate the username. if they did not enter anything
            it will ask the user to enter a username*/
            function validateUsername(){
                if (document.getElementById("username").value === '')
                {
                    document.getElementById("username").focus();
                    document.getElementById("username-note").innerHTML = "Please enter your username.";
                }
                else
                    document.getElementById("username-note").innerHTML = ""; // if nothing is wrong, let's make sure no left-over message
            }

        </script>
    </body>
</html>
