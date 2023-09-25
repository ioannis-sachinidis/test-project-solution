<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
  <meta name="author" content="Global Concept">
  <meta name="keywords" content="Global Concept, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

  <title>Global Concept - Login</title>

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

  <!-- Include JQuery from CDN -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <!-- End JQuery -->

  <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>

<body>
  <div class="main-wrapper">
    <div class="page-wrapper full-page">
      <div class="page-content d-flex align-items-center justify-content-center">

        <div class="row w-100 mx-0 auth-page">
          <div class="col-md-8 col-xl-6 mx-auto">
            <div class="card">
              <div class="row">
                <div class="col-md-4 pe-md-0">
                  <div class="auth-side-wrapper">

                  </div>
                </div>
                <div class="col-md-8 ps-md-0">
                  <div class="auth-form-wrapper px-4 py-5">
                    <a href="#" class="noble-ui-logo d-block mb-2">Global<span>Concept</span></a>
                    <h5 class="text-muted fw-normal mb-4">Welcome back! Log in to your account.</h5>

                    <form id="submit-form" class="forms-sample" method='post' action='/login'>
                      <div class="mb-3">
                        <label for="userEmail" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="userEmail" name="userEmail" placeholder="Email" required value="gg@gg.com">
                      </div>
                      <div class="mb-3">
                        <label for="userPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="userPassword" name="userPassword" autocomplete="current-password" placeholder="Password" required value="123">
                      </div>
                      <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="authCheck" name="authCheck">
                        <label class="form-check-label" for="authCheck">
                          Remember me
                        </label>
                      </div>
                      <div>
                        <button type='submit' class="btn btn-primary me-2 mb-2 mb-md-0 text-white">Login</button>
                      </div>
                    </form>

                  </div>
                </div>
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

    $("#submit-form").submit(function(ev) {
      ev.preventDefault();

      const postdata = {
        action      : 'login',
        userEmail   : $("#userEmail").val(),
        userPassword: $("#userPassword").val()
      }

      $.ajax({
        url     : "./ajax/auth.php",
        method  : "POST",
        dataType: "json",
        data    : postdata
      })
      .done(function( response, textStatus, jqXHR ) {
        if(response.error === false) {
          window.location.href = "/profile.php";
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