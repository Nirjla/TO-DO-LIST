<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once 'connectDB.php';
    
    // $sno = $_SESSION['sno'];
    $sno = $_SESSION['sno'];
    $title = $_POST['title'];
    $description = $_POST['description'];
        
    // Insert the new todo item into the database using prepared statements
    $stmt = $conn->prepare("INSERT INTO todo (sno, title, description) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $sno, $title, $description);
    if ($stmt->execute()) {
        // The query was successful
    } else {
        // The query failed
        die("Cannot connect to database: " . $conn->error);
    }
}
// session_destroy();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
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

        .content {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            /* padding: 10px 10px 10px 30px; */
            margin: 30px 10px 50px 10px;
            /* height: 100vh; */
            /* color: #4D4D4D; */

        }


        .task,
        .create {
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            width: 300px;
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

        .task-manager {
            /* align-self: flex-end; */
            display: flex;
            /* justify-content: end; */
            /* align-content: flex-end;  */
            justify-content: center;
            align-items: center;
        }

        .intro {
            margin-bottom: 10px;

        }

        

        table thead {
            border-bottom: 3px solid #A4A4A4;
            /* background: #F6F6F6; */


        }

        /* .add {
            display: flex;
            margin-top: 10px;
            width: 100px;
            height: 35px;

            background: #19535F;
            border-radius: 0.3rem
        } */

        label.icon {
            height: 100%;
            width: 35px;
            line-height: 35px;
            text-align: left!important;
            /* display:  */

        }

         /* i.bi-plus-lg {
            color: black;
            background: #FFFFFF;

             font-size: 1.2rem;
            text-align: center;
        }  */

        /* i.bi-trash3{
            color: black;
            font-size: 1.2rem;
        } */

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

        .custom-table {
            border:none;
        }
        label.icon{
            display: inline-flex;
        }

        label.icon i.bi-trash, .bi-pencil-square {
            height: 100%;
            width: 35px;
            line-height: 40px;
            text-align: center;


        }

        i.bi-trash, .bi-pencil-square {
            color: #212529;
            /* background: #FFFFFF; */

            font-size: 1.2rem;
            text-align: center;
        }

    
    </style>
</head>

<body>

    <nav>
        <ul>
            <li class="logo">TO DO</li>
            <div class="items">
                <li><a href="#" class="active">Home</a></li>
                <li><a href="uplaod.php" >What's on your mind</a></li>
            </div>
            <li class="search-icon">
                <input type="search" placeholder="Search ">
                <label class="icon">
                    <i class="bi bi-search"></i>
                </label>
            </li>
        </ul>
    </nav>
    <div class="content">
        <div class="intro">
            <h1>What's up,</h1>
        </div>
        <div class="create">
            <h2>Create a To Do</h2>
        </div>
        <div class="task">
            <form action="home.php" method="post">

                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-input">
                <label for="" class="form-label" name="description">Description</label>
                <textarea name="description" id="" cols="30" rows="10" class="form-input"></textarea>
                <div class="mt-2">
                    <input type="submit" name="submit" value="Add">
                    <!-- <label for="" class="icon"><i class="bi bi-plus-lg"></i></label> -->

                </div>
            </form>
        </div>
    </div>
    <div class="task-manager">
        <table class="table mx-5 table-borderless">
            <thead>
                <tr>
                    <th scope="col "class="col-2 text-center">#</th>
                    <th scope="col " class="col-3 text-center">Title</th>
                    <th scope="col " class="col-5 text-center">Description</th>
                    <th scope="col " class="col-2 text-center">Action</th>
                    
                </tr>
            </thead>
            <?php

            include_once 'connectDB.php';

            $sql = 'SELECT * FROM todo';
            $results = mysqli_query($conn, $sql);
            if (!$results) {
                die('Cannot connect to database' . mysqli_connect_error());
            }
            $uid = 0;
            while ($row = mysqli_fetch_array($results)) {

                echo ' <tbody class="table-group-divider custom-table ">
               <tr> ';
                echo '<th scope="row" class="text-center">' . ($uid+1). '</th>';
                echo '<td class="text-center"> ' . $row["title"] . '</td>';
                echo '<td class="text-left">' . $row["description"] . '</td>';

                $uid++;
            ?>

                <td class="text-center">
                    <label for="" class="icon">
                        <a href="edit.php?editid=<?php echo htmlentities($row['id']); ?>">
                        <i class="bi bi-pencil-square">
                        </i>
                        </a>
                    </label>
                
            
                    <label for="" class="icon">
                        <a href="delete.php?deleteid=<?php echo htmlentities($row['id']); ?>">
                        <!-- <i class="bi bi-trash3">
                        </i> -->
                        <i class="bi bi-trash"></i>
                        
                        </a>
                    </label>
                </td>
                <?php
                    echo '</tr>';
                    echo  '</tbody>';
                }
                    ?> 
                    </table>
    </div>









    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>

</html>
