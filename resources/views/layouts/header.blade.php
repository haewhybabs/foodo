<!doctype html>
<html lang="en">

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
      <link rel="stylesheet" href="{{ asset('web/css/owl.carousel.css')}}">
      <link rel="stylesheet" href="{{ asset('web/css/owl.theme.css')}}">
   </head>
   <body>
      <nav class="navbar navbar-expand-lg navbar-light bg-light osahan-nav shadow-sm">
         <div class="container">
            <a class="navbar-brand" href="{{ URL::TO('/') }}">FoodXyme</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
               <ul class="navbar-nav ml-auto">
                  <li class="nav-item active">
                     <a class="nav-link" href="{{ URL::TO('/') }}">Home <span class="sr-only">(current)</span></a>
                  </li>
                  <!-- <li class="nav-item">
                     <a class="nav-link" href="https://askbootstrap.com/preview/osahan-eat/offers.html"><i class="icofont-sale-discount"></i> Offers <span class="badge badge-danger">New</span></a>
                  </li> -->
                  <!-- <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     Restaurants
                     </a>
                     <div class="dropdown-menu dropdown-menu-right shadow-sm border-0">
                        <a class="dropdown-item" href="listing.html">Listing</a>
                        <a class="dropdown-item" href="detail.html">Detail + Cart</a>
                        <a class="dropdown-item" href="checkout.html">Checkout</a>
                     </div>
                  </li> -->
                  <!-- <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     Pages
                     </a>
                     <div class="dropdown-menu dropdown-menu-right shadow-sm border-0">
                        <a class="dropdown-item" href="https://askbootstrap.com/preview/osahan-eat/track-order.html">Track Order</a>
                        <a class="dropdown-item" href="https://askbootstrap.com/preview/osahan-eat/invoice.html">Invoice</a>
                        <a class="dropdown-item" href="login.html">Login</a>
                        <a class="dropdown-item" href="https://askbootstrap.com/preview/osahan-eat/register.html">Register</a>
                        <a class="dropdown-item" href="https://askbootstrap.com/preview/osahan-eat/404.html">404</a>
                        <a class="dropdown-item" href="https://askbootstrap.com/preview/osahan-eat/extra.html">Extra :)</a>
                     </div>
                  </li> -->
                  <li class="nav-item dropdown">

                    @auth
                        <a class="nav-link dropdown-toggle" href="{{URL::TO('login')}}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img alt="Generic placeholder image" src="https://askbootstrap.com/preview/osahan-eat/img/user/4.png" class="nav-osahan-pic rounded-pill">{{Auth::user()->email}}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow-sm border-0">
                            <a class="dropdown-item" href="{{URL::TO('user-profile')}}"><i class="icofont-profile"></i>Profile</a>
                            <a class="dropdown-item" href="{{URL::TO('logout')}}"><i class="icofont-sale-discount"></i>Logout</a>
                        </div>
                    @endauth
                    @guest
                        <a class="nav-link dropdown-toggle" href="{{URL::TO('login')}}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img alt="Generic placeholder image" src="https://askbootstrap.com/preview/osahan-eat/img/user/4.png" class="nav-osahan-pic rounded-pill">Login|Signup
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow-sm border-0">
                        <a class="dropdown-item" href="{{URL::TO('login')}}"><i class="icofont-credit-card"></i> SignIn</a>
                            <a class="dropdown-item" href="{{URL::TO('register')}}"><i class="icofont-food-cart"></i> SignUp</a>

                        </div>
                    @endguest
                  </li>
                  <li class="nav-item dropdown dropdown-cart">
                     <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <i class="fas fa-shopping-basket"></i> Cart
                     @if(!session()->get('cart'))
                     <span class="badge badge-success">0</span>
                    @else
                    <span class="badge badge-success">{{count(session('cart'))}}</span>
                    @endif

                     </a>
                     <div class="dropdown-menu dropdown-cart-top p-0 dropdown-menu-right shadow-sm border-0">
                        <div class="dropdown-cart-top-header p-4">
                           <img class="img-fluid mr-3" alt="osahan" src="https://askbootstrap.com/preview/osahan-eat/img/cart.jpg">
                           <h6 class="mb-0">Gus's World Famous Chicken</h6>
                           <p class="text-secondary mb-0">310 S Front St, Memphis, USA</p>
                           <small><a class="text-primary font-weight-bold" href="#">View Full Menu</a></small>
                        </div>
                        <div class="dropdown-cart-top-body border-top p-4">
                           <p class="mb-2"><i class="icofont-ui-press text-danger food-item"></i> Chicken Tikka Sub 12" (30 cm) x 1   <span class="float-right text-secondary">$314</span></p>
                           <p class="mb-2"><i class="icofont-ui-press text-success food-item"></i> Corn & Peas Salad x 1   <span class="float-right text-secondary">$209</span></p>
                           <p class="mb-2"><i class="icofont-ui-press text-success food-item"></i> Veg Seekh Sub 6" (15 cm) x 1  <span class="float-right text-secondary">$133</span></p>
                           <p class="mb-2"><i class="icofont-ui-press text-danger food-item"></i> Chicken Tikka Sub 12" (30 cm) x 1   <span class="float-right text-secondary">$314</span></p>
                           <p class="mb-2"><i class="icofont-ui-press text-danger food-item"></i> Corn & Peas Salad x 1   <span class="float-right text-secondary">$209</span></p>
                        </div>
                        <div class="dropdown-cart-top-footer border-top p-4">
                           <p class="mb-0 font-weight-bold text-secondary">Sub Total <span class="float-right text-dark">$499</span></p>
                           <small class="text-info">Extra charges may apply</small>
                        </div>
                        <div class="dropdown-cart-top-footer border-top p-2">
                        <a class="btn btn-success btn-block btn-lg" href="{{URL::TO('checkout')}}"> Checkout</a>
                        </div>
                     </div>
                  </li>
               </ul>
            </div>
         </div>
      </nav>
