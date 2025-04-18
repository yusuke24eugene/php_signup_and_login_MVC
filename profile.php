<?php
include_once 'includes/config.inc.php';
include_once 'includes/dbh.inc.php';
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="styles/profile-style.css" rel="stylesheet">
    <link rel="icon" href="images/s_logo.jpg">
</head>
<body>
    <div class="wrapper">
        <div class="photo-box">
            <?php
                $id = $_SESSION["user_id"];
                $query = "SELECT * FROM user_info WHERE id = :id;";
        
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(":id", $id);
                $stmt->execute();        

                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $profilePhoto = $result["profile_img"];
                $firstname = $result["first_name"];
                $lastname = $result["last_name"];
                $username = $result["username"];
                $gender = ucfirst($result["gender"]);
                $bdate = $result["birth_date"];
                $email = $result["email"];
                $num = $result["mobile_number"];

                if($profilePhoto !== NULL){
                    echo '<img class="photo" src="uploads/'.$profilePhoto.'" alt="profile photo">';
                }
                
                list($width, $height) = getimagesize("uploads/".$profilePhoto);
                if($width >= $height){
                    echo '<style>.photo{height:144px;width:auto}</style>';
                }
            ?>
        </div>
        <form class="submit-form" action="includes/updatephoto.inc.php" method="post" enctype="multipart/form-data">
            <input type="file" name="file" id="file" onchange="document.querySelector('#submit').click();">
            <input type="submit" name="submit" id="submit">
        </form>
        <input type="button" value="Upload photo" name="upload" id="upload" onclick="document.querySelector('#file').click();">
        <?php
            echo '<h1 class="name">'.$firstname. ' ' . $lastname. '</h1>';
            echo '<p class="name">Username: ' . $username . '</p>';
            echo '<p class="name">Gender: ' . $gender . '</p>';
            echo '<p class="name">Birth-date: ' . $bdate . '</p>';
            echo '<p class="name">E-mail: ' . $email . '</p>';
            echo '<p class="name">Mobile number: ' . $num . '</p>';
            $pdo = null;
            $stmt = null;
        ?>
        <form class="form" method="post" action="edit.php">
            <input type="submit" value="EDIT" name="editbtn" id="editbtn">
        </form>
    </div>
    <form class="form" method="post" action="includes/logout.inc.php">
        <input type="submit" value="LOGOUT" name="logoutbtn" id="logoutbtn">
    </form>
</body>
</html>