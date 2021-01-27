<?php

    $id_user = $_POST['i'];
    $date = $_POST['d'];
    $hourInitial = '00:00:00';
    $hourFinal = '23:59:59';
    
    /* Prepare date to select */ 
    $date = str_replace("/","-",$date);
    $datetimeInitial = date('Y-m-d H:i:s', strtotime("$date $hourInitial"));
    $datetimeFinal = date('Y-m-d H:i:s', strtotime("$date $hourFinal"));
    
    /* Prepare date to test if disponibile */
    /* Must to create a load from database */
    $hoursTest1 = '10:00:00';
    $hoursTest2 = '11:30:00';
    $hoursTest3 = '14:00:00';
    $hoursTest4 = '15:30:00';
    
    $datesToTest = array();

    $datetimeTest1 = date('Y-m-d H:i:s', strtotime("$date $hoursTest1"));
    $datetimeTest2 = date('Y-m-d H:i:s', strtotime("$date $hoursTest2"));
    $datetimeTest3 = date('Y-m-d H:i:s', strtotime("$date $hoursTest3"));
    $datetimeTest4 = date('Y-m-d H:i:s', strtotime("$date $hoursTest4"));

    $datesToTest[] = $datetimeTest1;
    $datesToTest[] = $datetimeTest2;
    $datesToTest[] = $datetimeTest3;
    $datesToTest[] = $datetimeTest4;
    
    require 'conection.php';
    
    try {
        $disponibility = array();
        foreach ($datesToTest as $dateTest) {
            $statement = $conn->prepare("SELECT `date` FROM `schedule` WHERE `date` = '$dateTest' AND `id_user` = '$id_user'");
            $statement->execute();
            $rows = $statement->rowCount();
        
            if($rows == 1){
                // $disponibility[] = 'Don't use =>'.$dateTest ;
            } else {
                $dateTest = new DateTime($dateTest);
                $dateTest = $dateTest->format('H:i:s');
                $disponibility[] = $dateTest;
            }
        }
        /* Send a jSon to jQuery schedule disponibility */
        echo json_encode($disponibility);
        
    } catch(PDOException $e){
        $erros = array();

        $erroMenssage = $e->getMessage();
        $errocode = $e->getCode();

        $erros[] = $erroMenssage;
        $erros[] = $errocode;

        echo json_encode($erros);
    }

    $conn = null;
?>