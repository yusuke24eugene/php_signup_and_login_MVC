<?php
    require_once 'includes/config.inc.php';
    include_once 'includes/dbh.inc.php';
    require_once 'includes/edit_view.inc.php';

    $id = $_SESSION["user_id"];
    $query = "SELECT * FROM user_info WHERE id = :id;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();        

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $firstname = $result["first_name"];
    $lastname = $result["last_name"];
    $bdate = $result["birth_date"];
    $gender = $result["gender"];
    $num = $result["mobile_number"];
    $email = $result["email"];
    $pwd = $result["pwd"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDIT PROFILE</title>
    <link href="styles/edit-style.css" rel="stylesheet">
    <link rel="icon" href="images/s_logo.jpg">
</head>
<body>
    <div class="container">
        <h1 class="login">EDIT PROFILE</h1>
            <form action="includes/edit.inc.php" class="form" method="post">
                <?php
                    echo '<input type="text" name="firstname" id="firstname" placeholder="First Name" size="25" maxlength="25" value="'. $firstname.'">';
                    echo '<input type="text" name="lastname" id="lastname" placeholder="Last Name" size="25" maxlength="25" value="'. $lastname.'">';
                    echo '<div class="bdate">
                        <label for="birth" class="blabel">Birth date:</label>
                        <input type="date" name="birth" id="birth" value="'.$bdate.'">
                    </div>
                    <div class="gender">
                        <span class="genlabel">Gender:</span>';
                        if($gender === 'male'){echo '<input type="radio" name="gender" id="male" value="male" checked>';}
                        else{echo '<input type="radio" name="gender" id="male" value="male">';}
                        echo '<label for="male" class="malelabel">Male</label>';
                        if($gender === 'female'){echo'<input type="radio" name="gender" id="female" value="female" checked>';}
                        else{echo '<input type="radio" name="gender" id="female" value="female">';}
                        echo '<label for="female" class="femalelabel">Female</label>';
                        if($gender !== 'male' && $gender !== 'female'){echo '<input type="radio" name="gender" value="others" checked>';}
                        else{echo '<input type="radio" name="gender" value="others">';}
                        echo '<label for="others" class="otherslabel">others</label>
                    </div>';
                    echo '<input type="tel" name="num" id="num" placeholder="Mobile number" size="25" value="'.$num.'">';
                    echo '<input type="text" name="email" id="email" placeholder="Email address" size="25" value="'.$email.'">';
                    echo '<input type="password" name="password" id="password" placeholder="Password" size="25" maxlength="25">';
                ?>
                <button  id="signup">SUBMIT</button>
                <?php
                    check_edit_errors();
                    $pdo = null;
                    $stmt = null;
                    die();
                ?>
            </form>
    </div>
</body>
</html>