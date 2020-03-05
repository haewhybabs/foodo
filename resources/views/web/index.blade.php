@extends('layouts.main')
@section('content')


<section class="homepage-search-block position-relative">
    <div>
       <div style="display: flex; justify-content: space-between;">
          <div class="header-img">
             <img src="{{asset('web/img/web-image.png')}}" alt="">
          </div>
          <div class="col-md-11 col-lg-6 homepage-service">
             <div class="homepage-search-title">
                <h1 class="mb-2 font-weight-normal"><span class="font-weight-bold">Order It</span> Get It at your doorstep</h1>
                <h5 class="mb-5 text-secondary font-weight-normal">Lists of top restaurants, pharmacy, supermarket, and bars, based on trends</h5>
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
                            <input type="text" placeholder="Search for Restaurant,Bar,Pharmacy,Supermarket" class="form-control form-control-lg" name="search" required>
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
          <div class="header-img">
             <img src="{{asset('web/img/web-image2.png')}}" alt="">
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




<section class="section pt-5 pb-5 products-section">
   <div class="container">
      <div class="section-header text-center">
         <h2 class="process-heading">our restaurants</h2>
         <p class="process-intro">Top restaurants, cafes, pubs, and bars in your area, based on trends</p>
         <span class="line" style="background-color: #ffb200 !important;"></span>
      </div>
      <div class="row">
         <div class="col-md-12">
           <div class="owl-carousel owl-carousel-four owl-theme">
               @foreach($vendors as $vendor)
                   <div class="item">
                       <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm restaurants-list">
                            <img src="{{asset('web/img/vendor_1.png')}}" style="height: 100%; width: 100%" class="img-fluid">
                        </div>
                        <div style="position: relative; bottom: 120px; margin-left: 17px;">
                            <h3 style="color: white; font-weight: bold; text-transform: uppercase">Bistrol</h3>
                            <p style="color: white;">Discover all Intercontinental dishes</p>
                            <a href="#" style="color: black; font-weight: bold; border-radius: 15px; margin-top: -4px !important; background-color: white; padding: 7px 10px; text-transform: uppercase;">Order Now</a>
                       </div>
                   </div>
               @endforeach
           </div>

           <div class="text-center" style="margin-top:40px;">
            <a href="{{URL::TO('vendor-register')}}" class="btn btn-lg" style="border: 1px solid #ffb200; color: #ffb200;">
                more restaurant <i class="fa fa-chevron-circle-right"></i>
                </a>
           </div>
         </div>
      </div>
   </div>
</section>

 <!-- Advertisement -->

 <section class="section pt-5 pb-5 bg-white homepage-add-section">
    <!-- <div class="container">
       <div class="text-center order-header">
          <h2 class="order-heading">Order for food from your desired restaurant</h2>
       </div>
       <div style="margin-top: 20px;">
          <h2 class="text-center process-heading">JUST <span style="color: #ffb200; font-size: 70px; font-weight: bold;">3</span>Clicks</h2>
       </div>
       <div class="row" style="margin-top: 40px;">
          <div class="col-sm-4">
             <div class="text-center">
                <img class="process-image" src="./img/first icon.png">
             </div>
          </div>
          <div class="col-sm-4">
             <div class="text-center">
                <img class="process-image" src="img/second icon.png"><br>
             </div>
          </div>
          <div class="col-sm-4">
             <div class="text-center">
                <img class="process-image" src="img/third-icon.png"><br>
             </div>
          </div>
       </div>
    </div> -->

    <div class="container">
       <div class="section-header text-center">
          <h2 class="process-heading">How It Works</h2>
          <span class="line" style="background-color: #ffb200 !important;"></span>
          <p class="process-intro">Foodxyme is an Online Platform (Website and Mobile app) that delivers Healthy food without Stress,
             from your favorite Restaurant within your locality and delivered at your doorstep within 20-25mins after your order,
             with our fast delivery system in place.</p>
       </div>
       <div class="row mt-5">
          <div class="col-sm-4">
             <div class="text-center">
                <!-- <img src="img/icons/cart.png" style="height:60px; width:70px; margin-bottom:20px; color: #ffb200;"> -->
                <i class="icofont-prestashop text-warning" style="font-size: 55px;"></i>
                <h4 style="color: #34323b; margin: 13px 0; font-weight: 400;">Make an Order</h4>
                <p>Order for your desired food</p>
             </div>
          </div>

          <div class="col-sm-4">
             <div class="text-center">
                <!-- <img src="img/icons/location_yellow.png" style="height:60px; width:70px; margin-bottom:20px;"><br> -->
                <i class="icofont-location-pin text-warning" style="font-size: 55px;"></i>
                <h4 style="color: #34323b; margin: 13px 0; font-weight: 400;">Set Delivery Location</h4>
                <p>Select the location where you want us to deliver</p>
             </div>
          </div>

          <div class="col-sm-4">
             <div class="text-center">
                <!-- <img src="img/icons/motorcycle.png" style="height:60px; width:70px; margin-bottom:20px;"><br> -->
                <i class="icofont-motor-bike-alt text-warning" style="font-size: 55px;"></i>
                <h4 style="color: #34323b; margin: 13px 0; font-weight: 400;">Get it at your location</h4>
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
                            <div class="favourite-heart text-danger position-absolute"> <a href="#" data-id="{{$vendor->idvendors}}" class="favourite"><i class="icofont-heart"></i></a></div>
                                <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                                <a href="{{ URL::TO('') }}/{{ $vendor->name }}/{{ $vendor->idvendors }}/{{ $vendor->store_name }}">
                                <img src="{{asset('vendorimages')}}/{{$vendor->logo}}" class="img-fluid item-img">
                                </a>
                            </div>
                            <div class="p-3 position-relative">
                                <div class="list-card-body">
                                <h6 class="mb-1"> <a href="{{ URL::TO('') }}/{{ $vendor->name }}/{{ $vendor->idvendors }}/{{ $vendor->store_name }}" class="text-black">{{$vendor->store_name}}</a></h6>
                                    <p class="text-gray mb-3"></p>
                                <p class="text-gray mb-3 time" style="font-size: 11px;"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="icofont-wall-clock"></i>opens at {{date('h:i A', strtotime($vendor->open_at))}}</span> <span class="float-right text-black-50">closes at {{date('h:i A', strtotime($vendor->close_at))}}</span></p>
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


 <script>

   $(function(){
      $(document).on('click','.favourite',function(e){
            e.preventDefault();

            var id =$(this).attr('data-id');
            $.ajax({
               url:"{{URL::TO('favourite')}}",
               type:"POST",
               dataType:'json',
               data:{
                  vendor_id:id,
                  "_token": "{{ csrf_token() }}"
               },
               success:function(response){

                  if(response.status=='false'){
                     toastr.error(response.message);
                  }
                  else{
                     toastr.success(response.message);
                  }



               }


            });
      });
   });


 </script>


@endsection
