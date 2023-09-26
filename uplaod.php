<?php
    session_start();
    include_once 'connectDB.php';
    $sno = $_SESSION['sno'];
    
//     $sql = "SELECT * FROM loginuser";
// $result = $conn->query($sql);
// if ($result) {
//     while($row = $result->fetch_assoc()) {
//         $_SESSION['sno'] = $row['sno'];
//         echo $_SESSION['sno'];
         
//     }
// } else {
//     echo "Error: " . $conn->error;
// }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    </head>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Lexend Deca', sans-serif;
            /* font-family: 'Space Grotesk', sans-serif; */
        }

        body {
            background-color: #E4E4E4;
            height: 100vh;

        }

        nav {

            background: #19535F;
            padding: 10px 40px 10px 70px;


        }

        nav ul {
            display: flex;
            flex-wrap: wrap;
            list-style: none;
            justify-content: center;
            align-items: center;
            margin-bottom: 0;
            padding-left: 0;


        }

        nav ul .logo {
            flex: 1;
            font-size: 1.5rem;
            font-weight: 700;
            color: #FFFFFF;
        }

        nav ul div.items {
            display: inline-flex;
            padding: 0 25px;
            /* color: #FFFFFF; */
        }

        div.items li a {
            text-decoration: none;
            font-size: 0.9rem;
            padding: 0 12px;
            color: #FFFFFF;

            /* white-space: pre-wrap;
  word-wrap: break-word; */


        }

        div.items li a:hover {
            color: #0D1E2B;

        }
        nav ul li a.active,
nav ul li a:active {
    color: #0D1E2B;
}

        nav ul .search-icon {
            height: 40px;
            display: flex;
            width: 250px;

            border-radius: 0.3rem;
            background-color: #FFFFFF;




        }

        nav ul .search-icon input {
            border: none;
            height: 100%;
            width: 215px;
            outline: none;
            padding: 0 10px;
            font-family: 'Lexend Deca', sans-serif;
            font-weight: lighter;
            font-size: 0.8rem;
            border-radius: 0.3rem 0 0 0.3rem;

        }

        label.icon i.bi-search{
            height: 100%;
            width: 35px;
            line-height: 40px;
            text-align: center;


        }

        i.bi-search {
            color: #4D4D4D !important;
            /* background: #FFFFFF; */

            font-size: 1.1rem;
            text-align: center;
        }
        
        /* container */
        .main-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            /* padding: 10px 10px 10px 30px; */
            margin: 30px 10px 50px 10px;
            /* height: 100vh; */
            /* color: #4D4D4D; */

        }


        .container {
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            width: 300px;
        }
        .intro {
            margin-bottom: 10px;

        }

        .form-label {
            font-size: 1rem;
            font-style: normal;
            font-weight: 279;
            margin-top: 10px;
        }

        .form-input {
            border-radius: 0.2rem;
            border-style: none;
            width: 100%;
            height: 35px;
            font-family: 'Lexend Deca', sans-serif;
            font-weight: lighter;
            font-size: 0.8rem;

            padding: 5px;
            /* text-align: left; */
            /* font-family: 'Space Grotesk', sans-serif; */

            /* position: relative; */

        }
        .form-element {
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            width: 300px;
        }


        
        input[type='submit'] {
            width: 100%;
            /* height:100%; */
            border: none;
            height: 35px;
            /* background:#0D1E2B; */
            background: #19535F;
            padding: 0 10px;
            font-family: 'Lexend Deca', sans-serif;
            /* font-weight: lighter; */
            /* font-size: 0.8rem; */
            border-radius: 0.3rem;

        }
        .upload-box{
            background:  white;
            border-radius: 0.3rem;
            width:100%;
            height: 35px;
            outline:none;
            font-size:0.8rem ;
        }

        ::-webkit-file-upload-button{
            background: #19535F;
            border: none;
            height: 35px;
            padding: 0 10px ;
            border-radius:0 0.3rem  0.3rem 0;


        }
        .go-back {
            margin-top: 5px;
             display: flex;
            justify-content: center;
         align-items: center;  

        }

        i.bi-arrow-right {
            /* color:#0d1e2b ; */
            color: #353F46 !important;
            font-size: 1.75rem;
        }





</style>
<body>


    <nav>
        <ul>
            <li class="logo">TO DO</li>
            <div class="items">
                <li><a href="home.php">Home</a></li>
                <li><a href="uplaod.php" class="active">What's on your mind</a></li>
            </div>
            <li class="search-icon">
                <input type="search" placeholder="Search ">
                <label class="icon">
                    <i class="bi bi-search"></i>
                </label>
            </li>
        </ul>
    </nav>
    <div class="main-container">
        <div class="intro">
            <h1>Share your thoughts and creations. </h1>
        </div>
       
        <div class="form-element">

    <form action="uploadhandler.php" method="post" enctype="multipart/form-data">
       

    <label for="image" class="form-label">Upload your creations</label>
        <!-- <input type="text" name="sno" id="" value="<?php echo htmlentities($_SESSION['sno'])?>" class="form-input"> -->
        <!-- <input type="text" name="id" value="<?php echo htmlentities($id)?>"> -->
        <input type="file" class="upload-box" name="images"  >
             
        
        
                <label for="description" class="form-label text-left">Description</label>
                <textarea name="description" id="description" cols="30" rows="10" class="form-input" placeholder="max 150 characters" maxlength="150"></textarea>

                <div class="mt-2">
                <input type="submit" name=upload value=Upload></input>
                </div>
                <?php
                if(isset($_GET["error"])){ ?>
                    <div class="alert alert-danger mt-3" role="alert">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
                <?php }?>
                <div class="go-back">
            <a href="uploadDisplay.php"><i class="bi bi-arrow-right"></i></a>
                
    </form>
</div>
</div>
</body>
</html>