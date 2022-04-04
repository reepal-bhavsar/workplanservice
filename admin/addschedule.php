<?php 
session_start();

if(!isset($_SESSION['uid'])) {
  header("location: ../index.php");
}

?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../include/" data-template="vertical-menu-template-free">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>Add Schedule</title>
  <meta name="description" content="" />

  <?php include "css.php"; ?>
  <link rel= "stylesheet" href= "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
  <style>
    .datepicker {
      z-index: 1075 !important;
    }

    input[type="date"]::-webkit-inner-spin-button,
    input[type="date"]::-webkit-calendar-picker-indicator {
      display: none;
      -webkit-appearance: none;
    }
    
    input[type="date"] {
      background-color: #FFFFFF !important;
    }
  </style>
  
  <!-- Helpers -->
  <script src="../include/assets/vendor/js/helpers.js"></script>
  <script src="../include/assets/js/config.js"></script>

  <?php include "../config/connection.php"; ?>
  <?php include "function.php"; ?>
  <?php 
  include "../loader.php";
  $apipath = ROOTAPIURL;//access the path while using "include"
  include $apipath."function.php"; ?>
</head>

<body>
  <!-- Loader -->
  <?php 
  $requestData = json_decode(base64_decode($_GET['req']),true);
  $workerName = $requestData['ufname']." ".$requestData['ulname'];
  $workerId = $requestData['uid'];
    //print_r($workerId);
  ?>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <?php include "sidebar.php"; ?>

      <!-- Layout container -->
      <div class="layout-page">
        <?php include "header.php"; ?>

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">

              <!-- Form controls -->
              <div class="col-xxl">
                <div class="card mb-4">
                  <h5 class="card-header">Add Schedule</h5>
                  <div class="card-body">
                    <form id="addScheduleForm" name="addScheduleForm">
                      <div id="messageDiv">
                        <center>
                          <span class=" text-danger errorMsg" id="errorMsg"></span>
                          <span class=" text-success successMsg" id="successMsg"></span>
                        </center>
                      </div>
                      <input type="hidden" id="workerid" value="<?php echo $workerId; ?>"/>
                      <div class="row mb-3">
                        <label for="fname" class="form-label">Worker</label>
                        <div class="col-md-10">
                          <input class="form-control" type="text" id="name" value="<?php echo $workerName;?>" disabled/>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="lname" class="form-label">Date</label>
                        <div class="col-md-10">
                          <!--<input type="date" id="scheduledate" class="form-control" />-->
                          <input type="date" id="scheduledate" class="form-control date-input" readonly="readonly" />
                        </div>
                      </div>                        
                      <div class="row mb-3">
                        <label for="scheduletime" class="form-label">Schedule Time</label>
                        <div class="col-md-10">
                          <select class="form-select" id="scheduletime" aria-label="scheduletime">
                            <option value="0" selected="">Select Time</option>
                            <option value="1">0-8</option>
                            <option value="2">8-16</option>
                            <option value="3">16-24</option>
                          </select>
                        </div>
                      </div>
                      <a href="workerlist.php" class="btn btn-primary">Back</a>
                      <button type="button" class="btn btn-primary" onclick="validateSchedule();">Submit</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- / Content -->
        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>
    <!-- Core JS -->
    <?php include "js.php"; ?>
    <script type= "text/javascript" src= "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>

    <script>
      /*Date start with today */
      var date = new Date();
      var mindtDate = new Intl.DateTimeFormat('en-GB').format(date);
      var minDate = mindtDate.split("/").reverse().join("-");

      $(document).ready(function() {  
        $("#scheduledate").attr({"min" : minDate});
          disablePreScheduledDays();//Check & Disable already scheduled days of this worker
        });
      </script>

    </body>
    </html>