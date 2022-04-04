<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="include/assets/" data-template="vertical-menu-template-free">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
  <title>Login</title>
  <meta name="description" content="" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?php include "css.php"; ?>
  <!-- Helpers -->
  <script src="include/assets/vendor/js/helpers.js"></script>
  <script src="include/assets/js/config.js"></script>
  <?php include "config/connection.php"; ?>
  <?php include "function.php"; ?>
</head>
<!-- <body oncontextmenu="return false" onkeydown="return false;" onmousedown="return false;"> -->

  <body>
    <!-- Loader -->
    <?php include "loader.php"; ?>

    <!-- Content -->
    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <?php include "logo.php"; ?>
              <!-- /Logo -->
              <h4 class="mb-2">Welcome to the system!</h4>
              <p class="mb-4">Please sign-in to your account</p>
              <!--<form id="loginForm" class="mb-3" action="#" onsubmit="return validateSignIn();" method="POST"> -->
                <form id="loginForm" class="mb-3">
                  <div id="messageDiv">
                    <center>
                      <span class=" text-danger errorMsg" id="errorMsg"></span>
                      <span class=" text-success successMsg" id="successMsg"></span>
                    </center>
                  </div>
                  <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <div class="input-group input-group-merge">
                      <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" autofocus>
                    </div>
                  </div>

                  <div class="mb-3 form-password-toggle">
                    <div class="d-flex justify-content-between">
                      <label class="form-label" for="password">Password</label>
                      <!-- <a href="forgotpass.php"> <small>Forgot Password?</small> </a> --> 
                    </div>

                    <div class="input-group input-group-merge">
                      <input type="password" id="password" class="form-control" name="password" 
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                      <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span> 
                    </div>
                  </div>
                  <div class="mb-3">
                    <button class="btn btn-primary d-grid w-100" type="button" onClick="validateSignIn();">Sign in</button>
                  </div>
                </form>
                <p class="text-center"> <span>Forgot Password?</span> <u><a href="forgotpass.php"><small class="text-uppercase">Click here</small></a></u> </p>
                <!-- <p class="text-center"> <span>New here?</span> <a href="registration.php"> <span>Create an account</span> </a> </p> -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- / Content -->
      <!-- Core JS -->
      <?php include "js.php"; ?>
    </body>
    </html>
