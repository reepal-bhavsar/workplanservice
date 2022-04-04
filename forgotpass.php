<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="include/assets/" data-template="vertical-menu-template-free">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>Forgot Password</title>
  <meta name="description" content="" />
  <?php include "css.php"; ?>
  <!-- Helpers -->
  <script src="include/assets/vendor/js/helpers.js"></script>
  <script src="include/assets/js/config.js"></script>
</head>
<body>
  <!-- Content -->
  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner py-4">
        <!-- Forgot Password -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <?php include "logo.php"; ?>
            <!-- /Logo -->
            <h4 class="mb-2">Forgot Password? 🔒</h4>
            <p class="mb-4">Enter your email and we'll send you instructions to reset your password</p>
            <form id="formAuthentication" class="mb-3" action="index.php" method="POST">
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input
                type="text"
                class="form-control"
                id="email"
                name="email"
                placeholder="Enter your email"
                autofocus
                />
              </div>
              <button class="btn btn-primary d-grid w-100">Send Reset Link</button>
            </form>
            <div class="text-center"> <a href="index.php" class="d-flex align-items-center justify-content-center"> <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i> Back to login </a> </div>
          </div>
        </div>
        <!-- /Forgot Password -->
      </div>
    </div>
  </div>
  <!-- / Content -->
  <!-- Core JS -->
  <?php include "js.php"; ?>
</body>
</html>
