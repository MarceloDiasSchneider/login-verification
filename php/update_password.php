<?php
    $id = $_POST['i'];
    $last_password = $_POST['l'];
    $new_password = $_POST['n'];
    $repeat_new_password = $_POST['r'];
        
    $salt = 'mds';
    $cryptLastPassword = crypt($last_password, $salt);

    require 'conection.php';
    try {

        $statement = $conn->prepare("SELECT `password` FROM `login`.`users` WHERE `id` = ".$id);
        $statement->execute();
        $rows = $statement->rowCount();
        $result = $statement->setFetchMode(PDO::FETCH_ASSOC);

        if($rows == 1){
            foreach ($statement->fetchAll() as $key => $value) {
                if($value['password'] == $cryptLastPassword){
                    if($new_password == $repeat_new_password){
                        $cryptNewPassword = crypt($new_password, $salt);
                        $statement = $conn->prepare("UPDATE `login`.`users` 
                        SET `password`='$cryptNewPassword'
                        WHERE `id`=$id");
                        $statement->execute();
                        echo '<small>Your password was changed</small>';
                    } else {
                        echo '<small>The new password does not match</small>';
                    }
                } else {
                    echo '<small>Your last password is wrong</small>';
                }
            }

        } 
    } catch(PDOException $e){
        echo 'We had a problems with your registration: Error code'.$e->getCode();
        echo $e->getMessage();
    }
    $conn = null;
?>
