<?php
session_start();

$showUsernameError = false;
$showPwError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once 'connectDB.php';

    $username = mysqli_real_escape_string($conn, $_POST['login-username']);
    $password = mysqli_real_escape_string($conn, $_POST['login-password']);

    $stmt = $conn->prepare("SELECT * FROM loginuser WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if (password_verify($password, $row['password'])) {
                $_SESSION['sno'] = $row['sno'];
                header("location: home.php");
                exit();
            } else {
                $showPwError = true;
            }
        }
    } else {
        $showUsernameError = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lexend+Deca&family=Space+Grotesk:wght@700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            color: #353F46;
            font-family: 'Lexend Deca', sans-serif;
            font-family: 'Space Grotesk', sans-serif;
           

        }

        body {
            display: flex;
            justify-content: center;
            height: 100vh;
            align-items: center;
            background-color: #19535F;
            padding: 10px;
        }

        .container {
            background-color: #D9D9D9;
            width: 100%;
            max-width: 425px;
            border-radius: 0.5rem;
            padding: 25px 30px;

        }

        .container .title {
            font-size: 28px;
            font-style: normal;
            font-weight: 900;
            text-align: center;
            margin-bottom: 10px;
            /* padding-bottom: 25px; */
           

        }

        .user-details,
        .form-label {
            font-size: 1rem;
            font-style: normal;
            font-weight: 279;
        }

        .user-details .form-input {
            border-radius: 0.2rem;
            border-style: none;
            width: 100%;
            height: 35px;
            padding: 5px;

        }

        input[type='submit'] {
            margin: 3px 0;
            height: 35px;
            width: 100%;
            background: #0B7A75;
            text-decoration: none;
            border-style: none;
            border-radius: 0.5rem;
            font-style: normal;
            font-weight: 700;
            margin: 25px 0 10px 0px;
            color: #0d1e2b !important;
        }

        .register {
            margin-top: 10px;
            text-align: center;

        }

        .register a {
            color: #353F46;
        }

        a:hover {
            color: #0B7A75;
        }
    </style>
</head>

<body>
<?php
    if ($showUsernameError)
    {
      echo '<script> alert("Sorry wrong username.") </script>';  
    }
    if($showPwError)
    {
        echo '<script> alert("Sorry wrong password.") </script>';  
    }
    
    
    ?>
   
    <div class="container">
        <div class="title"> Login </div>
        
        <div class="user-details">
            <form action="" method="post">
                <div class="mb-3">
                
                    <label for="login-username" class="form-label">Username</label>
                    <input type="text" id="login-username" name="login-username" class="form-input">
                </div>
                <div class="mb-3">
                    <label for="login-password" class="form-label">Password</label>
                    <input type="password" id="login-password" name="login-password" class="form-input">
                </div>
        </div>
        <div class="button">
            <input type="submit" value="Sign in"></input>
        </div>
        </form>
        <div class="register">
            <p>Dont have an account? <a href="register.php">Sign Up</a></p>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>

</html>



