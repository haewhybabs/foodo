@extends('layouts.main')
@section('content')
<section class="pt-5 pb-5 homepage-search-block position-relative">
    <div class="banner-overlay"></div>
    <div class="container">
    <div class="row d-flex align-items-center">
        <div class="col-md-8">
            <div class="homepage-search-title">
                <h1 class="mb-2 font-weight-normal"><span class="font-weight-bold">Order It</span> Get It at your doorstep</h1>
                <h5 class="mb-5 text-secondary font-weight-normal">Lists of top restaurants, pharmacy, supermarket, and bars, in your area</h5>
            </div>
            <div class="homepage-search-form">
                <form class="form-noborder" method="get" action="{{URL::TO('vendor-search')}}">
                    @csrf
                <div class="form-row">
                    <div class="col-lg-3 col-md-3 col-sm-12 form-group">
                        <div class="location-dropdown">
                            <i class="icofont-location-arrow"></i>
                            <select class="custom-select form-control-lg">
                                {{-- <option>Select City</option> --}}
                                @foreach($cities as $city)
                                    <option href="{{$city->idcities}}">{{$city->name}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-12 form-group">
                        <input type="text" placeholder="Search for Restaurant,Bar,Pharmacy,Supermarket" class="form-control form-control-lg" name="search">
                        <!-- <a class="locate-me" href="#"><i class="icofont-ui-pointer"></i> Locate Me</a> -->
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12 form-group">
                        <button type="submit" class="btn btn-warning btn-block btn-lg btn-gradient">Search</button>
                    </div>
                </div>
                </form>
            </div>
            <h6 class="mt-4 text-shadow font-weight-normal">Choose a Service</h6>
            <div class="owl-carousel owl-carousel-category owl-theme">
                @foreach($categories as $category)
                <div class="item">
                    <div class="osahan-category-item">
                        <a href="{{URL::TO('category')}}/{{ $category->name }}">
                            <img class="img-fluid" src="{{ $category->icon }}" alt="">
                            <h6>{{ $category->name }}</h6>
                            
                        
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Advertisment -->

        <div class="col-md-4">
            <div class="osahan-slider pl-4 pt-3">
                <div class="owl-carousel homepage-ad owl-theme">
                    <div class="item">
                        <a ><img class="img-fluid rounded" src="{{ asset('web/img/foodxymepub1.jpg') }}"></a>
                    </div>
                    <div class="item">
                        <a><img class="img-fluid rounded" src="{{ asset('web/img/febgreetings.jpg') }}"></a>
                    </div>
                    <div class="item">
                        <a><img class="img-fluid rounded" src="{{ asset('web/img/foodxymepub1.jpg') }}"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<!-- Advertisement -->

<section class="section pt-5 pb-5 bg-white homepage-add-section">
    <div class="container">
    <div class="row">
        <div class="col-md-3 col-6">
            <div class="products-box">
            <a href="{{URL::TO('category/Bar')}}"><img alt="" src="https://askbootstrap.com/preview/osahan-eat/img/pro1.jpg" class="img-fluid rounded"></a>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="products-box">
                <a href="{{URL::TO('category/Restaurants')}}"><img alt="" src="https://askbootstrap.com/preview/osahan-eat/img/pro2.jpg" class="img-fluid rounded"></a>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="products-box">
                <a href="{{URL::TO('category/Restaurants')}}"><img alt="" src="https://askbootstrap.com/preview/osahan-eat/img/pro3.jpg" class="img-fluid rounded"></a>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="products-box">
                <a href="{{URL::TO('category/Restaurants')}}"><img alt="" src="https://askbootstrap.com/preview/osahan-eat/img/pro4.jpg" class="img-fluid rounded"></a>
            </div>
        </div>
    </div>
    </div>
</section>

<section class="section pt-5 pb-5 bg-white homepage-add-section">
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
                @foreach($vendors as $vendor)
                    <div class="item">
                        <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                            <div class="list-card-image">
                            <div class="star position-absolute"><span class="badge badge-success"><i class="icofont-star"></i>{{$vendor->rating}}</span></div>
                                <div class="favourite-heart text-danger position-absolute"> <a href="{{ URL::TO('') }}/{{ $vendor->name }}/{{ $vendor->idvendors }}/{{ $vendor->store_name }}"><i class="icofont-heart"></i></a></div>
                                <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                                <a href="{{ URL::TO('') }}/{{ $vendor->name }}/{{ $vendor->idvendors }}/{{ $vendor->store_name }}">
                                <img src="{{$vendor->logo}}" class="img-fluid item-img">
                                </a>
                            </div>
                            <div class="p-3 position-relative">
                                <div class="list-card-body">
                                <h6 class="mb-1"> <a href="{{ URL::TO('') }}/{{ $vendor->name }}/{{ $vendor->idvendors }}/{{ $vendor->store_name }}" class="text-black">{{$vendor->store_name}}</a></h6>
                                    <p class="text-gray mb-3"></p>
                                <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="icofont-wall-clock"></i>Opens at {{$vendor->open_at}}AM</span> <span class="float-right text-black-50">Closes at {{$vendor->close_at}}PM</span></p>
                                </div>
                                <div class="list-card-badge">
                                    <span class="badge badge-success">Address</span> <small>{{$vendor->address}}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>
</section>


@endsection
