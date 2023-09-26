<?php

session_start();
$errorMessage = '';
$showSuccesMessage = false;
include_once 'connectDB.php';
if (isset($_POST['submit'])) {


    // $sno = $_POST["sno"];
    // $sno = $_SESSION['sno'];
    $firstname = trim($_POST["firstname"]);
    $lastname = trim($_POST["lastname"]);
    $email = trim($_POST["register-email"]);
    $npassword  = trim($_POST["new-password"]);
    $cpassword = trim($_POST["confirm-password"]);

    if (empty($firstname) || empty($lastname) || empty($email) || empty($npassword) || empty($cpassword)) {
        $errorMessage = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = 'Invalid email address.';
    } elseif (strlen($npassword) < 8) {
        $errorMessage = 'Password must be atleast 8 characters long';
    } elseif (($npassword !== $cpassword)) {
        $errorMessage = 'Passwords do not match.';
    } else {
        $username = $firstname.' '.$lastname;
        $stmt = $conn->prepare("SELECT * FROM loginuser WHERE email=? OR username=?");
        $stmt->bind_param("ss", $email, $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $errorMessage = "Account already exists.";
        } else {

            $username = $firstname.' '.$lastname;
            
            $hashedPassword = password_hash($npassword,PASSWORD_DEFAULT);
            
            $stmt = $conn->prepare("INSERT INTO loginuser ( username, password , email) VALUES
        (?,?,?)");
            $stmt->bind_param("sss", $username, $hashedPassword, $email);
            if ($stmt->execute()) {
                   // Get the sno value for the new user
            $sno = $conn->insert_id;

            // Set the sno value in the session variable
            $_SESSION['sno'] = $sno;
                header("location: home.php");
                $showSuccesMessage = true;
            } else {
                $errorMessage = 'Something went wrong. Please try again later';
            }
        }
    }
}







?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
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
            /* position: relative; */
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

        .user-details .form-label {
            font-size: 1rem;
            font-style: normal;
            font-weight: 279;
        }

        .user-details .form-input {
            border-radius: 0.2rem;
            border-style: none;
            width: 100%;
            height: 35px;
            font-family: 'Lexend Deca', sans-serif;
            font-weight: lighter;
            font-size: 0.8rem;

            padding: 5px;
            /* font-family: 'Space Grotesk', sans-serif; */

            /* position: relative; */

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
            margin: 25px 0 10px 0;
            color: #0d1e2b !important;
        }

        .input-box {
            display: flex;
            align-items: center;
            justify-content: space-between;

            /* column-gap: 15px; */

        }

        .column {
            flex-basis: 48%;

        }

        .go-back {
            display: flex;
            justify-content: center;
            align-items: center;

        }

        i.bi-arrow-left {
            /* color:#0d1e2b ; */
            color: #353F46 !important;
            font-size: 1.75rem;
        }
    </style>

<body>


    <div class="container">
        <div class="title">Register</div>
        <div class="user-details">
            <form action="" method="post">
                <div class="input-box mb-3">
                    <div class="column">

                        <label for="firstname" class="form-label"></label>
                        
                        <input type="text" id="firstname" name="firstname" class="form-input " placeholder="Firstname">
                    </div>
                    <div class="column">
                        <label for="lastname" class="form-label"></label>
                        <input type="text" id="lastname" name="lastname" class="form-input" placeholder="Lastname">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="register-email" class="form-label"></label>
                    <input type="email" id="register-email" name="register-email" class="form-input" placeholder="Email">
                </div>
                <div class="mb-3">
                    <label for="new-password" class="form-label"></label>
                    <input type="password" id="new-password" name="new-password" class="form-input" placeholder="Password">
                </div>
                <div class="mb-3">
                    <label for="confirm-password" class="form-label"></label>
                    <input type="password" id="confirm-password" name="confirm-password" class="form-input" placeholder="Confirm Password">
                </div>
        </div>

        <div class="button">
            <input type="submit" name="submit" value="Submit">
            </input>
        </div>
        <div class="go-back">
            <a href="login.php"><i class="bi bi-arrow-left"></i></a>

        </div>

        <?php if (!empty($errorMessage)) { ?>
            <div class="alert alert-danger mt-3" role="alert">
                <?php echo $errorMessage; ?>
            </div>
        <?php } ?>
        </form>


    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

</body>

</html>