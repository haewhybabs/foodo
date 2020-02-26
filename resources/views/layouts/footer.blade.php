@auth
    @if(Auth::user()->role_id==2)
    @else
    <section class="section pt-5 pb-5 bg-white becomemember-section border-bottom">
        <div class="container">
            <div class="section-header text-center white-text">
                <h2>Become one of our Vendors</h2>
                <p>You own a Restaurant,Bar,Supermarket,Pharmacy</p>
                <span class="line"></span>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <a href="{{URL::TO('vendor-register')}}" class="btn btn-warning btn-lg">
                    Create an Account <i class="fa fa-chevron-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
    @endif
@endauth
@guest
<section class="section pt-5 pb-5 bg-white becomemember-section border-bottom">
    <div class="container">
        <div class="section-header text-center white-text">
            <h2>Become one of our Vendors</h2>
            <p>You own a Restaurant,Bar,Supermarket,Pharmacy</p>
            <span class="line"></span>
        </div>
        <div class="row">
            <div class="col-sm-12 text-center">
                <a href="{{URL::TO('vendor-register')}}" class="btn btn-warning btn-lg">
                Create an Account <i class="fa fa-chevron-circle-right"></i>
                </a>
            </div>

            
        </div>

        
    </div>
</section>
@endguest

<div class="container" id="newsLetterResponse"></div>
<section class="footer pt-5 pb-5">
    <div class="container">
       <div class="row">
         <div class="col-md-4 col-12 col-sm-12">
             <h6 class="mb-3">Subscribe to our Newsletter</h6>
             <form class="newsletter-form mb-1" method="post" id="newsletter">
                @csrf

                <div class="input-group">
                   <input type="email" placeholder="Please enter your email" class="form-control" name="email" required>
                   <div class="input-group-append">
                      <button type="submit" class="btn btn-warning">
                        Subscribe
                      </button>
                   </div>
                </div>
             </form>
            <p>
               <a class="text-info" href="{{URL::TO('register')}}">Register now</a>
            </p>

           
         </div>
          {{-- <div class="col-md-1 col-sm-6 mobile-none">
          </div> --}}
          <div class="col-md-2 col-6 col-sm-4">
             <h6 class="mb-3">Cities</h6>
             <?php $cities=DB::table('cities')->get();?>
             <ul>
                @foreach($cities as $city)
                    <li>{{$city->name}}</li>
                @endforeach

             </ul>
          </div>
          <div class="col-md-2 col-6 col-sm-4">
             <h6 class="mb-3">Regions</h6>
               <?php $regions = DB::table('vendor_region')->join('regions','regions.idregions','=','vendor_region.region_id')->get();?>
             <ul>
                  @foreach($regions as $region)
                     <li>{{$region->name}}</li>
                  @endforeach

             </ul>
          </div>
          <div class="col-md-2 m-none col-4 col-sm-4">
             <h6 class="mb-3">For Restaurants</h6>
             <ul>
                <li><a href="#">Advertise</a></li>
                <li><a href="#">Add a Restaurant</a></li>
                <li><a href="#">Claim your Listing</a></li>
                <li><a href="#">For Businesses</a></li>
                <li><a href="#">Owner Guidelines</a></li>
             </ul>
          </div>
       </div>
    </div>
 </section>
 <section class="footer-bottom-search pt-5 pb-5 bg-white">
    <div class="container">
       <div class="row">
          <div class="col-xl-12">
             <p class="mt-4 text-black">All Vendors</p>
             <div class="search-links">
                 <?php $vendors=DB::table('vendors')->join('categories','categories.idcategories','=','vendors.category_id')->where('vendors.status',2)->get();?>
                 @foreach($vendors as $vendor)
                    <a href="{{URL::TO($vendor->name)}}/{{$vendor->idvendors}}/{{$vendor->store_name}}">{{$vendor->store_name}}</a> |
                 @endforeach
             </div>
          </div>
       </div>
    </div>
 </section>
<script src="http://code.jquery.com/jquery-3.4.0.min.js"></script>
<script>
   $('#newsletter').bind("submit", function(event){
      event.preventDefault();

      var me=$(this);

      $.ajax({
         url:"{{URL::TO('newsletter')}}",
         type:"POST",
         data:me.serialize(),
         dataType:'json',
         success:function(response){
            toastr.success("Success!!!");
         }
      });
   });
</script>
 
 <footer class="pt-4 pb-4 text-center">
    <div class="container">
       <p class="mt-0 mb-0">© Copyright {{date('Y')}} ProXyme All Rights Reserved</p>
    </div>
 </footer>
 <!-- jQuery -->
 <script src="{{asset('web/js/jquery-3.3.1.slim.min.js')}}"></script>
 <!-- Bootstrap core JavaScript-->
 <script src="{{asset('web/js/bootstrap.bundle.min.js')}}"></script>
 <!-- Select2 JavaScript-->
 <script src="{{asset('web/js/select2.min.js')}}"></script>
 <!-- Owl Carousel -->
 <script src="{{asset('web/js/owl.carousel.js')}}"></script>
 <!-- Custom scripts for all pages-->
 <script src="{{asset('web/js/custom.js')}}"></script>

 <script src="{{asset('web/js/jquery-3.4.1.js')}}"></script>
</body>

<!-- Mirrored from askbootstrap.com/preview/osahan-eat/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 28 Dec 2019 10:43:47 GMT -->
</html>
