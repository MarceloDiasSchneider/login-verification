<?php

session_start();
require 'conection.php';

$schedules = array();
try{
    $statement = $conn->prepare("SELECT `datetimeStart`, `datetimeEnd`,`title`, `description` FROM `schedule` WHERE id_user =".$_SESSION['id']." ORDER BY `datetimeStart`");
    $statement->execute();
    $rows = $statement->rowCount();
    $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
    if($rows > 0){
        foreach ($statement->fetchAll() as $key => $value) {
            $schedules[] = $value;
        }
        echo json_encode($schedules);
    } else {
        /* create a return if there isnt any schedule*/
    }
} catch(PDOException $e){
    echo 'We had a problems to conect with database: Error code'.$e->getCode();
    echo $e->getMessage();
}
?>