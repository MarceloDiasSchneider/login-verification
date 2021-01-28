<?php
    /* info to conect to database LOCALHOST*/
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "login";
    
    /* info to conect to database ONLINE*/
    // $servername = "107.180.25.194";
    // $username = "MarceloSchneider";
    // $password = "pfekr3sJ22VjzH8";
    // $dbname = "login";

    /* test of conection with database */
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>