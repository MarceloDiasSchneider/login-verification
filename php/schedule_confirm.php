<?php

    /* Get values from POST */ 
    $id = $_POST['id'];
    $date = $_POST['date'];
    $time = $_POST['hour'];
    $description = $_POST['description'];
    
    /* prepare the date to insert */
    $date = str_replace("/","-",$date);
    $datetimeStart = date('Y-m-d H:i:s', strtotime("$date $time"));
    $datetimeEnd = date('Y-m-d H:i:s', strtotime("$date $time"));
    
    require 'conection.php';
    
    try {
        $statement = $conn->prepare("INSERT INTO `schedule` (`id_user`, `datetimeStart`, `datetimeEnd`, `description`) VALUES ($id, '$datetimeStart', '$datetimeEnd', '$description')");
        $statement->execute();
        
        header("Location: schedule.php");
        
    } catch(PDOException $e){
        if($e->getCode() == 23000 ){
            echo "This date is already used! ";
        } else {
            echo 'We had a problems: Error code'.$e->getCode();
            echo $e->getMessage();
        }
    }

    $conn = null;

?>