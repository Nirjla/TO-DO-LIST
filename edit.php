<?php
session_start();
if(isset($_GET['editid']))
{
    include_once 'connectDB.php';
    $sno = $_SESSION['sno'];
    $eid = $_GET['editid'];
    $sql = "SELECT * FROM todo where id=$eid AND sno = $sno";
    $results = mysqli_query($conn, $sql);
    if(!$results)
    {
         die('Cannot execute the query'.mysqli_connect_error());
    }
    else{
        while($row = mysqli_fetch_array($results))
        {
            ?>
               <!DOCTYPE html>
               <html lang="en">
               <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Edit</title>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
                <style>
                    body{
                        font-family: 'Lexend Deca', sans-serif;
                        background-color: #E4E4E4;
                    }
                    .form-label {
            font-size: 1rem;
            font-style: normal;
            font-weight: 279;
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
        .go-back {
            margin-top: 5px;
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
               </head>
               <body>
                <div class="container d-flex justify-content-center align-items-center vh-100">
                   <div>
                    <div class="mb-4">
                       <h1>Update your Todo</h1>
        </div>
                        <form action="update.php" method="post">
                            <div class="mb-3">
                          
                                <input type="hidden" name="id" value="<?php echo $eid;?>">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" id="title" class="form-input" value="<?php echo $row['title'];?>">
                            </div>
                            <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-input" cols="30" rows="10" ><?php echo $row['description'];?>
                        </textarea>
                            </div>
                            <div class="mb-3">
                                <input type="submit" value="Update" name="submit">
                            </div>
                        </form>
                        <div class="go-back">
            <a href="home.php"><i class="bi bi-arrow-left"></i></a>
                        </div>
                        </div>
                </div>
                      
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
               </body>
               </html>



            <?php
            
            
            
        }
    }
}

?>
