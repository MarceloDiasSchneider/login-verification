<?php

    $date = $_POST['d'];

    // $jsonobj = '{"Peter":35,"Ben":37,"Joe":43}';
    // json_decode($jsonobj);
 

    $disponibility = array();
    $item0 = array("0"=>'10:00:00');
    $item1 = array("0"=>'11:30:00');
    $item2 = array("0"=>'14:00:00');
    $item3 = array("0"=>'15:30:00');

    $disponibility[] = $item0;
    $disponibility[] = $item1;
    $disponibility[] = $item2;
    $disponibility[] = $item3;

    echo json_encode($disponibility);

    // echo "<option value='1'>10:00</option>";
    // echo "<option value='2'>11:30</option>";
    // echo "<option value='3'>14:00</option>";
    // echo "<option value='4'>15:30</option>";

?>