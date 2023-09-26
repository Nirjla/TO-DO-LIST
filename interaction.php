<?php
session_start();
if(isset($_POST['likebtn'])){
    // $sno = $_SESSION['sno'];
    
    include_once 'connectDB.php';
    $img_name = $_POST['img'];
    var_dump($img_name);
    $sql = "UPDATE image_db SET interaction = interaction + 1 WHERE img_name=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $img_name);
    $stmt->execute();
    header("location:uploadDisplay.php");
}
?>