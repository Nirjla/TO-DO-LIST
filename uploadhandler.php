<?php
session_start();
include_once 'connectDB.php';


if (isset($_POST['upload'])) {

    $sno = $_SESSION['sno'];
    // tell the image info
    // echo '<pre>';
    $images = $_FILES['images'];
    $description = $_POST['description'];

    // // storing the image info into var
    $img_name = $images['name'];
    $tmp_name = $images['tmp_name'];
    $error = $images['error'];

if(!empty($description) && !empty($images)){
    if ($error === 0 ) {
        $img_ex = pathInfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower(($img_ex));

        $allowed_exs = array('jpg', 'jpeg', 'png');
        if (in_array($img_ex_lc, $allowed_exs)) {
            $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
            $img_upload_path = "D:/xampp/htdocs/TO-DO-LIST/uploads/" . $new_img_name;


            $sql = "INSERT INTO image_db (sno,img_name,description) VALUES (?,?,?)";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("iss", $sno, $new_img_name, $description);
                $stmt->execute();
                move_uploaded_file($tmp_name, $img_upload_path);

                header("location:uploadDisplay.php");
            }
            else {
                $em = "Error: " . $conn->error;
                header("location:uplaod.php?error=$em");
            }
        } else {
            $em = "Unknown Error Occured while uploading";
            header("location: uplaod.php?error=$em");
        }
    }

 else {
    $em = "You can't upload this kind of file";
    header("location: uplaod.php?error=$em");
}
}

else{
     $em = "All fields are required.";
     header("location:uplaod.php?error=$em");
}
}
?>


