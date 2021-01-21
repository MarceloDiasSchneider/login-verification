<?php
    $id = $_POST['i'];
    $name = $_POST['n'];
    $email = $_POST['e'];
    $phone = $_POST['p'];
    $codice_fiscale = $_POST['c'];

    require 'conection.php';
    try {
        
        $statement = $conn->prepare("UPDATE `login`.`users` SET `name`='$name', `email`='$email' WHERE `id`= 1;");
        $statement->execute();
        
        $statement = $conn->prepare("SELECT id_user FROM `phone` WHERE id_user = $id");
        $statement->execute();
        $rows = $statement->rowCount();

        if($rows == 1){
            $statement = $conn->prepare("UPDATE `login`.`phone` 
            SET `phone`='$phone'
            WHERE `id`=$id");
            $statement->execute();
        } else {
            $statement = $conn->prepare("INSERT INTO `login`.`phone` (id_user, phone) VALUES ($id, '$phone')");
            $statement->execute();
        }

        $statement = $conn->prepare("SELECT id_user FROM `codice_fiscale` WHERE id_user = $id");
        $statement->execute();
        $rows = $statement->rowCount();

        if($rows == 1){
            $statement = $conn->prepare("UPDATE `login`.`codice_fiscale` 
            SET `codice_fiscale`='$codice_fiscale'
            WHERE `id`=$id");
            $statement->execute();
        } else {
            $statement = $conn->prepare("INSERT INTO `login`.`codice_fiscale` (id_user, codice_fiscale) VALUES ($id, '$codice_fiscale')");
            $statement->execute();
        }
        echo "<small>Update successful</small>";
        
        // $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
        // foreach ($statement->fetchAll() as $key => $value) {
        //     echo $value[''];
        // }
    } catch(PDOException $e){
        echo 'We had a problems with your registration: Error code'.$e->getCode();
        echo $e->getMessage();
    }
    $conn = null;

?>
