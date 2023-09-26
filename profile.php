<?php
  session_start();

  if(!isset($_SESSION['user'])) {
    header("Location: /login.php");
  }

?>
<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
  <meta name="author" content="Global Concept">
  <meta name="keywords" content="Global Concept, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

  <title>Global Concept - Profile</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  <!-- End fonts -->

  <!-- core:css -->
  <link rel="stylesheet" href="assets/vendors/core/core.css">
  <!-- endinject -->

  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->

  <!-- inject:css -->
  <link rel="stylesheet" href="assets/fonts/feather-font/css/iconfont.css">
  <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
  <!-- endinject -->

  <!-- Layout styles -->
  <link rel="stylesheet" href="assets/css/demo1/style.css">
  <!-- End layout styles -->

  <!-- JQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <!-- End JQuery -->

  <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>

<body>
  <div class="main-wrapper">

    <!-- partial:../../partials/_sidebar.html -->
    <nav class="sidebar">
      <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
          Global<span>Concept</span>
        </a>
        <div class="sidebar-toggler not-active">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
      <div class="sidebar-body">
        <ul class="nav">
          <li class="nav-item nav-category">Main</li>
          <li class="nav-item">
            <a href="profile.php" class="nav-link">
              <i class="link-icon" data-feather="user"></i>
              <span class="link-title">Profile</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="link-icon" data-feather="log-out"></i>
              <span class="link-title" id="logout">Logout</span>
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="page-wrapper">

      <div class="page-content">
        <div class="row">
          <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body">

                <h6 class="card-title">Welcome! <b>&lt;<?php echo $_SESSION['user']['firstname'] ?>&gt;</b></h6>

                <form id="submit-form-data" class="forms-sample">
                  <div class="row mb-3">
                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">First name</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="exampleInputUsername1" placeholder="First name" value="<?php echo $_SESSION['user']['firstname'] ?>">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Last name</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="exampleInputUsername2" placeholder="Last name" value="<?php echo $_SESSION['user']['lastname'] ?>">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                      <input type="email" class="form-control" id="exampleInputEmail2" autocomplete="off" placeholder="Email" value="<?php echo $_SESSION['user']['email'] ?>">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="exampleInputMobile" class="col-sm-3 col-form-label">Mobile</label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="exampleInputMobile" placeholder="Mobile number" value="<?php echo $_SESSION['user']['mobile'] ?>">
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary me-2">Submit</button>
                </form>

              </div>
            </div>
          </div>
        </div>


        <div class="row">
          <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body">

                <h6 class="card-title">Change password</h6>

                <form id="submit-form-class" class="forms-sample">
                  <div class="row mb-3">
                    <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Old Password</label>
                    <div class="col-sm-9">
                      <input type="password" class="form-control" id="exampleInputPassword1" autocomplete="off" placeholder="Password">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="exampleInputPassword2" class="col-sm-3 col-form-label">New Password</label>
                    <div class="col-sm-9">
                      <input type="password" class="form-control" id="exampleInputPassword2" autocomplete="off" placeholder="Password">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Retype new Password</label>
                    <div class="col-sm-9">
                      <input type="password" class="form-control" id="exampleInputPassword3" autocomplete="off" placeholder="Password">
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary me-2">Submit</button>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>

      <footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between px-4 py-3 border-top small">
        <p class="text-muted mb-1 mb-md-0">Copyright © <?= date('Y'); ?> <a target="_blank" href='https://globalconcept.gr/'>Global Concept</a>.</p>
        <p class="text-muted">Handcrafted With <i class="mb-1 text-primary ms-1 icon-sm" data-feather="heart"></i></p>
      </footer>
    </div>
  </div>

  <!-- inject:js -->
  <script src="assets/vendors/feather-icons/feather.min.js"></script>
  <script>
    feather.replace();

    $("#logout").on('click', function(ev) {
      ev.preventDefault();
      
      const postdata = {
        action : 'logout',
      }

      $.ajax({
        url     : "./ajax/auth.php",
        method  : "POST",
        dataType: "json",
        data    : postdata
      })
      .done(function( response, textStatus, jqXHR ) {
        window.location.reload();
      })
      .fail(function( jqXHR, textStatus, errorThrown ) {
        alert( "error" );
      })
      .always(function( data, textStatus, errorThrown ) {
      });

    })
    $("#submit-form-data").submit(function(ev) {
      ev.preventDefault();

      const postdata = {
        action      : 'updateData',
        id          :  <?php echo $_SESSION['user']['id'] ?>,
        firstName   : $("#exampleInputUsername1").val(),
        lastName    : $("#exampleInputUsername2").val(),
        userEmail   : $("#exampleInputEmail2").val(),
        mobile      : $("#exampleInputMobile").val()
      
      }

      $.ajax({
        url     : "./ajax/auth.php",
        method  : "POST",
        dataType: "json",
        data    : postdata
      })
      .done(function( response, textStatus, jqXHR ) {
        if(response.error === false) {
          alert( "Data Updated" );
          window.location.reload();
        }
        else{
          alert( response.desc );
        }
      })
      .fail(function( jqXHR, textStatus, errorThrown ) {
        alert( "error" );
      })
      .always(function( data, textStatus, errorThrown ) {
      });

    })

    $("#submit-form-class").submit(function(ev) {
      ev.preventDefault();

      const postdata = {
        action      : 'updatePass',
        id          :  <?php echo $_SESSION['user']['id'] ?>,
        oldPass     : $("#exampleInputPassword1").val(),
        newPass1    : $("#exampleInputPassword2").val(),
        newPass2    : $("#exampleInputPassword3").val()
      
      }

      $.ajax({
        url     : "./ajax/auth.php",
        method  : "POST",
        dataType: "json",
        data    : postdata
      })
      .done(function( response, textStatus, jqXHR ) {
        if(response.error === false) {
          alert( "Password Updated" );
        }
        else {
          alert( response.desc );
        }
      })
      .fail(function( jqXHR, textStatus, errorThrown ) {
        alert( "error" );
      })
      .always(function( data, textStatus, errorThrown ) {
      });

    })

  </script>


</body>

</html>