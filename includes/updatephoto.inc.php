<?php
include_once 'config.inc.php';
include_once 'dbh.inc.php';

if (isset($_POST['submit'])){

    $id = $_SESSION["user_id"];
    $query = "SELECT * FROM user_info WHERE id = :id;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $profile = $result["username"];

    $file = $_FILES['file'];

    $filename = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $filename);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if(in_array($fileActualExt, $allowed)){
        if($fileError === 0){
            if($fileSize < 500000){
                $fileNameNew = $profile.uniqid('', true).".".$fileActualExt;
                $fileDestination = '../uploads/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);

                $query = "SELECT profile_img FROM user_info WHERE id = :id;";

                $stmt = $pdo->prepare($query);
                $stmt->bindParam(":id", $id);
                $stmt->execute();

                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $profile_img = $result["profile_img"];
                $file_img = "../uploads/".$profile_img;
                unlink($file_img);

                $query = "UPDATE user_info SET profile_img = :img  WHERE id = :id;";

                $stmt = $pdo->prepare($query);
                $stmt->bindParam(":id", $id);
                $stmt->bindParam(":img", $fileNameNew);
                $stmt->execute();

                header("Location: ../profile.php?uploadsuccess");
            }
            else{
                echo "Your file is too big!";
            }
        }
        else{
            echo "There was an error uploading your file!";
        }
    }
    else{
        echo "You can't upload file of this type!";
    }

    $pdo = null;
    $stmt = null;
}

die();