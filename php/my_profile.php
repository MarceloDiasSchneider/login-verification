<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <?php 
        require_once 'session_verify.php';
        
        require_once 'header.php'; 
        print_r($_SESSION);
        
        require 'conection.php';
        $statement = $conn->prepare("SELECT * FROM users
        LEFT JOIN phone
        ON users.id = phone.id_user
        LEFT JOIN codice_fiscale
        ON users.id = codice_fiscale.id_user
        LEFT JOIN address
        ON users.id = address.id_user
        WHERE users.id = ".$_SESSION['id']);
        $statement->execute();
        $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
        foreach ($statement->fetchAll() as $key => $value) {
            $name = $value['name'];
            $email = $value['email'];
            $phone = $value['phone'];
            $codice_fiscale = $value['codice_fiscale'];
            $country = $value['country'];
            $region = $value['region'];
            $city = $value['city'];
            $postcode = $value['postcode'];
            $address1 = $value['address1'];
            $address2 = $value['address2'];
        }
    ?>
    <div class="container ">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-5">
                <?php 
                    echo $msg1;
                    echo $msg2;
                ?>
                <a class="btn btn-primary" href="login.php" role="button">Menu</a>
                <a class="btn btn-primary" href="close_session.php" role="button">Logout</a>
                <h2>Personal information</h2>
                <form id='test' action="update_personal_information.php" method="POST">
                    <input id='id' type="number" value="<?php echo $_SESSION['id'] ?>" style="display: none">
                    <div class="form-group">
                        <label for="Name">Full name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Full name" maxlength="25" value="<?php echo $name ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="exemplo@gmail.com" maxlength="60" value="<?php echo $email ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Cell phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="+39 999 999 9999" maxlength="20" value="<?php echo $phone ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="codice-fiscale">Codice fiscale</label>
                        <input type="text" class="form-control" id="codice-fiscale" name="codice-fiscale" placeholder="codice-fiscale" maxlength="16" value="<?php echo $codice_fiscale ?>" required>
                    </div>
                    <div id='personal-information-message' class="" role="alert"></div>
                    <input type="submit" id="personal-information" class="btn btn-primary" value="Update">
                </form>
                
                <h2>Change password</h2>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="last-password">Last password</label>
                        <input type="password" class="form-control" id="last-password" name="last-password" placeholder="Last password" maxlength="25" required>
                    </div> 
                    <div class="form-group">
                        <label for="new-password">New password</label>
                        <input type="password" class="form-control" id="new-password" name="new-password" placeholder="New password" maxlength="25" required>
                    </div> 
                    <div class="form-group">
                        <label for="repeat-new-password">Repet new assword</label>
                        <input type="password" class="form-control" id="repeat-new-password" name="repeat-new-password" placeholder="Repet new assword" maxlength="25" required>
                        <small id="alert" class="form-text text-muted">We'll never share your password with anyone else.</small>
                    </div> 
                    <div id='password-message' class="" role="alert"></div>
                    <button type="button" id="password" class="btn btn-primary">Update</button>
                </form>

                <h2>Address</h2>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="country">Country</label>
                        <input type="text" class="form-control" id="country" name="country" placeholder="Country" maxlength="60" value="<?php echo $country; ?>" required>
                    </div> 
                    <div class="form-group">
                        <label for="region">Region</label>
                        <input type="text" class="form-control" id="region" name="region" placeholder="Region" maxlength="60" value="<?php echo $region; ?>" required>
                    </div> 
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="City" maxlength="60" value="<?php echo $city; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="postcode">Postcode</label>
                        <input type="text" class="form-control" id="postcode" name="postcode" placeholder="Postcode" maxlength="10" value="<?php echo $postcode; ?>" required>
                    </div> 
                    <div class="form-group">
                        <label for="address1">Address line 1</label>
                        <input type="text" class="form-control" id="address1" name="address1" placeholder="Address line 1" maxlength="100" value="<?php echo $address1; ?>" required>
                    </div> 
                    <div class="form-group">
                        <label for="address2">Address line 2</label>
                        <input type="text" class="form-control" id="address2" name="address2" placeholder="Address line 2" maxlength="100" value="<?php echo $address2; ?>" required>
                    </div> 
                    <div id='address-message' class="" role="alert"></div>
                    <button type="button" id="address" class="btn btn-primary">Update</button>
                </form>
            </div>  
        </div>
    </div>   
</body>
<script src="../javascript/update_personal_information.js"></script>
<script src="../javascript/update_password.js"></script>
<script src="../javascript/update_address.js"></script>
</html>

