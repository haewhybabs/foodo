<!doctype html>
<html lang="en">

<!-- Mirrored from askbootstrap.com/preview/osahan-eat/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 28 Dec 2019 11:59:11 GMT -->
<head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Online Food Delivery System">
        <meta name="description" content="Order for your desired food from your desired restaurant and get it delivered to your door step">
        <meta name="description" content="Food'Oclock Think FoodXyme">
        <meta name="author" content="FoodXyme">
        <title>FoodXyme - Online Food Ordering Website</title>
        <!-- Favicon Icon -->
        <link rel="icon" type="image/png" href="{{asset('web/img/favicon.png')}}">
        <!-- Bootstrap core CSS-->
      <!-- Bootstrap core CSS-->
      <link href="{{ asset('web/css/bootstrap.min.css')}}" rel="stylesheet">
      <!-- Font Awesome-->
      <link href="{{ asset('web/css/all.min.css')}}" rel="stylesheet">
      <link href="{{ asset('web/css/all.css')}}" rel="stylesheet">
      <link href="{{ asset('web/css/fontawesome.css')}}" rel="stylesheet">
      <link href="{{ asset('web/css/fontawesome.min.css')}}" rel="stylesheet">


      <!-- Font Awesome-->
      <link href="{{ asset('web/icofont.min.css')}}" rel="stylesheet">
      <link href="{{ asset('web/icofont.css')}}" rel="stylesheet">
      <!-- Select2 CSS-->
      <link href="{{ asset('web/css/select2.min.css')}}" rel="stylesheet">
      <!-- Custom styles for this template-->
      <link href="{{ asset('web/css/osahan.css')}}" rel="stylesheet">

      <link href="{{ asset('web/css/main.css')}}" rel="stylesheet">
      <!-- Owl Carousel -->
   </head>
   <body class="bg-white">
      <div class="container-fluid">
         <div class="row no-gutter">
            <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
            <div class="col-md-8 col-lg-6">
               <div class="login d-flex align-items-center py-5">
                  <div class="container">
                    @if (count($errors)> 0)
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                {{$error}}

                            </div>
                        @endforeach
                    @endif

                    @if(session('message'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{session('message')}}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{session('error')}}
                        </div>
                    @endif
                     <div class="row">

                        <div class="col-md-9 col-lg-8 mx-auto pl-5 pr-5">
                           <div class="text-center">
                              <a class="navbar-brand" href="{{ URL::TO('/') }}">
                                 <img style="width:90px;" src="{{asset('web/img/icons/foodxyme1.png')}}">
                              </a>
                           </div><br>
                           <h3 class="login-heading mb-4">Reset Password</h3>
                           <form method="post" action="{{ URL::TO('final-password-reset')}}">
                           @csrf
                              <div class="form-label-group">
                                 <input type="password" id="inputEmail" name="password" class="form-control" placeholder="New Password" required>
                                 <label for="inputEmail">New Password</label>
                              </div>
                              <div class="form-label-group">
                                 <input type="password" id="inputPassword" name="password_confirmation" class="form-control" placeholder="Password" required>
                                 <label for="inputPassword">Password</label>
                              </div>
                              <button type="submit" class="btn btn-lg btn-outline-warning btn-block btn-login text-uppercase font-weight-bold mb-2">Sign in</button>
                              <div class="text-center pt-3">
                                 Already have an account? <a class="font-weight-bold" href="{{URL::TO('login')}}" style="color:#ffb200;">Sign In</a>
                              </div>
                           </form>
                           <hr class="my-4">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- jQuery -->
      <script src="https://askbootstrap.com/preview/osahan-eat/vendor/jquery/jquery-3.3.1.slim.min.js"></script>
      <!-- Bootstrap core JavaScript-->
      <script src="https://askbootstrap.com/preview/osahan-eat/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <!-- Select2 JavaScript-->
      <script src="https://askbootstrap.com/preview/osahan-eat/vendor/select2/js/select2.min.js"></script>
      <!-- Custom scripts for all pages-->
      <script src="https://askbootstrap.com/preview/osahan-eat/js/custom.js"></script>
   </body>

<!-- Mirrored from askbootstrap.com/preview/osahan-eat/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 28 Dec 2019 11:59:11 GMT -->
</html>
