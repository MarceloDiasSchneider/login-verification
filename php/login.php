<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Top navbar</a>
        </div>
    </nav>
    <div class="container ">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-5">
                <?php
                    require 'conection.php';

                    $email = $_POST['login-email'];
                    $password = $_POST['login-password'];
                    $salt = 'mds';
                    $cryptPassword = crypt($password, $salt);

                    
                    try {
                        $statement = $conn->prepare("SELECT * FROM `users` WHERE `email`='$email' AND `password`='$cryptPassword'");
                        $statement->execute();
                        $rows = $statement->rowCount();
                        $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
                        
                        if($rows == 1){
                            foreach ($statement->fetchAll() as $key => $value) {
                                echo '<h3>Welcome back '.$value['name'].'</h3>';
                                echo "<p>You are logged now!</p>";
                            }
                        } else {
                            header("Location: ../index.html");
                        }
                    } catch(PDOException $e){
                        echo 'We had a problems with your registration';
                        echo '<br>';
                        echo "error".$e->getMessage();
                    }
                    $conn = null;
                ?>    
                <a class="btn btn-primary" href="../index.html" role="button">Back</a>
            </div>
        </div>
    </div>
</body>
</html>

