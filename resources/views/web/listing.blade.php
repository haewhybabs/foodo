@extends('layouts.main')
@section('content')
      <section class="breadcrumb-osahan pt-5 pb-5 bg-dark position-relative text-center">
         <h1 class="text-white">{{ $category_name }} in your Area</h1>
         <h6 class="text-white-50">Best deals at your favourite {{ $category_name }}</h6>
      </section>
       <section class="section pt-5 pb-5 products-listing">
         <div class="container">
            <div class="row d-none-m">
               <div class="col-md-12">
                  <div class="dropdown float-right">
                     <a class="btn btn-outline-info dropdown-toggle btn-sm border-white-btn" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     Sort by: <span class="text-theme">Distance</span> &nbsp;&nbsp;
                     </a>
                     <div class="dropdown-menu dropdown-menu-right shadow-sm border-0 ">
                        <a class="dropdown-item" href="#">Distance</a>
                        <a class="dropdown-item" href="#">No Of Offers</a>
                        <a class="dropdown-item" href="#">Rating</a>
                     </div>
                  </div>
                  <h4 class="font-weight-bold mt-0 mb-3">OFFERS <small class="h6 mb-0 ml-2">{{count($vendors)}} {{$category_name}}
                     </small>
                  </h4>
               </div>
            </div>
            <div class="row">
               <div class="col-md-3">
                  <div class="filters shadow-sm rounded bg-white mb-4">
                     <div class="filters-header border-bottom pl-4 pr-4 pt-3 pb-3">
                        <h5 class="m-0">Filter By</h5>
                     </div>
                     <div class="filters-body">
                        <div id="accordion">
                           <div class="filters-card border-bottom p-4">
                              <div class="filters-card-header" id="headingOne">
                                 <h6 class="mb-0">
                                    <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Categories <i class="icofont-arrow-down float-right"></i>
                                    </a>
                                 </h6>
                              </div>
                              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                 <div class="filters-card-body card-shop-filters">
                                    @foreach ($categories as $category)
                                        <div class="custom-control custom-checkbox">
                                            <a href="{{URL::TO('category')}}/{{ $category->name }}" style="color:black;"class="custom-control-label">{{$category->name}}</a>
                                        </div>
                                    @endforeach
                                 </div>
                              </div>
                           </div>
                           <div class="filters-card border-bottom p-4">
                              <div class="filters-card-header" id="headingTwo">
                                 <h6 class="mb-0">
                                    <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapsetwo" aria-expanded="true" aria-controls="collapsetwo">
                                        Regions
                                        <i class="icofont-arrow-down float-right"></i>
                                    </a>
                                 </h6>
                              </div>
                              <div id="collapsetwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion">
                                 <div class="filters-card-body card-shop-filters">
                                    @foreach ($regions as $region)
                                        <div class="custom-control custom-checkbox">
                                            <a href="{{URL::TO('region-filter')}}/{{ $region->idregions }}" style="color:black;"class="custom-control-label">{{$region->name}}</a>
                                        </div>
                                    @endforeach
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

               </div>
               <div class="col-md-9">
                    <div class="owl-carousel owl-carousel-category owl-theme">
                        @foreach($categories as $category)
                        <div class="item">
                            <div class="osahan-category-item">
                                <a href="{{URL::TO('category')}}/{{ $category->name }}">
                                    <img class="img-fluid" src="{{ $category->icon }}" alt="">
                                    <h6>{{ $category->name }}</h6>
                                    <?php $count=count(DB::table('vendors')->where('category_id',$category->idcategories)->get());?>
                                <p>{{$count}}</p>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <?php $now= time()+3600; $time=(int)date('H',$now);?>
                        @foreach($vendors as $vendor)
                            <div class="col-md-4 col-sm-6 mb-4 pb-2">
                                <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                <div class="list-card-image">
                                    <div class="star position-absolute"><span class="badge badge-warning"><i class="icofont-star"></i> {{$vendor->rating}}</span></div>
                                    <div class="favourite-heart text-danger position-absolute"><a href="{{ URL::TO('') }}/{{ $category_name }}/{{ $vendor->idvendors }}/{{ $vendor->store_name }}"><i class="icofont-heart"></i></a></div>
                                    <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                                    @if($time>=$vendor->open_at and $time<=$vendor->close_at+12)
                                        <a href="{{ URL::TO('') }}/{{ $category_name }}/{{ $vendor->idvendors }}/{{ $vendor->store_name }}">
                                            <img src="{{ $vendor->logo }}" class="img-fluid item-img">
                                        </a>
                                    @else
                                        <a>
                                            <img src="{{ asset('web/img/icons/closed.jpeg') }}" class="img-fluid item-img">
                                        </a>
                                    @endif
                                </div>
                                <div class="p-3 position-relative">
                                    <div class="list-card-body">
                                        <h6 class="mb-1"><a href="{{ URL::TO('') }}/{{ $category_name }}/{{ $vendor->idvendors }}/{{ $vendor->store_name }}" class="text-black">{{ $vendor->store_name }}</a></h6>
                                        <p class="text-gray mb-3">{{ $vendor->description }}</p>
                                    <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="icofont-wall-clock"></i>opens at {{$vendor->open_at}}am</span> <span class="float-right text-black-50">closes at {{$vendor->close_at}}pm</span></p>
                                    </div>
                                    <div class="list-card-badge">
                                        {{--  <span class="badge badge-success">OFFER</span> <small>65% off | Use Coupon OSAHAN50</small>  --}}
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
