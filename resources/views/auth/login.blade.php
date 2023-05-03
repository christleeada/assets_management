<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CCS Assets Management</title>

    <!-- Bootstrap -->
    <link href="{{asset('asset/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('asset/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('asset/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{asset('asset/vendors/animate.css/animate.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('asset/build/css/custom.min.css')}}" rel="stylesheet">
    <style>
      /* Set logo width */
      .login-logo {
        width: 200px;
      }

      /* Align logo to center */
      .login-logo-wrapper {
        text-align: center;
        
      }
      
    </style>
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
          <img class="login-logo" src="{{ asset('images/Loginlogo.png') }}" alt="Logo">
          <form method="POST" action="{{route('login')}}">
                @csrf
              <h1>CCS Assets Management</h1>
              <div>
                <input type="email" name="email" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" name="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <button type="submit" class="btn btn-primary">Log in</button>
              </div>

              <div class="clearfix"></div>

            </form>
          </section>
        </div>

      </div>
    </div>
  </body>
</html>
