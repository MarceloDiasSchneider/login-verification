<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="../css/sytle.css">
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
                    echo $msg1;
                    echo $msg2;
                    
                    require 'conection.php';

                    $statement = $conn->prepare("SELECT `date`,`description` FROM `schedule` WHERE id_user =".$_SESSION['id']);
                    $statement->execute();
                    $rows = $statement->rowCount();
                    if($rows > 0){
                        echo "<p>My schedules</p>";
                        foreach ($statement->fetchAll() as $key => $value) {
                            echo "<p>".$value['date']." ".$value['description']."</p>";
                        }
                    }

                    $conn = null;
                ?>
                <form id="schedule" action="disponibility.php" method="POST">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input type="text" id="date">
                            <button type="submit" id="date_search" >Search</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Disponibility</span>
                            <select id="select_hours_available" name='hours_available' class="form-select" required>
                                <optgroup label='Hours available'>
                                    <option value='' hidden selected></option>
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
                    <div class="input-group mb-5">
                        <input type="submit" class="btn btn-primary" value="Confirm">
                    </div> 
                </from>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="../javascript/schedule.js"></script>
</body>
</html>

