<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="author" content="Louis Tran, Alex Ala-Kantti Ayman Nasir">
    <meta charset="UTF-8">
    <title>Register - Task Manager</title>
    <link rel="stylesheet" type="text/css" href="css/style.css"> <!-- CSS for styling -->
    <script src="js/register.js"></script>
</head>

<!--
Created a registration form with action="register.php"
Included id="registerForm" for JS validation
Provided matching name="" attributes for PHP to use
Linked back to login page


PHP : handle form in register.php, check for existing users, and insert into DB
JavaScript : validate passwords (match, required)
CSS : style the form and fieldset-->


<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="tasks.php">Task List</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="login.html">Login</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Register</h1>


        
        <!-- Registration Form -->
        <!--PHP to register and store -->
        <!--Javascript to handle Form Validation-->
        <!-- Registration Form -->
        <form id="registerForm" action="register_usr.php" method="POST">

            <fieldset>
                <legend>Create an Account</legend>

                <!-- User ID Input -->
                <label for="userid">User ID:</label>
                <input type="text" name="userid" id="userid" required>

                <!-- Password Input -->
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>

                <!-- Confirm Password Input -->
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" name="confirm_password" id="confirm_password" required>

                <!-- Register & Back to Login Buttons -->
                <div class="button-container">
                    <button type="submit" name="register">Register</button>
                    <a href="login.html"><button type="button">Back to Login</button></a>
                </div>
            </fieldset>
        </form>
    </main>

    <footer>
        <p>&copy; 2025 Task Manager. All Rights Reserved.</p>
    </footer>
</body>
</html>