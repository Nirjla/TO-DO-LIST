<?php
session_start();
if(isset($_GET['deleteid']))
{
    include_once 'connectDB.php';
    $sno = $_SESSION['sno'];
    $eid = $_GET['deleteid'];
    
    $sql = "DELETE FROM todo where id='$eid' and sno='$sno'";
    $results = mysqli_query($conn, $sql);
    if($results){
        header('location:home.php');
    }
}

?>