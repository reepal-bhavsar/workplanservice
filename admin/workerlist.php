<?php 
session_start();

if(!isset($_SESSION['uid'])) {
  header("location: ../index.php");
}

?>
<!DOCTYPE html>
<!-- beautify ignore:start -->
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../include/" data-template="vertical-menu-template-free">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>

  <title>Worker List</title>

  <meta name="description" content="" />
  <?php include "css.php"; ?>
  <!-- Helpers -->
  <script src="../include/assets/vendor/js/helpers.js"></script>
  <script src="../include/assets/js/config.js"></script>
  <?php include "../config/connection.php"; ?>
</head>

<body>
  <?php
  $apipath = ROOTAPIURL;//access the path while using "include"
  include $apipath."function.php";

  $url = APIURL.'process.php?action=getWorkerDetails';
  $result = curlCall($url,'',"GET");
  $decodeResult = json_decode($result,true);

  if($decodeResult['status'] != 200) {
    $errorMsg = $decodeResult['message'];
  } else {
    $responseData = $decodeResult['res'];
  }
  ?>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->
      <?php include "sidebar.php"; ?>
      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->
        <?php include "header.php"; ?>
        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Hoverable Table rows -->
            <div class="card">
              <h5 class="card-header">Worker List</h5>
              <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Worker</th>
                      <th>Username</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    <?php
                    if(count($responseData)>0) {
                      foreach($responseData as $key=>$value) { 
                        $paramsArray = array('uid'=>$value['uid'],'ufname'=>$value['ufname'],'ulname'=>$value['ulname']);
                        $params = base64_encode(json_encode($paramsArray));
                        ?>
                        <tr>
                          <td><?php echo $value['ufname']."&nbsp;".$value['ulname'];?></td>
                          <td><?php echo $value['uname'];?></td>
                          <td><?php echo $value['phone'];?></td>
                          <td><?php echo $value['email'];?></td>
                          <td>
                            <div class="dropdown">
                              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="addschedule.php?&req=<?php echo $params;?>">
                                  <i class="bx bx-edit-alt me-1"></i> Add Schedule
                                </a>
                                <!--<a class="dropdown-item" href="javascript:void(0);">
                                  <i class="bx bx-edit-alt me-1"></i> Edit
                                </a>
                                <a class="dropdown-item" href="javascript:void(0);">
                                  <i class="bx bx-trash me-1"></i> Delete -->
                                </a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <?php  
                      }  
                    } else { ?>
                      <tr><td><?php echo "No record found";?></td>
                        <?php  
                      }?>
                    </tbody>
                  </table>
                </div>
              </div>
              <!--/ Hoverable Table rows -->
            </div>
            <!-- / Content -->
            <div class="content-backdrop fade"></div>
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
    <?php 
    include "js.php"; ?>
  </body>
  </html>
