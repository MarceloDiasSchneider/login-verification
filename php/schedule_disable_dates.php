<?php

    $id_user = $_POST['id'];
    $initial = $_POST['i'];
    $final = $_POST['f'];
    
    $initial = date("Y-m-d H:i:s", strtotime($initial.' 00:00:00'));
    $final = date("Y-m-t H:i:s", strtotime($final.' 23:59:59'));

    $dates = array();
    // $dates[] = $initial;
    // $dates[] = $final;
    // echo json_encode($dates);
 
    require 'conection.php';

    try {
        $statement = $conn->prepare("SELECT DISTINCT DATE(`datetimeStart`) as `date` FROM `schedule` 
        WHERE `id_user` = $id_user 
        AND `datetimeStart` BETWEEN '$initial' AND '$final'");
        
        $statement->execute();
        $rows = $statement->rowCount();
        $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
        if($rows > 0){
            /* Verify all dates thas have schedule */
            foreach ($statement->fetchAll() as $key => $value) {
                $statement = $conn->prepare("SELECT DATE(`datetimeStart`) as `date`, COUNT(`datetimeStart`) as `quantity` FROM `schedule` 
                WHERE `id_user` = $id_user
                AND `datetimeStart` LIKE '".$value['date']."%'");
                
                $statement->execute();
                $rows = $statement->rowCount();
                $result = $statement->setFetchMode(PDO::FETCH_ASSOC);

                if($rows > 0){
                    /* Verify if the date has disponibility */
                    foreach($statement->fetchAll() as $key => $value){
                        if($value['quantity'] >= 4){
                            /* date formatting to use on jQuery datepicker */
                            $date = date_create($value['date']);
                            $date = date_format($date,"d/m/Y");
                            $value['date'] = $date;
                            $dates[] = $value;
                        }                            
                    }
                }
            }
            echo json_encode($dates);
        }
    } catch(PDOException $e){
        echo 'We had a problems: Error code'.$e->getCode();
        echo $e->getMessage();
    }    
    
    // try {
    //     $statement = $conn->prepare("SELECT DISTINCT DATE(`date`) as `date` FROM `schedule` 
    //     WHERE `id_user` = $id_user 
    //     AND `date` BETWEEN '$initial' AND '$final'");
        
    //     $statement->execute();
    //     $rows = $statement->rowCount();
    //     $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
    //     if($rows > 0){
    //             foreach ($statement->fetchAll() as $key => $value) {
    //                 /* date formatting to use on jQuery datepicker */
    //                 $date = date_create($value['date']);
    //                 $date = date_format($date,"d/m/Y");
    //                 $value['date'] = $date;
    //                 $dates[] = $value;
    //             }
    //             echo json_encode($dates);
    //     }
    // } catch(PDOException $e){
    //     echo 'We had a problems: Error code'.$e->getCode();
    //     echo $e->getMessage();
    // }

    $conn = null;
?>