<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calendar</title>
  <link rel="stylesheet" href="../css/schedule_calendar.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
  <?php
    require_once 'session_verify.php';
    require_once 'header.php';
  ?>
  <div id="container" class="container-fluid">
    <header>
      <div class="row d-sm-flex p-1 bg-dark text-white">
        <div class="col-md-12 justify-content-center align-item-center">
          <h4 id="titleCurrentMonth" class="text-center mb-1"></h4>
        </div>
      </div>
      <div class="row bg-dark text-white justify-content-center align-item-center">
        <div class="col-md-12 justify-content-center align-item-center">
          <button id="newTask" class="btn btn-primary col-md-2 mb-1 ">New task </button><!--
          --><button class="btn bg-dark d-none d-sm-inline-block col-md-1 mb-1" disabled></button><!--
          --><button id="previousMonth" class="btn btn-primary col-md-2 mb-1"></button><!--
          --><button class="btn bg-dark d-none d-sm-inline-block col-md-1 mb-1" disabled></button><!--
          --><button id="currentMonth" class="btn btn-primary col-md-2 mb-1">Today</button><!--
          --><button class="btn bg-dark d-none d-sm-inline-block col-md-1 mb-1" disabled></button><!--
          --><button id="nextMonth" class="btn btn-primary col-md-2 mb-1"></button>
        </div>
      </div>
      
      <div class="row d-none d-sm-flex p-1 bg-dark text-white">
        <h5 class="col-sm p-1 text-center">Sunday</h5>
        <h5 class="col-sm p-1 text-center">Monday</h5>
        <h5 class="col-sm p-1 text-center">Tuesday</h5>
        <h5 class="col-sm p-1 text-center">Wednesday</h5>
        <h5 class="col-sm p-1 text-center">Thursday</h5>
        <h5 class="col-sm p-1 text-center">Friday</h5>
        <h5 class="col-sm p-1 text-center">Saturday</h5>
      </div>
    </header>
    <div id="calendarBody" class="row border border-right-2 border-bottom-2">
    
    </div>
  </div>
</body>
<script src="../javascript/schedule_calendar.js"></script>
</html>