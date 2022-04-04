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
  <title>Worker Registration</title>
  <meta name="description" content="" />
  <?php include "css.php"; ?>

  <!-- Helpers -->
  <script src="../include/assets/vendor/js/helpers.js"></script>
  <script src="../include/assets/js/config.js"></script>
  <?php include "../config/connection.php"; ?>
  <?php include "function.php"; ?>
</head>

<body>
  <!-- Loader -->
  <?php include "../loader.php"; ?>
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
                  <h5 class="card-header">Worker Registration</h5>
                  <div class="card-body">
                    <form id="workerRegisterForm" name="workerRegisterForm">
                      <div id="messageDiv">
                        <center>
                          <span class=" text-danger errorMsg" id="errorMsg"></span>
                          <span class=" text-success successMsg" id="successMsg"></span>
                        </center>
                      </div>
                      <div class="row mb-3">
                        <label for="fname" class="form-label">First Name</label>
                        <div class="col-md-10">
                          <input class="form-control" type="text" id="fname" placeholder="First Name" />
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="lname" class="form-label">Last Name</label>
                        <div class="col-md-10">
                          <input class="form-control" type="text" id="lname" placeholder="Last Name" />
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="emailaddress" class="form-label">Email address</label>
                        <div class="col-md-10">
                          <input type="email" class="form-control" id="emailaddress" placeholder="name@example.com" />
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <div class="col-md-10">
                          <input type="tel" class="form-control" id="phone" placeholder="+491234567890" />
                        </div>
                        <div class="form-text">Phone must start with +49 and the rest should be 10-15 numbers</div>
                      </div>
                      <div class="row mb-3">
                        <label for="username" class="form-label">User Name</label>
                        <div class="col-md-10">
                          <input type="text" class="form-control" id="username" placeholder="User Name" />
                        </div>
                        <div class="form-text">Username must be 3-50 characters</div>
                      </div>
                      <div class="row mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="col-md-10">
                          <input class="form-control" type="text" placeholder="Password" id="password" />
                        </div>
                        <div class="form-text">Password must be atleast 7 characters</div>
                      </div>
                      <div class="row mb-3">
                        <label for="confirmpass" class="form-label">Confirm Password</label>
                        <div class="col-md-10">
                          <input class="form-control" type="text" placeholder="Confirm Password" id="confirmpass" />
                        </div>
                      </div>
                      <button type="reset" class="btn btn-primary">Reset</button>
                      <button type="button" class="btn btn-primary" onclick="validateWorkerDetails();">Submit</button>
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

    <div class="buy-now">
      <a href="#" class="btn btn-primary rounded-pill btn-icon btn-buy-now" id="back2Top" name="back2Top"><i class="bx bx-chevrons-up"></i></a>
    </div>
    <!-- Core JS -->
    <?php include "js.php"; ?>
  </body>
  </html>