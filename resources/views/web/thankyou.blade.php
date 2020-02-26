@extends('layouts.main')
@section('content')
<section class="section pt-5 pb-5 osahan-not-found-page">
   <div class="container">
      <div class="row">
         <div class="col-md-12 text-center pt-5 pb-5">
            <img class="img-fluid mb-5" src="https://askbootstrap.com/preview/osahan-eat/img/thanks.png" alt="404">
            <h1 class="mt-2 mb-2 text-success">Congratulations!</h1>
            <p class="mb-5">You have successfully placed your order</p>
            <a class="btn btn-warning btn-lg" href="{{URL::TO('user-account')}}">Track Order :)</a>
         </div>
      </div>
   </div>
</section>
@endsection



