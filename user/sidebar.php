<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="index.php" class="app-brand-link app-brand-text demo menu-text fw-bolder ms-2">
      Work Planning<br>Service
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item">
      <a href="index.php" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div>Dashboard</div>
      </a>
    </li>
  </ul>
</aside>
<!-- / Menu -->

<script>
  var currentPath = window.location.pathname.split('/').pop();
  $(document).ready(function () {
    $('li.menu-item').removeClass('active');
    $('li.menu-item').each(function (e){
      var pagename = $(this).children("a").attr("href");
      if(pagename == currentPath){
        $(this).addClass('active');
      }
    });
});
</script>