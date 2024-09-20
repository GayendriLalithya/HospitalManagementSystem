<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Icons-->
    <script src="https://kit.fontawesome.com/ec0debbca9.js" crossorigin="anonymous"></script>
    <title>Registration Form</title>
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
            width: 100%;
            max-width: 500px;
            /* margin: 0 auto; */
            background-color: #3391E7;
            border-radius: 10px;
            padding: 30px;
            /* width: 350px; */
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

        input{
            border: 1px solid #3391E7;
            border-radius: 5px;
            padding: 8px 4px 12px 4px;
            font-size: 16px;
            outline: none;
            width: 98%;
        }

        h1{
            color: #000;
            text-align: center;
            margin-bottom: 20px;
        }


        input, select {
            margin-top: 5px;
            padding: 5px;
            font-size: 1rem;
        }
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
        <h1>Registration Form</h1>
        <form action="register.php" method="POST">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required>

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required>

            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone" required>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>

            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>

            <label for="user_type">User Type:</label>
            <select id="user_type" name="user_type" required>
                <option value="Doctor">Doctor</option>
                <option value="Patient">Patient</option>
                <!-- <option value="Admin">Admin</option> -->
                <option value="Nurse">Nurse</option>
                <option value="Receptionist">Receptionist</option>
            </select>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <div class="input-wrapper">
                <input type="password" name="password" autocomplete="password" required="" id="password">
                <i class="far fa-eye" id="toggle_password" style="margin-left: -30px; cursor: pointer;" onclick="togglePasswordVisibility('password', 'toggle_password')"></i>
            </div>

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
