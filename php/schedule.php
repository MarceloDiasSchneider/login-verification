<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>
<body>
    <?php 
        require_once 'session_verify.php';

        require_once 'header.php';
        
    ?> 
    <div class="container ">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-5">
                <?php 
                    /* Show salutation from session verify */
                    echo $msg1;
                    echo $msg2;
                    
                    /* Load all previus schedules */
                    require 'conection.php';
                      
                    try{
                        $statement = $conn->prepare("SELECT `date`,`description` FROM `schedule` WHERE id_user =".$_SESSION['id']." ORDER BY `date`");
                        $statement->execute();
                        $rows = $statement->rowCount();
                        if($rows > 0){
                            echo "<h3>My schedules</h3>";
                            foreach ($statement->fetchAll() as $key => $value) {
                                $date = new DateTime($value['date']);
                                $date = $date->format('d/m/Y H:i:s');
                                echo "  <div class='form-group'>
                                            <div class='input-group mb-3'>
                                                <span class='input-group-text'>
                                                    ".$date." ".$value['description']."
                                                </span> 
                                            </div>    
                                        </div>";
                            }
                        }
                    } catch(PDOException $e){
                        echo 'We had a problems to conect with database: Error code'.$e->getCode();
                        echo $e->getMessage();
                    }
                    
                    $conn = null;
                ?>
                
                <h3>Create new schedules</h3>
                <form id="schedule" action="schedule_confirm.php" method="POST">
                    <input id="id" name="id" type="number" value="<?php echo $_SESSION['id'] ?>" style="display: none">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Date</span>
                            <input type="text" id="date" name="date" class="form-control" autocomplete="off" required>
                            <button type="button" id="date_search" name="date_search" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Disponibility</span>
                            <select id="hour" name='hour' class="form-control form-select" required>
                                <optgroup label='Hours available'>
                                    <!-- <option value='' hidden selected></option> -->
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Description</span>
                            <input type="text" class="form-control" id="description" name="description" placeholder="Description" pattern="[A-z0-9 ]{5,100}" title="Minimum 5 characters, letters and numbers only" maxlength="100" value="" required>
                        </div> 
                    </div> 
                    <div class="input-group mb-5 flex-row-reverse">
                        <input type="submit" class="btn btn-primary" value="Confirm">
                    </div> 
                </from>
            </div>
        </div>
    </div>

    <script src="../javascript/schedule_datepicker.js"></script>
    <script src="../javascript/schedule_disponibility.js"></script>
    <script src="../javascript/schedule_confirm.js"></script>
</body>
</html>

