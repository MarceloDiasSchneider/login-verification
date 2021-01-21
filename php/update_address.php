<?php
    $id = $_POST['i'];
    $country = $_POST['co'];
    $region = $_POST['re'];
    $city = $_POST['ci'];
    $postcode = $_POST['po'];
    $address1 = $_POST['a1'];
    $address2 = $_POST['a2'];

    require 'conection.php';
    try {
     
        $statement = $conn->prepare("SELECT id_user FROM `address` WHERE id_user = $id");
        $statement->execute();
        $rows = $statement->rowCount();
        
        if($rows == 1){
            $statement = $conn->prepare("UPDATE `login`.`address` 
            SET `country` = '$country', `region` = '$region', `city` = '$city', `postcode` = '$postcode', `address1` = '$address1', `address2` = '$address2' 
            WHERE `id` = $id");
            $statement->execute();
        } else {
            $statement = $conn->prepare("INSERT INTO `login`.`address` (`id_user`, `country`, `region`, `city`, `postcode`, `address1`, `address2`) VALUES ('$id', '$country', '$region', '$city', '$postcode', '$address1', '$address2');");
            $statement->execute();
        }
        echo "<small>Update successful</small>";
        
    } catch(PDOException $e){
        echo 'We had a problems with your registration: Error code'.$e->getCode();
        echo $e->getMessage();
    }
    $conn = null;
?>
