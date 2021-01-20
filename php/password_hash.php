<?php

    $password = "Joshua";
    echo $password;
    echo '<br>';
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    echo '<br>';
    var_dump($hashed_password);

    if(password_verify($password, $hashed_password )){
        echo "bravo";
    }
?>