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
            $date_registration = $value['date_registred'];
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
        $date_registration = new DateTime($date_registration);
        $date_registration = $date_registration->format('d/m/Y H:i:s');

    ?>
    <div class="container ">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-5">
                <?php 
                    echo $msg1;
                    echo $msg2;
                ?>
                <h2>Personal information</h2>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <span class="input-group-text">
                            <?php echo "Date of registrition: $date_registration" ?>
                        </span>
                    </div>
                </div>
                <form id="update_personal_information" action="update_personal_information.php" method="POST">
                    <input id='id' type="number" value="<?php echo $_SESSION['id'] ?>" style="display: none">
                    <div class="form-group">
                        <div class="input-group mb-3">
                        <span class="input-group-text">Full name</span>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Full name" pattern="[A-z ]{5,25}" title="Minimum 5 characters, letters only" maxlength="25" value="<?php echo $name ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                        <span class="input-group-text">Email address</span>
                            <input type="email" class="form-control" id="email" name="email" placeholder="exemplo@gmail.com" maxlength="60" value="<?php echo $email ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Cell phone</span>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="+39 999 999 9999" pattern="[0-9 +]{10,16}" title="Type your phone" maxlength="16" value="<?php echo $phone ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Codice fiscale</span>
                            <input type="text" class="form-control" id="codice-fiscale" name="codice-fiscale" placeholder="codice-fiscale" pattern="[A-Z]{6}\d{2}[A-Z]\d{2}[A-Z]\d{3}[A-Z]" title="Type your codice fiscale" maxlength="25" value="<?php echo $codice_fiscale ?>" required>
                        </div>
                    </div>
                    <div id='personal-information-message' class="" role="alert"></div>
                    <div class="form-group">
                        <div class="input-group mb-5">
                            <input type="submit" class="btn btn-primary" value="Update">
                        </div>
                    </div>
                </form>
            </div>    
        </div>    
    </div>
    <div class="container ">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-5">
                <h2>Change password</h2>
                <form id="update_password" action="update_password.php" method="POST">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Last password</span>
                            <input type="password" class="form-control" id="last-password" name="last-password" placeholder="Last password" pattern="[A-z0-9]{5,20}" title="Minimum 5 characters, letters and numbers only" maxlength="20" required>
                        </div> 
                    </div> 
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text">New password</span>
                            <input type="password" class="form-control" id="new-password" name="new-password" placeholder="New password" pattern="[A-z0-9]{5,20}" title="Minimum 5 characters, letters and numbers only" maxlength="20" maxlength="25" required>
                        </div> 
                    </div> 
                    <div class="form-group">
                        <div class="input-group mb-1">
                            <span class="input-group-text">Repeat new password</span>
                            <input type="password" class="form-control" id="repeat-new-password" name="repeat-new-password" placeholder="Repet new assword" pattern="[A-z0-9]{5,20}" title="Minimum 5 characters, letters and numbers only" maxlength="20" maxlength="25" required>
                        </div> 
                        <div class="input-group mb-3">
                            <small id="alert" class="form-text text-muted">We'll never share your password with anyone else.</small>
                        </div> 
                    </div>
                    <div id='password-message' class="" role="alert"></div>
                    <div class="form-group">
                        <div class="input-group mb-5">
                            <input type="submit" class="btn btn-primary" value="Update">
                        </div>
                    </div>
                </form>
            </div> 
        </div> 
    </div> 
    <div class="container ">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-5">
                <h2>Address</h2>
                <form id="update_adderss" action="update_address.php" method="POST">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Country</span>
                            <input type="text" class="form-control" id="country" name="country" placeholder="Country" pattern="[A-z ]{3,60}" title="Minimum 3 characters, letters only" maxlength="60" value="<?php echo $country; ?>" required>
                        </div> 
                    </div> 
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Region</span>
                            <input type="text" class="form-control" id="region" name="region" placeholder="Region" pattern="[A-z ]{3,60}" title="Minimum 3 characters, letters only" maxlength="60" value="<?php echo $region; ?>" required>
                        </div> 
                    </div> 
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text">City</span>
                            <input type="text" class="form-control" id="city" name="city" placeholder="City" pattern="[A-z ]{3,60}" title="Minimum 3 characters, letters only" maxlength="60" value="<?php echo $city; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Postcode</span>
                            <input type="text" class="form-control" id="postcode" name="postcode" placeholder="Postcode" pattern="[0-9]{5}" title="Must have 5 characters, numbers only" maxlength="5" value="<?php echo $postcode; ?>" required>
                        </div> 
                    </div> 
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Address line 1</span>
                            <input type="text" class="form-control" id="address1" name="address1" placeholder="Address line 1" pattern="[A-z0-9 ]{5,100}" title="Minimum 5 characters, letters and numbers only" maxlength="100" value="<?php echo $address1; ?>" required>
                        </div> 
                    </div> 
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Address line 2</span>
                            <input type="text" class="form-control" id="address2" name="address2" placeholder="Address line 2" pattern="[A-z0-9 ]{5,100}" title="Minimum 5 characters, letters and numbers only" maxlength="100" value="<?php echo $address2; ?>" required>
                        </div> 
                    </div> 
                    <div id='address-message' class="" role="alert"></div>
                    <div class="form-group">
                        <div class="input-group mb-5">
                            <input type="submit" class="btn btn-primary" value="Update">
                        </div> 
                    </div> 
                </form>
            </div>  
        </div>
    </div>   
</body>
<script src="../javascript/update_personal_information.js"></script>
<script src="../javascript/update_password.js"></script>
<script src="../javascript/update_address.js"></script>
</html>

