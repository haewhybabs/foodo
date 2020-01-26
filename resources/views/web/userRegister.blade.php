<!doctype html>
<html lang="en">

<!-- Mirrored from askbootstrap.com/preview/osahan-eat/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 28 Dec 2019 11:59:11 GMT -->
<head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="Askbootstrap">
      <meta name="author" content="Askbootstrap">
      <title>FoodXyme - Online Food Ordering Website</title>
      <!-- Favicon Icon -->
      <link rel="icon" type="image/png" href="https://askbootstrap.com/preview/osahan-eat/img/favicon.png">
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
                           <h3 class="login-heading mb-4">Welcome back!</h3>
                           <form method="post" action="{{ URL::TO('register')}}">
                           @csrf
                              <div class="form-label-group">
                                 <input type="text" id="inputName" name="name" class="form-control" placeholder="Full Name" required>
                                 <label for="inputName">Name</label>
                              </div>
                              <div class="form-label-group">
                                 <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required>
                                 <label for="inputEmail">Email address</label>
                              </div>
                              <div class="form-label-group">
                                 <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                                 <label for="inputPassword">Password</label>
                              </div>
                              <div class="form-label-group">
                                 <input type="password" id="inputPasswordconf" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                                 <label for="inputPasswordconf">Password Confirmation</label>
                              </div>

                              <div class="form-label-group">
                                 <input type="text" id="inputAddress" name="address" class="form-control" placeholder="Address" required>
                                 <label for="inputAddress">Address</label>
                              </div>

                              <div class="form-label-group">
                                 <input type="text" id="inputmobile" name="phone_number" class="form-control" placeholder="Phone Number" required>
                                 <label for="inputmobile">Phone Number</label>
                              </div>
                              <div class="custom-control custom-checkbox mb-3">
                                 <input type="checkbox" class="custom-control-input" id="customCheck1">
                                 <label class="custom-control-label" for="customCheck1">Remember password</label>
                              </div>
                              <button type="submit" class="btn btn-lg btn-outline-warning btn-block btn-login text-uppercase font-weight-bold mb-2">Register</button>
                              {{--  <div class="text-center pt-3">
                                 Don’t have an account? <a class="font-weight-bold" href="{{URL::TO('register')}}" style="color:#ffb200;">Sign Up</a>
                              </div>  --}}
                           </form>
                           <hr class="my-4">
                           <p class="text-center">Register WITH</p>
                           <div class="row">
                              <div class="col pr-2">
                                 <button class="btn pl-1 pr-1 btn-lg btn-google font-weight-normal text-white btn-block text-uppercase" type="submit" style="background:#ffb200;"><i class="fab fa-google mr-2"></i> Google</button>
                              </div>
                              <div class="col pl-2">
                                 <button class="btn pl-1 pr-1 btn-lg btn-facebook font-weight-normal text-white btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Facebook</button>
                              </div>
                           </div>
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
