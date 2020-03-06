

@auth
    @if(Auth::user()->role_id==2)
    @else
    <section class="section pt-5 pb-5 becomemember-section border-bottom" style="background-color: #f79e05">
        <div class="container">
            <div class="section-header text-center">
                <h1 style="color: #ffff;">Become one of our Vendors</h1>
                <p class="become-subheading">You own a Restaurant,Bar,Supermarket,Pharmacy</p>
                <span class="line" style="color: #fff;"></span>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <a href="{{URL::TO('vendor-register')}}" class="btn btn-lg" style="border: 1px solid #fff; color: #fff;">
                    Create an Account <i class="fa fa-chevron-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
    @endif
@endauth
@guest
   <section class="section pt-5 pb-5 becomemember-section border-bottom" style="background-color: #f79e05">
      <div class="container">
         <div class="section-header text-center">
            <h1 style="color: #ffff;">Become one of our Vendors</h1>
            <p class="become-subheading">You own a Restaurant,Bar,Supermarket,Pharmacy</p>
            <span class="line" style="color: #fff;"></span>
         </div>
         <div class="row">
            <div class="col-sm-12 text-center">
                  <a href="{{URL::TO('vendor-register')}}" class="btn btn-lg" style="border: 1px solid #fff; color: #fff;">
                  Create an Account <i class="fa fa-chevron-circle-right"></i>
                  </a>
            </div>
         </div>
      </div>
   </section>
@endguest


<section class="footer pt-5 pb-5" style="background-color: black;">
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
            <p><a class="text-info" href="{{URL::TO('register')}}">Register now</a></p>
            {{-- <div class="app">
               <p class="mb-2">DOWNLOAD APP</p>
               <a href="#">
               <img class="img-fluid" src="https://askbootstrap.com/preview/osahan-eat/img/google.png">
               </a>
               <a href="#">
               <img class="img-fluid" src="https://askbootstrap.com/preview/osahan-eat/img/apple.png">
               </a>
            </div> --}}
         </div>
         
         <div class="col-md-2 col-6 col-sm-4">
            <h6 class="mb-3 text-white">Cities</h6>
             <?php $cities=DB::table('cities')->get();?>
             <ul>
                @foreach($cities as $city)
                    <li style="color:#6c8293;">{{$city->name}}</li>
                @endforeach

             </ul>
         </div>
         <div class="col-md-2 col-6 col-sm-4">
            <h6 class="mb-3 text-white">Regions</h6>
              <?php $regions = DB::table('vendor_region')->join('regions','regions.idregions','=','vendor_region.region_id')->get();?>
            <ul>
                 @foreach($regions as $region)
                    <li style="color:#6c8293;">{{$region->name}}</li>
                 @endforeach

            </ul>
         </div>
         <div class="col-md-2 m-none col-4 col-sm-4">
            <h6 class="mb-3 text-white">For Restaurants</h6>
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

<footer class="pt-4 pb-4 text-center" style="background-color: black; color: white;">
   <div class="container">
      <p class="mt-0 mb-0">© Copyright {{date('Y')}} All Rights Reserved</p>
      <small class="mt-0 mb-0"> Made with <i class="fas fa-heart heart-icon text-danger"></i> by
      <a class="text-danger"  href="#">FoodXyme</a> - <a class="text-primary" target="_blank">ProXyme</a>
      </small>
   </div>
</footer>



 
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
 

@if(Request::segment(1) != 'Restaurants')
 <!--Start of Tawk.to Script-->
   <script type="text/javascript">
      var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
      (function(){
      var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
      s1.async=true;
      s1.src='https://embed.tawk.to/5e580c66a89cda5a18884ef8/default';
      s1.charset='UTF-8';
      s1.setAttribute('crossorigin','*');
      s0.parentNode.insertBefore(s1,s0);
      })();
   </script>
@endif

   <!--End of Tawk.to Script-->
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
