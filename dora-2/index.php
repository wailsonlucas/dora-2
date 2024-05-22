<?php

include_once "db/conn.php";
$_SESSION['error'] = "";

if (isset($_POST['login'])) {

    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    }
    if (isset($_POST['password'])) {
        $password = $_POST['password'];
    }

    $select = mysqli_query($conn,"SELECT * FROM `users` WHERE email='$email' AND password = '$password' ");
    if (mysqli_num_rows($select) === 1) {
        $row = mysqli_fetch_assoc($select);
        if ($row['email'] === $email && $row['password'] === $password) {
            $_SESSION['email'] = $email;
            header('location:quizz.html');die();
        }
    } else {
        $_SESSION['error'] = "Wrong email or password";
    }
}

if (isset($_POST['register'])) {

    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    }
    if (isset($_POST['password'])) {
        $password = $_POST['password'];
    }

    if (isset($_POST['name'])) {
        $name = $_POST['name'];
    }
    if (isset($_POST['university'])) {
        $university = $_POST['university'];
    }
    if (isset($_POST['gender'])) {
        $gender = $_POST['gender'];
    }
    						
    
    if (isset($_POST['year'])) {
        $year = $_POST['year'];
    }
    	
    
    


    $select = mysqli_query($conn,"INSERT INTO `users`( `name`, `email`, `password`, `gender`, `university`, `year`) VALUES ('$name','$email','$password','$gender','$university','$year')");
    if($select){
        $_SESSION['error'] = "An account has been created. Log in now";

       
    } else {
        $_SESSION['error'] = "Error while creating the account";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Modern Login Page | AsmrProg</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form method="post" action="">
                <h1>Create Account</h1>

                <span>or use your email for registeration</span>
                <input name="name" type="text" placeholder="Name" required>
                <input name="email" type="email" placeholder="Email" required>
                <input name="password" type="password" placeholder="Password" required>
              


                <select name="gender" class="form-select" required aria-label="Default select example">
                  <option selected value="" disabled>Gender</option>
                  <option value="male">male</option>
                  <option value="female">female</option>
         
                </select>

                <input name="university" type="text" placeholder="University course" required>
                <input name="year" type="text" placeholder="University Year" required>


                <button type="submit" name="register">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form method="post" action="">
                <h1>Sign In</h1>
                <?php if ($_SESSION['error'] != "") : ?>
        <div class="alert alert-danger" role="alert">
            <?= $_SESSION['error']; ?>
        </div>
    <?php endif; ?>

                <span>or use your email password</span>
                <input name="email" type="email" placeholder="Email" required>
                <input name="password" type="password" placeholder="Password" required>
                <a href="#">Forget Your Password?</a>
                <li>

                    <button type="submit" name="login">Sign Up</button>

                </li>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Friend!</h1>
                    <p>Register with your personal details to use all of site features</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
    <script>
        const container = document.getElementById('container');
        const registerBtn = document.getElementById('register');
        const loginBtn = document.getElementById('login');

        registerBtn.addEventListener('click', () => {
            container.classList.add("active");
        });

        loginBtn.addEventListener('click', () => {
            container.classList.remove("active");
        });
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
            list-style: none;
        }
        .alert {
            background-color: lightcoral;
            padding: 8px;
            border-radius: 6px;
        }

        body {
            background-color: #c9d6ff;
            background: linear-gradient(to right, #e2e2e2, #c9d6ff);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 0px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
            position: relative;
            overflow: hidden;
            width: 768px;
            max-width: 100%;
            min-height: 480px;
        }

        .container p {
            font-size: 14px;
            line-height: 20px;
            letter-spacing: 0.3px;
            margin: 20px 0;
        }

        .container span {
            font-size: 12px;
        }

        .container a {
            color: #333;
            font-size: 13px;
            text-decoration: none;
            margin: 15px 0 10px;
        }

        .container button {
            background-color: #fff;
            color: #000000;
            font-size: 12px;
            padding: 10px 45px;
            border: 1px solid #00b442;
            border-radius: 0px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-top: 10px;
            cursor: pointer;
        }

        .container button.hidden {
            background-color: transparent;
            border-color: #fff;
        }

        .container button :hover {
            background-color: #00b442;
        }

        .container form {
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            height: 100%;
        }

        .container input ,select {
            background-color: #eee;
            border: none;
            margin: 8px 0;
            padding: 10px 15px;
            font-size: 13px;
            border-radius: 0px;
            width: 100%;
            outline: none;
        }

        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }

        .sign-in {
            left: 0;
            width: 50%;
            z-index: 2;
        }

        .container.active .sign-in {
            transform: translateX(100%);
        }

        .sign-up {
            left: 0;
            width: 50%;
            opacity: 0;
            z-index: 1;
        }

        .container.active .sign-up {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: move 0.6s;
        }

        @keyframes move {

            0%,
            49.99% {
                opacity: 0;
                z-index: 1;
            }

            50%,
            100% {
                opacity: 1;
                z-index: 5;
            }
        }

        .social-icons {
            margin: 20px 0;
        }

        .social-icons a {
            border: 1px solid #ccc;
            border-radius: 0%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin: 0 3px;
            width: 40px;
            height: 40px;
        }

        .toggle-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: all 0.6s ease-in-out;
            border-radius: 0px 0 0 0px;
            z-index: 1000;
        }

        .container.active .toggle-container {
            transform: translateX(-100%);
            border-radius: 0 0px 0px 0;
        }

        .toggle {
            background-color: #512da8;
            height: 100%;
            background: linear-gradient(to right, #00b442, #174520);
            color: #fff;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: all 0.6s ease-in-out;
        }

        .container.active .toggle {
            transform: translateX(50%);
        }

        .toggle-panel {
            position: absolute;
            width: 50%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 30px;
            text-align: center;
            top: 0;
            transform: translateX(0);
            transition: all 0.6s ease-in-out;
        }

        .toggle-left {
            transform: translateX(-200%);
        }

        .container.active .toggle-left {
            transform: translateX(0);
        }

        .toggle-right {
            right: 0;
            transform: translateX(0);
        }

        .container.active .toggle-right {
            transform: translateX(200%);
        }
    </style>
</body>

</html>