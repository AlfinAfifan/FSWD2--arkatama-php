<?php

session_start();

if( isset($_SESSION["login"]) ) {
    header("location: redirect.php");
    exit;
}

require 'function.php';

if( isset($_POST["login"]) ) {
    $email = $_POST["email"];
    $pwd = htmlspecialchars($_POST["pwd"]);

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' AND password = '$pwd'");

    // Cek username
    if( mysqli_num_rows($result) === 1 ) {
        $_SESSION["login"] = true;
        header("location: index.php");
        exit;
    }
    $error = true;
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login User</title>
    <link rel="stylesheet" href="stylelogin.css?<?= time(); ?>">
    <style>
        * {
    padding: 0;
    margin: 0;
    text-decoration: none;
    font-family: 'Roboto', sans-serif;
    box-sizing: border-box;
}

.container {
    width: 100vw;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url(img/login.jpg);
    background-size: cover;
    background-repeat: no-repeat;
}

form {
    background: linear-gradient(rgba(255, 255, 255, 0.7), rgba(255, 255, 255, 0.7));
    width: 350px;
    height: 400px;
    padding: 20px;
    border-radius: 15px;
    display: flex;
    flex-direction: column;
}

form h1 {
    align-self: center;
    color: #006863;
    font-family: 'Poppins', sans-serif;
    margin-bottom: 15px;
}

form .error {
    color: red;
}

form input {
    margin-top: 20px;
    height: 40px;
    background: transparent;
    border: none;
    border-bottom: 2px solid #006863;
    color: black;
    font-size: 1em;
    font-weight: 400;
}

form input:focus {
    outline: none;
}

form button {
    margin-top: 30px;
    height: 45px;
    background-color: #006863;
    border-radius: 10px;
    border: none;
    color: white;
    font-size: 1.2em;
    font-weight: 600;
    letter-spacing: 1px;
    cursor: pointer;
    transition: 0.4s;
}

form button:hover {
    background-color: black;
    color: white;
}

form p {
    align-self: center;
    line-height: 25px
}

form .first {
    font-size: 1.03em;
    margin-top: 20px;
}

form .second a {
    font-size: 1.03em;
    font-weight: 500;
    color: #006863;
}

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&family=Roboto:ital,wght@0,400;0,500;0,700;1,300&display=swap');
    </style>

</head>
<body>
    <div class="container">
        <form action="" method="post">
            <h1>Login Here</h1>
            <?php if( isset($error) ) : ?>
                <p class="error">Email / Password Salah</p>
            <?php endif; ?>    
            <input type="text" name="email" placeholder="Enter Your Email"> 
            <input type="password" name="pwd" placeholder="Enter Your Password"> 
            <button type="submit" name="login">Login</button>
            <p class="first">Don't have an account?</p>
            <p class="second"><a href="#">Sign up</a> here</p>
        </form>
    </div>
</body>
</html>