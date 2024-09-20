<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Icons-->
    <link rel="stylesheet" href="css/all.min.css">
    <!-- <script src="https://kit.fontawesome.com/ec0debbca9.js" crossorigin="anonymous"></script> -->
    <title>Change Password</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
            color: #000;
        }
        .container {
            /* width: 100%;
            max-width: 500px;
            margin: 0 auto; */
            width: 100%;
            max-width: 450px;
            background-color: #3391E7;
            border-radius: 5px;
            padding: 60px;
            margin: 90px auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
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
        /* input[type="password"] {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    outline: none;
    background-color: #fff;
    color: #333;
} */

button[type="submit"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #000;
    border-radius: 5px;
    background-color: #000;
    color: #fff;
    font-size: 18px;
    cursor: pointer;
    margin-top: 20px;
}

button[type="submit"]:hover {
    background-color: #fff;
    color: #000;
}
.tooltip {
    position: relative;
    display: inline-block;
    width: 100%;
    text-align: center;
}

.tooltip .tooltiptext {
    visibility: hidden;
    width: 100%;
    background-color: #000;
    color: #fff;
    text-align: center;
    padding: 5px 0;
    border-radius: 6px;
    position: absolute;
    z-index: 1;
    top: 100%;
    left: 50%;
    transform: translateX(-50%);
    margin-top: 5px;
}

.tooltip:hover .tooltiptext {
    visibility: visible;
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
<?php session_start(); ?>
<div class="container">
        <h1>Change Password</h1>
        <form action="process_change_password.php" method="POST">

            <label for="current_password">Username:</label>
                <div class="input-wrapper">
                    <input type="email" name="email" autocomplete="username" required="" id="email">
                </div>

            <label for="current_password">Current Password:</label>
            <div class="input-wrapper">
                <input type="password" name="current_password" autocomplete="current-password" required="" id="current_password">
                <i class="far fa-eye" id="toggle_current_password" style="margin-left: -30px; cursor: pointer;" onclick="togglePasswordVisibility('current_password', 'toggle_current_password')"></i>
            </div>

            <label for="new_password">New Password:</label>
            <div class="input-wrapper">
                <input type="password" name="new_password" autocomplete="new-password" required="" id="new_password">
                <i class="far fa-eye" id="toggle_new_password" style="margin-left: -30px; cursor: pointer;" onclick="togglePasswordVisibility('new_password', 'toggle_new_password')"></i>
            </div>

            <label for="confirm_password">Confirm New Password:</label>
            <div class="input-wrapper">
                <input type="password" name="confirm_password" autocomplete="new-password" required="" id="confirm_password">
                <i class="far fa-eye" id="toggle_confirm_password" style="margin-left: -30px; cursor: pointer;" onclick="togglePasswordVisibility('confirm_password', 'toggle_confirm_password')"></i>
            </div>
            <br>

            <?php if (isset($_SESSION['error_message'])): ?>
                <div style="color: red; text-align: center; margin-bottom: 20px;">
                    <?php echo $_SESSION['error_message']; ?>
                </div>
                <?php unset($_SESSION['error_message']); ?>
            <?php endif; ?>


            <div class="tooltip">
                <button type="submit">Change Password</button>
                <span class="tooltiptext">Please be sure to remember the password</span>
            </div>
        </form>
    </div>
</body>
</html>