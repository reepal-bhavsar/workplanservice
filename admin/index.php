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
  <title>Dashboard</title>
  <meta name="description" content="" />
  <?php include "css.php"; ?>

  <!-- Helpers -->
  <script src="../include/assets/vendor/js/helpers.js"></script>
  <script src="../include/assets/js/config.js"></script>
  
</head>
<body>

  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <?php include "sidebar.php"; ?>

      <!-- Layout container -->
      <div class="layout-page">

        <!-- Navbar -->
        <?php include "header.php"; ?>

        <!-- Content wrapper -->
        <div class="content-wrapper">

          <!-- Content -->
          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
              <div class="col-12 mb-4 order-0">
                <div class="card">
                  <div class="d-flex align-items-end row">
                    <div class="col-sm-12">
                      <div class="card-body">
                        <h5 class="card-title text-primary">Welcome <?php echo ucfirst($_SESSION['ufname']); ?>!</h5>
                      </div>
                    </div>
                  </div>
                </div>
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

<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->
<!-- Core JS -->
<?php include "js.php"; ?>
<!-- Page JS -->
<script src="../include/assets/js/dashboards-analytics.js"></script>
</body>
</html>
