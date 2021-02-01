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
  <div id="container" class="container-fluid col-md-8 mx-auto">
    <header>
      <div class="row d-sm-flex p-1 bg-dark text-white">
        <div class="col-md-12 justify-content-center align-item-center">
          <h4 id="titleCurrentMonth" class="text-center mb-1"></h4>
        </div>
      </div>
      <div class="row bg-dark text-white justify-content-center align-item-center">
        <div class="col-md-12">
          <button type="button" class="btn btn-primary col-md-2 mb-1" data-bs-toggle="modal" data-bs-target="#createSchedule">New task</button>
          <!-- <button class="btn bg-dark d-none d-sm-inline-block col-md-1 mb-1" disabled></button> -->
          <button type="button" id="previousMonth" class="btn btn-primary col-md-2 mb-1"></button>
          <!-- <button class="btn bg-dark d-none d-sm-inline-block col-md-1 mb-1" disabled></button> -->
          <button type="button" id="currentMonth" class="btn btn-primary col-md-2 mb-1">Today</button>
          <!-- <button class="btn bg-dark d-none d-sm-inline-block col-md-1 mb-1" disabled></button> -->
          <button type="button" id="nextMonth" class="btn btn-primary col-md-2 mb-1"></button>
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
  <!-- Modal to create a schedule -->
  <div class="modal fade" id="createSchedule" tabindex="-1" aria-labelledby="createScheduleLabel"aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h5 class="modal-title" id="createScheduleLabel">Creating a new task</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <form id="schedule" action="schedule_calendar_confirm.php" method="POST">
            <!-- user id -->
            <input id="id" name="id" type="number" value="<?php echo $_SESSION['id'] ?>" style="display: none">
            <!-- schedule day start -->
            <div class="form-group">
                <div class="input-group mb-3">
                    <span class="input-group-text">Date start</span>
                    <input type="date" id="dateStart" name="dateStart" class="form-control" required>
                </div>
            </div>
            <!-- schedule hour start -->
            <div class="form-group">
                <div class="input-group mb-3">
                    <span class="input-group-text">Hour start</span>
                    <input type="time" id="hourStart" name="hourStart" class="form-control" required>
                </div>
            </div>
            <!-- schedule day end -->
            <div class="form-group">
                <div class="input-group mb-3">
                    <span class="input-group-text">Date end</span>
                    <input type="date" id="dateEnd" name="dateEnd" class="form-control" autocomplete="off" required>
                </div>
            </div>
            <!-- schedule hour end -->
            <div class="form-group">
                <div class="input-group mb-3">
                    <span class="input-group-text">Hour end</span>
                    <input type="time" id="hourEnd" name="hourEnd" class="form-control" required>
                </div>
            </div>
            <!-- schedule title -->
            <div class="form-group">
                <div class="input-group mb-3">
                    <span class="input-group-text">Title</span>
                    <input type="text" id="title" name="title" class="form-control" placeholder="Title" pattern="[A-z0-9 ]{5,100}" title="Minimum 5 characters, letters and numbers only" maxlength="100" required>
                </div> 
            </div> 
            <!-- Description -->
            <div class="form-group">
              <div class="mb-3">
                <label for="description" class="col-form-label">Description:</label>
                <textarea id="description" name="description" class="form-control" placeholder="Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem impedit distinctio alias delectus." pattern="[A-z0-9 ]{5,255}" title="Minimum 5 characters, letters and numbers only" maxlength="255" required></textarea>
              </div>
            </div>
          </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" value="Confirm">
        </div>
        </form>

      </div>
    </div>
  </div>    
  
  <!-- Modal to show a task -->
  <div class="modal fade" id="showTask" tabindex="-1" aria-labelledby="title" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="showtitle"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p id="showDates"></p>
          <p id="showDescription"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU"crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj"crossorigin="anonymous"></script>
<script src="../javascript/schedule_calendar.js"></script>
<script src="../javascript/schedule_confirm.js"></script>
</body>
</html>