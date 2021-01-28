<?php
try{
    $statement = $conn->prepare("SELECT `datetimeStart`, `datetimeEnd`,`description` FROM `schedule` WHERE id_user =".$_SESSION['id']." ORDER BY `datetimeStart`");
    $statement->execute();
    $rows = $statement->rowCount();
    if($rows > 0){
        echo "<h3>My schedules</h3>";
        foreach ($statement->fetchAll() as $key => $value) {
            $dateStart = new DateTime($value['datetimeStart']);
            $dateStart = $dateStart->format('d/m/Y H:i:s');
            $dateEnd = new DateTime($value['datetimeEnd']);
            $dateEnd = $dateEnd->format('d/m/Y H:i:s');
            echo "  <div class='form-group'>
                        <div class='input-group mb-3'>
                            <span class='input-group-text'>
                                ".$dateStart." ".$dateEnd." ".$value['description']."
                            </span> 
                        </div>    
                    </div>";
        }
    }
} catch(PDOException $e){
    echo 'We had a problems to conect with database: Error code'.$e->getCode();
    echo $e->getMessage();
}
?>