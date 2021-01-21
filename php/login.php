<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
    <?php require_once 'header.php'; ?> 
    <div class="container ">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-5">
                <?php
                    session_start();
                    // print_r($_SESSION);
                    if (isset($_SESSION['started'])){
                        if($_SESSION['started'] == 'true'){
                            echo '<h3>Keep working '.$_SESSION['name'].'</h3>';
                            echo "<p>You are still logged in!</p>";
                        } else {
                            header("Location: ../index.php");
                        }
                    } else {  
                        /* I have to verify the POST */ 
                        // if(isset($_POST['login-email'] )){
                        //     echo 'is setted';
                        // } else {
                        //     header("Location: ../index.php");
                        // }
                    
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
                                    echo '<h3>Welcome back '.$value['name'].'</h3>';
                                    echo "<p>You are logged now!</p>";

                                    $_SESSION['started'] = 'true';
                                    $_SESSION["id"] = $value['id'];
                                    $_SESSION["name"] = $value['name'];
                                    // $_SESSION["email"] = $value['email'];
                                }
                            } else {
                                header("Location: ../index.php");
                            }
                        } catch(PDOException $e){
                            echo 'We had a problems with your registration';
                            echo '<br>';
                            echo "error".$e->getMessage();
                        }

                        $conn = null;
                    }
                ?>    
                <a class="btn btn-primary" href="my_profile.php" role="button">My profile</a>
                <a class="btn btn-primary" href="../index.php" role="button">Logout</a>
            </div>
        </div>
    </div>
</body>
</html>

