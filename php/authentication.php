<?php
    session_start();
    // if (isset($_SESSION['started'])){
    //     if($_SESSION['started'] == 'true'){
    //         echo '<h3>Keep working '.$_SESSION['name'].'</h3>';
    //         echo "<p>You are still logged in!</p>";
    //     } else {
    //         header("Location: ../index.php");
    //     }
    // } else {  

    
        $email = $_POST['login-email'];
        $password = $_POST['login-password'];
        $salt = 'mds';
        $cryptPassword = crypt($password, $salt);
        
        require 'conection.php';
        
        try {
            $statement = $conn->prepare("SELECT * FROM `users` WHERE `email`='$email' AND `password`='$cryptPassword'");
            $statement->execute();
            $rows = $statement->rowCount();
            $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
            
            if($rows == 1){
                foreach ($statement->fetchAll() as $key => $value) {
                    // echo '<h3>Welcome back '.$value['name'].'</h3>';
                    // echo "<p>You are logged now!</p>";
                    $_SESSION['started'] = 'true';
                    $_SESSION["id"] = $value['id'];
                    $_SESSION["name"] = $value['name'];
                    // $_SESSION["email"] = $value['email'];
                    header("Location: menu.php");
                }
            } else {
                header("Location: ../index.php");
            }
        } catch(PDOException $e){
            echo 'We had a problems with your registration';
            echo "error".$e->getMessage();
        }
        $conn = null;
    // }
?>    