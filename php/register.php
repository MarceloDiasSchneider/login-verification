<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register user</title>
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

                    $name = $_POST['register-name'];
                    $email = $_POST['register-email'];
                    $password = $_POST['register-password'];
                    $salt = 'mds';
                    $cryptPassword = crypt($password, $salt);

                    // echo $cryptPassword;

                    try {
                        $statement = $conn->prepare("INSERT INTO `login`.`users` (`name`, `email`, `password`) VALUES ('$name', '$email', '$cryptPassword')");
                        $statement->execute();
                        
                        $result = $statement->setFetchMode(PDO::FETCH_ASSOC);

                        echo "<h3>Welcome</h3>";
                        echo "<p>You are registered successfully</p>";
                    } catch(PDOException $e){
                        if($e->getCode() == '23000'){
                            echo '<p>This email is already registered</p>';
                        }else {
                            echo 'We had a problems with your registration: Error code'.$e->getCode();
                            // echo "error".$e->getMessage();
                        }
                    }
                    $conn = null;
                ?>
                <a class="btn btn-primary" href="../index.html" role="button">Back</a>
            </div>
        </div>
    </div>
    

    
</body>
</html>

