<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Toolbar nave</a>
        </div>
    </nav>
</header>
<?php 
    session_start();

    $emailValue ='';
    $passwordValue ='';
    $emailMessage = '';
    $passwordMessage = '';

    if(isset($_SESSION['email'])){
        $emailValue = $_SESSION['email'];
    } 

    if(isset($_SESSION['password'])){
        $passwordValue = $_SESSION['password'];
    } 

    if(isset($_SESSION['emailError'])){
        $emailMessage = "
        <div class='form-group'>
            <div class='input-group  mb-3'>
                <div id='personal-information-message' class='alert alert-danger' role='alert'>
                    <small>".$_SESSION['emailError']."</small>'
                </div>
            </div>
        </div>";
    }     

    if(isset($_SESSION['passwordError'])){
        $passwordMessage = "
        <div class='form-group'>
            <div class='input-group  mb-3'>
                <div id='personal-information-message' class='alert alert-danger' role='alert'>
                    <small>".$_SESSION['passwordError']."</small>'
                </div>
            </div>
        </div>";
    } 

?>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-5">
                <h3>Login</h3>
                <form action="php/session_authentication.php" method="POST">
                    <div class="form-group">
                        <div class="input-group mb-3">
                        <span class="input-group-text">Email</span>
                            <input type="email" class="form-control" id="login-email" name="login-email" aria-describedby="alert" placeholder="exemplo@gmail.com" maxlength="60" value="<?php echo $emailValue ?>" required>
                        </div>
                    </div>
                        <?php echo $emailMessage; ?>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Password</span>
                            <input type="password" class="form-control" id="login-password" name="login-password" placeholder="Password" pattern="[A-z0-9]{5,20}" title="From 5 to 20 characters only letter and numbers" maxlength="20" value="<?php echo $passwordValue; ?>" required>
                        </div> 
                    </div> 
                    <?php echo $passwordMessage; ?>
                    <div class="form-group">
                        <div class="input-group mb-5 ">
                            <input type="submit" class="btn btn-primary" value="Login">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container ">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-5">
                <h3>Register</h3>
                <form action="php/register.php" method="POST">
                <div class="form-group">
                    <div class="input-group mb-3">
                    <span class="input-group-text">Full name</span>
                        <input type="text" class="form-control" id="register-name" name="register-name" aria-describedby="alert" placeholder="Full name" pattern="[A-z ]{5,25}" title="From 5 to 25 characters only letter" maxlength="25" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group mb-3">
                    <span class="input-group-text">Email address</span>
                        <input type="email" class="form-control" id="register-email" name="register-email" aria-describedby="alert" placeholder="exemplo@gmail.com" maxlength="60" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group mb-1">
                    <span class="input-group-text">Password</span>
                        <input type="password" class="form-control" id="register-password" name="register-password" placeholder="Password" pattern="[A-z0-9]{5,20}" title="From 5 to 20 characters only letter and numbers" maxlength="20" required>
                    </div> 
                    <div class="input-group mb-3">
                        <small id="alert" class="form-text text-muted">We'll never share your password with anyone else.</small>
                    </div> 
                </div> 
                <div class="form-group">
                    <div class="input-group mb-3">
                        <input type="submit" class="btn btn-primary" value="Register">
                    </div> 
                </div> 
            </form>
        </div>
    </div>
</div>
<?php session_unset(); ?>
</body>
</html>