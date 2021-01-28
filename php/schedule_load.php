<?php

session_start();
require 'conection.php';

$schedules = array();
try{
    $statement = $conn->prepare("SELECT `datetimeStart`, `datetimeEnd`,`description` FROM `schedule` WHERE id_user =".$_SESSION['id']." ORDER BY `datetimeStart`");
    $statement->execute();
    $rows = $statement->rowCount();
    $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
    if($rows > 0){
        foreach ($statement->fetchAll() as $key => $value) {
            $schedules[] = $value;
        }
        echo json_encode($schedules);
    }
} catch(PDOException $e){
    echo 'We had a problems to conect with database: Error code'.$e->getCode();
    echo $e->getMessage();
}
?>