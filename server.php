<?php

    $username = "";
    $email = "";
    $errors = array();

    //connect to the database
    $db = mysqli_connect('localhost', 'root','', 'login');
    
    // if the registration button clicked
    if (isset($_POST['rigester'])) {
        $username = mysql_real_escape_string($_POST['username']);
        $email = mysql_real_escape_string($_POST['email']);
        $password_1 = mysql_real_escape_string($_POST['password_1']);
        $password_2 = mysql_real_escape_string($_POST['password_2']);


        //ensure that the form fields are filled properly
        if (empty($username)) {
            array_push($errors,"Username is required");
        }
        if (empty($email)) {
            array_push($errors,"Email is required");
        }
        if (empty($password_1)) {
            array_push($errors,"Password is required");
        }

        if ($password_1 != $password_2) {
            array_push($errors,"The password does not match");
        }

        //if no error
        if (count($username) == 0) {
           $password = md5($password_1); // encrypt password
           $sql = "INSERT INTO users(username, email, password) VALUES ('$username', '$email', '$password')";
           
           $mysqli_query($db, $sql);
           $_SESSION['username'] = $username;
           $_SESSION['success'] = "You are now logged in";
           header("location: index.html");  //redirect to home page
        }
    }

    //login
    if (isset($_POST['login'])) {
            $username = mysql_real_escape_string($_POST['username']);
            $email = mysql_real_escape_string($_POST['email']);
            $password = mysql_real_escape_string($_POST['password']);
    
            //ensure that the form fields are filled properly
            if (empty($username)) {
                array_push($errors,"Username is required");
            }
            if (empty($email)) {
                array_push($errors,"Email is required");
            }
            if (empty($password_1)) {
                array_push($errors,"Password is required");
            }

           if (count($errors) == 0) {
               $password = md5($password);
               $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
               $result = $mysqli_query($db, $query);
               if (mysqli_num_rows($result) == 1) {
                   //user login
                    $_SESSION['username'] = $username;
                    $_SESSION['success'] = "You are now logged in";
                    header("location: http://www.google.com");  //redirect to home page
               }
               else{
                   array_push($errors, "Wrong username/password combination");
               }
           } 
    }
  
    //logout
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header('location: login.html');
    }

?>