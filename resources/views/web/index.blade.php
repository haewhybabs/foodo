@extends('layouts.main')
@section('content')
<section class="pt-5 pb-5 homepage-search-block position-relative">
    <div class="banner-overlay"></div>
    <div class="container">
    <div class="row d-flex align-items-center">
        <div class="col-md-8">
            <div class="homepage-search-title">
                <h1 class="mb-2 font-weight-normal"><span class="font-weight-bold">Order It</span> Get It Straight UP</h1>
                <h5 class="mb-5 text-secondary font-weight-normal">Lists of top restaurants, pharmacy, supermarket, and bars, based on trends</h5>
            </div>
            <div class="homepage-search-form">
                <form class="form-noborder">
                <div class="form-row">
                    <div class="col-lg-3 col-md-3 col-sm-12 form-group">
                        <div class="location-dropdown">
                            <i class="icofont-location-arrow"></i>
                            <select class="custom-select form-control-lg">
                            <option>Select City</option>
                            <option>Ile-Ife </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-12 form-group">
                        <input type="text" placeholder="Search for Restaurant,Bar,Pharmacy,Supermarket" class="form-control form-control-lg">
                        <!-- <a class="locate-me" href="#"><i class="icofont-ui-pointer"></i> Locate Me</a> -->
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12 form-group">
                        <a href="https://askbootstrap.com/preview/osahan-eat/listing.html" class="btn btn-warning btn-block btn-lg btn-gradient">Search</a>
                        <!--<button type="submit" class="btn btn-primary btn-block btn-lg btn-gradient">Search</button>-->
                    </div>
                </div>
                </form>
            </div>
            <h6 class="mt-4 text-shadow font-weight-normal">Choose a Service</h6>
            <div class="owl-carousel owl-carousel-category owl-theme">
                @foreach($categories as $category)
                <div class="item">
                <div class="osahan-category-item">
                    <a href="{{URL::TO('')}}/{{ $category->name }}">
                        <img class="img-fluid" src="https://askbootstrap.com/preview/osahan-eat/img/list/1.png" alt="">
                        <h6>{{ $category->name }}</h6>
                        <p>156</p>
                    </a>
                </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Advertisment -->

        <!-- <div class="col-md-4">
            <div class="osahan-slider pl-4 pt-3">
                <div class="owl-carousel homepage-ad owl-theme">
                <div class="item">
                    <a href="https://askbootstrap.com/preview/osahan-eat/listing.html"><img class="img-fluid rounded" src="https://askbootstrap.com/preview/osahan-eat/img/slider.png"></a>
                </div>
                <div class="item">
                    <a href="https://askbootstrap.com/preview/osahan-eat/listing.html"><img class="img-fluid rounded" src="https://askbootstrap.com/preview/osahan-eat/img/slider1.png"></a>
                </div>
                <div class="item">
                    <a href="https://askbootstrap.com/preview/osahan-eat/listing.html"><img class="img-fluid rounded" src="https://askbootstrap.com/preview/osahan-eat/img/slider.png"></a>
                </div>
                </div>
            </div>
        </div> -->
    </div>
    </div>
</section>
<!-- Advertisement -->

<section class="section pt-5 pb-5 bg-white homepage-add-section">
    <div class="container">
    <div class="row">
        <div class="col-md-3 col-6">
            <div class="products-box">
                <a href="https://askbootstrap.com/preview/osahan-eat/listing.html"><img alt="" src="https://askbootstrap.com/preview/osahan-eat/img/pro1.jpg" class="img-fluid rounded"></a>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="products-box">
                <a href="https://askbootstrap.com/preview/osahan-eat/listing.html"><img alt="" src="https://askbootstrap.com/preview/osahan-eat/img/pro2.jpg" class="img-fluid rounded"></a>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="products-box">
                <a href="https://askbootstrap.com/preview/osahan-eat/listing.html"><img alt="" src="https://askbootstrap.com/preview/osahan-eat/img/pro3.jpg" class="img-fluid rounded"></a>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="products-box">
                <a href="https://askbootstrap.com/preview/osahan-eat/listing.html"><img alt="" src="https://askbootstrap.com/preview/osahan-eat/img/pro4.jpg" class="img-fluid rounded"></a>
            </div>
        </div>
    </div>
    </div>
</section>

<section class="section pt-5 pb-5 bg-white homepage-add-section">]
    <div class="container">
    <div class="section-header text-center">
        <h2>How It Works</h2>
        <span class="line"></span>
    </div>
    <div class="row">

        <div class="col-sm-4">
            <div class="text-center">
                <img src="{{ asset('web/img/icons/desktop-48.png')}}" style="height:60px; width:70px; margin-bottom:20px;">
                <h3>Make an Order</h3>
                <p>Order for your desired food</p>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="text-center">
                <img src="{{ asset('web/img/icons/location_yellow.png')}}" style="height:60px; width:70px; margin-bottom:20px;"><br>
                <h3>Set Delivery Location</h3>
                <p>Select the location where you want us to deliver</p>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="text-center">
                <img src="{{ asset('web/img/icons/motorcycle.png')}}" style="height:60px; width:70px; margin-bottom:20px;"><br>
                <h3>Get it at your location</h3>
                <p>Your order is delivered to you straight up</p>
            </div>
        </div>

    </div>
    </div>

</section>


<section class="section pt-5 pb-5 products-section">
    <div class="container">
    <div class="section-header text-center">
        <h2>Popular Vendors</h2>
        <p>Top restaurants, cafes, pubs, and bars in your area, based on trends</p>
        <span class="line"></span>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="owl-carousel owl-carousel-four owl-theme">
                <div class="item">
                <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                    <div class="list-card-image">
                        <div class="star position-absolute"><span class="badge badge-success"><i class="icofont-star"></i> 3.1 (300+)</span></div>
                        <div class="favourite-heart text-danger position-absolute"><a href="https://askbootstrap.com/preview/osahan-eat/detail.html"><i class="icofont-heart"></i></a></div>
                        <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                        <a href="https://askbootstrap.com/preview/osahan-eat/detail.html">
                        <img src="https://askbootstrap.com/preview/osahan-eat/img/list/1.png" class="img-fluid item-img">
                        </a>
                    </div>
                    <div class="p-3 position-relative">
                        <div class="list-card-body">
                            <h6 class="mb-1"><a href="https://askbootstrap.com/preview/osahan-eat/detail.html" class="text-black">Mr Banwil</a></h6>
                            <p class="text-gray mb-3">North Indian • American • Pure veg</p>
                            <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="icofont-wall-clock"></i> 20–25 min</span> <span class="float-right text-black-50"> $250 FOR TWO</span></p>
                        </div>
                        <div class="list-card-badge">
                            <span class="badge badge-success">OFFER</span> <small>65% off | Use Coupon OSAHAN50</small>
                        </div>
                    </div>
                </div>
                </div>
                <div class="item">
                <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                    <div class="list-card-image">
                        <div class="star position-absolute"><span class="badge badge-warning"><i class="icofont-star"></i> 3.1 (300+)</span></div>
                        <div class="favourite-heart text-danger position-absolute"><a href="https://askbootstrap.com/preview/osahan-eat/detail.html"><i class="icofont-heart"></i></a></div>
                        <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                        <a href="https://askbootstrap.com/preview/osahan-eat/detail.html">
                        <img src="https://askbootstrap.com/preview/osahan-eat/img/list/3.png" class="img-fluid item-img">
                        </a>
                    </div>
                    <div class="p-3 position-relative">
                        <div class="list-card-body">
                            <h6 class="mb-1"><a href="https://askbootstrap.com/preview/osahan-eat/detail.html" class="text-black">Captain Cook</a></h6>
                            <p class="text-gray mb-3">North Indian • Indian • Pure veg</p>
                            <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="icofont-wall-clock"></i> 15–25 min</span> <span class="float-right text-black-50"> $100 FOR TWO</span></p>
                        </div>
                        <div class="list-card-badge">
                            <span class="badge badge-warning">OFFER</span> <small>65% off | Use Coupon OSAHAN50</small>
                        </div>
                    </div>
                </div>
                </div>
                <div class="item">
                <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                    <div class="list-card-image">
                        <div class="star position-absolute"><span class="badge badge-success"><i class="icofont-star"></i> 3.1 (300+)</span></div>
                        <div class="favourite-heart text-danger position-absolute"><a href="https://askbootstrap.com/preview/osahan-eat/detail.html"><i class="icofont-heart"></i></a></div>
                        <div class="member-plan position-absolute"><span class="badge badge-danger">Promoted</span></div>
                        <a href="https://askbootstrap.com/preview/osahan-eat/detail.html">
                        <img src="https://askbootstrap.com/preview/osahan-eat/img/list/6.png" class="img-fluid item-img">
                        </a>
                    </div>
                    <div class="p-3 position-relative">
                        <div class="list-card-body">
                            <h6 class="mb-1"><a href="https://askbootstrap.com/preview/osahan-eat/detail.html" class="text-black">Mr Big's
                            </a>
                            </h6>
                            <p class="text-gray mb-3">North • Hamburgers • Pure veg</p>
                            <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="icofont-wall-clock"></i> 15–25 min</span> <span class="float-right text-black-50"> $500 FOR TWO</span></p>
                        </div>
                        <div class="list-card-badge">
                            <span class="badge badge-danger">OFFER</span> <small>65% off | Use Coupon OSAHAN50</small>
                        </div>
                    </div>
                </div>
                </div>
                <div class="item">
                <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                    <div class="list-card-image">
                        <div class="star position-absolute"><span class="badge badge-success"><i class="icofont-star"></i> 3.1 (300+)</span></div>
                        <div class="favourite-heart text-danger position-absolute"><a href="https://askbootstrap.com/preview/osahan-eat/detail.html"><i class="icofont-heart"></i></a></div>
                        <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                        <a href="https://askbootstrap.com/preview/osahan-eat/detail.html">
                        <img src="https://askbootstrap.com/preview/osahan-eat/img/list/8.png" class="img-fluid item-img">
                        </a>
                    </div>
                    <div class="p-3 position-relative">
                        <div class="list-card-body">
                            <h6 class="mb-1"><a href="https://askbootstrap.com/preview/osahan-eat/detail.html" class="text-black">Country Kitchen
                            </a>
                            </h6>
                            <p class="text-gray mb-3">North Indian • Indian • Pure veg</p>
                            <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="icofont-wall-clock"></i> 15–25 min</span> <span class="float-right text-black-50"> $250 FOR TWO</span></p>
                        </div>
                        <div class="list-card-badge">
                            <span class="badge badge-danger">OFFER</span> <small>65% off | Use Coupon OSAHAN50</small>
                        </div>
                    </div>
                </div>
                </div>
                <div class="item">
                <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                    <div class="list-card-image">
                        <div class="star position-absolute"><span class="badge badge-success"><i class="icofont-star"></i> 3.1 (300+)</span></div>
                        <div class="favourite-heart text-danger position-absolute"><a href="https://askbootstrap.com/preview/osahan-eat/detail.html"><i class="icofont-heart"></i></a></div>
                        <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                        <a href="https://askbootstrap.com/preview/osahan-eat/detail.html">
                        <img src="https://askbootstrap.com/preview/osahan-eat/img/list/9.png" class="img-fluid item-img">
                        </a>
                    </div>
                    <div class="p-3 position-relative">
                        <div class="list-card-body">
                            <h6 class="mb-1"><a href="https://askbootstrap.com/preview/osahan-eat/detail.html" class="text-black">Ace Supermarket
                            </a>
                            </h6>
                            <p class="text-gray mb-3">North Indian • Indian • Pure veg</p>
                            <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="icofont-wall-clock"></i> 15–25 min</span> <span class="float-right text-black-50"> $250 FOR TWO</span></p>
                        </div>
                        <div class="list-card-badge">
                            <span class="badge badge-danger">OFFER</span> <small>65% off | Use Coupon OSAHAN50</small>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<section class="section pt-5 pb-5 bg-white becomemember-section border-bottom">
    <div class="container">
    <div class="section-header text-center white-text">
        <h2>Become one of our Vendors</h2>
        <p>You own a Restaurant,Bar,Supermarket,Pharmacy</p>
        <span class="line"></span>
    </div>
    <div class="row">
        <div class="col-sm-12 text-center">
            <a href="https://askbootstrap.com/preview/osahan-eat/register.html" class="btn btn-warning btn-lg">
            Create an Account <i class="fa fa-chevron-circle-right"></i>
            </a>
        </div>
    </div>
    </div>
</section>
<section class="section pt-5 pb-5 text-center bg-white">
    <div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h5 class="m-0">Operate food store or restaurants? <a href="https://askbootstrap.com/preview/osahan-eat/login.html">Work With Us</a></h5>
        </div>
    </div>
    </div>
</section>
@endsection
