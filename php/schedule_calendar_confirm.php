<?php

    /* Get values from POST */ 
    $id = $_POST['id'];
    $dateStart = $_POST['ds'];
    $hourStart = $_POST['hs'];
    $dateEnd = $_POST['de'];
    $hourEnd = $_POST['he'];
    $title = $_POST['t'];
    $description = $_POST['d'];
    
    /* prepare the date to insert */
    $dateStart = str_replace("/","-",$dateStart);
    $datetimeStart = date('Y-m-d H:i:s', strtotime("$dateStart $hourStart"));
    $dateEnd = str_replace("/","-",$dateEnd);
    $datetimeEnd = date('Y-m-d H:i:s', strtotime("$dateEnd $hourEnd"));
    
    require 'conection.php';
    
    try {
        $statement = $conn->prepare("INSERT INTO `schedule` (`id_user`, `datetimeStart`, `datetimeEnd`, `title`,`description`) VALUES ($id, '$datetimeStart', '$datetimeEnd', '$title', '$description')");
        $statement->execute();
        
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