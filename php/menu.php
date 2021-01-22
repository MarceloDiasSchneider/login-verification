<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
    <?php 
        require_once 'session_verify.php';

        require_once 'header.php';
        print_r($_SESSION);
        
    ?> 
    <div class="container ">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-5">
                <?php 
                    echo $msg1;
                    echo $msg2;
                ?>
                <a class="btn btn-primary" href="my_profile.php" role="button">My profile</a>
                <a class="btn btn-primary" href="close_session.php" role="button">Logout</a>
            </div>
        </div>
    </div>
</body>
</html>

