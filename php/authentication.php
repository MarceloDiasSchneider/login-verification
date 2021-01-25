<?php
    session_start();
    session_unset();
        $email = $_POST['login-email'];
        $password = $_POST['login-password'];
        $salt = 'mds';
        $cryptPassword = crypt($password, $salt);
        require 'conection.php';

        
        try {
            $statement = $conn->prepare("SELECT * FROM `users` WHERE `email`='$email'");
            $statement->execute();
            $rows = $statement->rowCount();
            $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
            
            if($rows == 1){
                $statement = $conn->prepare("SELECT * FROM `users` WHERE `email`='$email' AND `password`='$cryptPassword'");
                $statement->execute();
                $rows = $statement->rowCount();
                $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
                if($rows == 1){
                    foreach ($statement->fetchAll() as $key => $value) {
                        $_SESSION['started'] = 'true';
                        $_SESSION["id"] = $value['id'];
                        $_SESSION["name"] = $value['name'];
                        header("Location: menu.php");
                    }
                } else {
                    $_SESSION["email"] = $email;
                    $_SESSION["passwordError"] = "The password daesn't match with email!";
                    header("Location: ../index.php");
                    echo $_SESSION['password'].'1oi';
                }
            } else {
                $_SESSION["email"] = $email;
                $_SESSION["emailError"] = "This email is not registred!";
                header("Location: ../index.php");
            }
        } catch(PDOException $e){
            echo 'We had a problems with your login';
            echo "error".$e->getMessage();
        }
        $conn = null;
?>    