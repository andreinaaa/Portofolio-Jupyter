<?php
    session_start();

    function daftar($request)
    {
        global $conn;

        $nama = $request['nama'];
        $email = $request['email'];
        $no_hp = $request['no_hp'];

        // echo "$nama";
        $password = mysqli_real_escape_string($conn, $request['password']);
        $confirmPassword = mysqli_real_escape_string($conn, $request['confirmPassword']);
        // $password="abc";
        // $confirmPassword="abc";
        $emailCek = "SELECT email FROM users WHERE email='$email'";
        $select = mysqli_query($conn, $emailCek);

        if (!mysqli_fetch_assoc($select)) {
            if ($password == $confirmPassword) {
                $password = password_hash($password, PASSWORD_DEFAULT);
                $query = "INSERT INTO users VALUES ('', '$nama', '$email','$password','$no_hp')";
                // echo "$query";
                mysqli_query($conn, $query);

                $_SESSION['registered'] = 'Berhasil registrasi, silahkan login.';

                header("Location: login.php");
                exit();
            }
        }

        $_SESSION['message'] = 'Email Anda sudah terdaftar!';

        header("Location: register.php");
        exit();
    }

    include_once("config.php");

    if(isset($_POST['register'])) {
        daftar($_POST);
    }
    ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In/Sign Up</title>

    <link rel="stylesheet" type="text/css" href="loginstyle.css">
</head>
<body>
    <div class="hero">
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="login()"> Login </button>
                <button type="button" class="toggle-btn" onclick="register()"> Register </button>
            </div>
            
            <form id="login" class="input-group">
                <input type="text" class="input-field" placeholder="User ID" required>
                <input type="password" class="input-field" placeholder="Password" required>
                <input type="checkbox" class="check-box"><span>Remember Password</span>
                <button type="submit" class="submit-btn"><a href="index2.html">Login</a></button> 
            </form>
            <form id="register" class="input-group">
                <input type="text" class="input-field" placeholder="User ID" required>
                <input type="email" class="input-field" placeholder="youremail@email.com" required>
                <input type="password" class="input-field" placeholder="Password" required>
                <input type="checkbox" class="check-box"><span>I agree to the terrms and conditions</span>
                <button type="submit" class="submit-btn"><a href="index2.html">Register</a></button> 
            </form>
            
            
        </div>
    </div>

    <script>
        var x = document.getElementById("login");
        var y = document.getElementById("register");
        var z = document.getElementById("btn");

        function register(){
            x.style.left = "-400px";
            y.style.left = "50px";
            z.style.left = "110px";
        }

        function login(){
            x.style.left = "50px";
            y.style.left = "450px";
            z.style.left = "0";
        }
    </script>
</body>
</html>