<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>IP MANAGEMENT</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="../../backend2/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../../backend2/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="../../backend2/plugins/jqvmap/jqvmap.min.css">
  <link rel="stylesheet" href="../../backend2/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="../../pdfjs-dist/web/viewer.css">

</head>
<body class="hold-transition sidebar-mini">
<div id="app">

      <router-view></router-view>

</div>

<!-- jQuery -->
<script src="../../backend2/plugins/jquery/jquery.min.js"></script>
<script src="../../backend2/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="../../js/app.js"></script>
<script src="../../backend2/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../backend2/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../../backend2/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<script src="../../backend2/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="../../backend2/dist/js/adminlte.js"></script>
<script type="text/javascript">
  $( document ).ready(function() {
    let token = localStorage.getItem('token');
    if(token) {
        $("#sidebar").css("display","");
        $("#topbar").css("display","");
        $("#footer_div").css("display","");
        if(localStorage.getItem('user_type')!="Administrator")
        {
          $("#usermenu").addClass("d-none")
        }else{
          $("#usermenu").removeClass("d-none")
        }
    }
  });
</script>
</body>
</html>
