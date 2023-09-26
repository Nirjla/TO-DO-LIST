<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Lexend Deca', sans-serif;
        }

        body {
            background-color: #E4E4E4;
        }

        .container {
            width: 60%;
            margin: 30px auto;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(225px, 1fr));
            grid-gap: 25px;
        }

        .cards {
            background-color: white;
            box-shadow: 0px 4px 8px 0px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            /* justify-content: space-between; */
            /* height: 400px; */
        }

        .image-section {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 300px;
        }

        /* .content.desc{
            height: 150px;
        } */
        .cards .img-one {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .content {
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.8rem;
            height: 60px;

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

        .info {
            display: flex;
            justify-content: center;
            align-items: center;

            background: #E4E4E4;
            height: 40px;
            padding: 15px;

        }

        i.bi-heart-fill {
            /* color:#0d1e2b ; */
            color: #19535F;
            margin-right: auto;
            font-size: 1.2rem;


        }

        button {
            border: none;
            background: #E4E4E4;
        }

        button:hover i.bi-heart-fill {
            color: red;
        }
    </style>
</head>

<body>
    <div class="go-back">
        <a href="uplaod.php"><i class="bi bi-arrow-left"></i></a>

    </div>
    <div class="container">

        <?php
        session_start();
        include_once 'connectDB.php';

        $sno = $_SESSION['sno'];
        $sql = "SELECT id,img_name, description, interaction FROM image_db ORDER BY id DESC";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
        ?>
            <div class="cards">
                <div class="image-section">
                    <img src="uploads/<?= $row['img_name'] ?>" alt="" class="img-one">
                </div>
                <div class="content desc">

                    <?php echo $row['description']; ?>

                </div>
                <div class="info">
                    <form action="interaction.php" method="post">
                        <input type="hidden" name="img" value="<?php echo htmlentities($row['img_name']) ?>">
                        <button type="submit" name="likebtn">
                            <i class="bi bi-heart-fill"> </i>
                            <span>
                                <?php echo $row['interaction']; ?>
                                hearts </span>
                        </button>
                    </form>
                </div>

            </div>
        <?php
        }
        ?>

    </div>
</body>

</html>