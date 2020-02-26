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
                            <div class="text-center">
                                <a class="navbar-brand" href="{{ URL::TO('/') }}">
                                   <img style="width:90px;" src="{{asset('web/img/icons/foodxyme1.png')}}">
                                </a>
                             </div><br>
                           <h3 class="login-heading mb-4">Vendor Registration!</h3>
                           <form method="post" action="{{ URL::TO('vendor-register')}}">
                            @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <input type="text" id="inputName" name="name" class="form-control" placeholder="Full Name" value="{{ old('name') }}" required>
                                            <label for="inputName">Store Name</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <input type="text" id="inputm_name" name="manager_name" class="form-control" placeholder="Manager Name" value="{{ old('manager_name') }}" required>
                                            <label for="inputm_name">Manager Name</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <input type="email" id="inputemail" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                                            <label for="inputemail">Email</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <input type="text" id="inputmobile" name="phone_number" class="form-control" placeholder="Phone Number" value="{{ old('phone_number') }}" required>
                                            <label for="inputmobile">Phone Number</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <input type="password" id="inputpassword" name="password" class="form-control" placeholder="password" required>
                                            <label for="inputpassword">Password</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <input type="text" id="inputpasswordconf" name="password_confirmation" class="form-control" placeholder="Password Confirmation" required>
                                            <label for="inputpasswordconf">Password Confirmation</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-label-group">
                                    <input type="text" id="inputAddress" name="address" class="form-control" placeholder="Address" value="{{ old('address') }}" required>
                                    <label for="inputAddress">Address</label>
                                </div>

                                <div class="form-label-group">
                                    <input type="text" id="inputdescription" name="description" class="form-control" placeholder="Brief Description" value="{{ old('description') }}" required>
                                    <label for="inputdescription">Description</label>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <input type="time" id="inputopen" name="open_at" class="form-control" placeholder="Tell us when you open" value="{{ old('open_at') }}" required>
                                            <label for="inputopen">Opens At</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <input type="time" id="inputclose" name="close_at" class="form-control" placeholder="Tell us when you close" value="{{ old('close_at') }}" required>
                                            <label for="inputclose">Closes At</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="region_id">Select a region closer to you</label>
                                    <select class="form-control" id="region" required>
                                        <option value="">Select Region</option>
                                        @foreach($regions as $region)
                                            <option value="{{ $region->idregions }}">{{ $region->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="category_id">Select a category you belong to</label>
                                    <select class="form-control" id="category">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->idcategories }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">Remember password</label>
                                </div>
                                <button type="submit" class="btn btn-lg btn-outline-warning btn-block btn-login text-uppercase font-weight-bold mb-2">Register</button>
                           </form>
                           <hr class="my-4">
                           {{--  <p class="text-center">Register WITH</p>
                           <div class="row">
                              <div class="col pr-2">
                                 <button class="btn pl-1 pr-1 btn-lg btn-google font-weight-normal text-white btn-block text-uppercase" type="submit" style="background:#ffb200;"><i class="fab fa-google mr-2"></i> Google</button>
                              </div>
                              <div class="col pl-2">
                                 <button class="btn pl-1 pr-1 btn-lg btn-facebook font-weight-normal text-white btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Facebook</button>
                              </div>
                           </div>  --}}
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
