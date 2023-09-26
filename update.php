<?php
session_start();
if(isset($_POST['submit']))
{
    include_once 'connectDB.php';
    $sno = $_SESSION['sno'];
    
    $eid = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $sql = "UPDATE todo SET title = '$title', description = '$description' where id = $eid and sno = $sno";
    // echo $sql;
    // echo '$sql';
    $results = mysqli_query($conn,$sql);
    if($results){
        header("location: home.php");
    }
    else{
          
          die("Cannot execute the query".mysqli_connect_error());
    }
    
}

?>
