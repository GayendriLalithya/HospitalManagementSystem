<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Icons-->
    <link rel="stylesheet" href="css/all.min.css">
    <!-- <script src="https://kit.fontawesome.com/ec0debbca9.js" crossorigin="anonymous"></script> -->
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            /* width: 100%;
            max-width: 500px;
            margin: 0 auto; */
            background-color: #3391E7;
            border-radius: 10px;
            padding: 30px;
            width: 350px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
            border: 2px solid;
        }
        form {
            display: flex;
            flex-direction: column;
            margin-top: 20px;
        }
        label {
            margin-top: 10px;
            
        }
        input {
            margin-top: 5px;
            padding: 5px;
            font-size: 1rem;
            border: 1px solid #3391E7;
            border-radius: 5px;
            padding: 8px 4px 12px 4px;
            outline: none;
            width: 100%;
        }
        /* button {
            margin-top: 20px;
            padding: 10px;
            font-size: 1rem;
            cursor: pointer;
        } */

        button {
            width: 100%;
            padding: 10px;
            background-color: #000;
            color: #fff;
            font-size: 18px;
            border: 1px solid #000;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 20px;
        }

        button:hover {
            background-color: #fff;
            color: #000;
        }
        

        h1{
            color: #000;
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            text-align: center;
            font-size: 14px;
        }

        a {
            color: #3391E7;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .url{
            color: #02203b;
        }
    </style>
    <script>
        function togglePasswordVisibility(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form action="process_login.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <div class="input-wrapper">
                <input type="password" name="password" autocomplete="password" required="" id="password">
                <i class="far fa-eye" id="toggle_password" style="margin-left: -30px; cursor: pointer;" onclick="togglePasswordVisibility('password', 'toggle_password')"></i>
            </div>

            <?php
        session_start();
        if (isset($_SESSION['error_message'])) {
            echo '<p style="color: red;">' . $_SESSION['error_message'] . '</p>';
            unset($_SESSION['error_message']);
        }
        ?>

            <button type="submit">Login</button>
            <p>Not registered yet? <a href="registration.php" target="_blank" class="url">Register Here</a></p>
        </form>
    </div>
</body>
</html>
