@extends('layouts.main')
@section('content')
      <!-- Modal -->
      <div class="modal fade" id="add-address-modal" tabindex="-1" role="dialog" aria-labelledby="add-address" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="add-address">Add Delivery Address</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <form method="POST" action="{{URL::TO('add-address')}}">
                    @csrf
                    <div class="modal-body">

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Select City</label>
                                <select class="form-control" name="city_id">
                                    @foreach($cities as $city)
                                        <option value="{{$city->idcities}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Select Region</label>
                                <select class="form-control" name="region_id">
                                    <option value="">Select Region</option>
                                    @foreach($regions as $region)
                                        <option value="{{$region->idregions}}">{{$region->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputPassword4">Complete Address
                                </label>
                                <input type="text" class="form-control" placeholder="Complete Address e.g. house number, street name, landmark" name="complete_address" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputPassword4">Delivery Instructions<span style="color:red;">(Optional)</span>
                                </label>
                                <input type="text" class="form-control" placeholder="Delivery Instructions e.g. Opposite Gold Souk Mall" name="delivery_instruction">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputPassword4">Delivery Phone Number<span style="color:red;">(Optional)</span>
                                </label>
                                <input type="text" class="form-control" placeholder="Incase the order is for someone else" name="phone_number">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn d-flex w-50 text-center justify-content-center btn-outline-warning" data-dismiss="modal">CANCEL
                        </button> <button type="submit" class="btn d-flex w-50 text-center justify-content-center btn-warning">SUBMIT</button>
                    </div>
                </form>
            </div>
         </div>
      </div>



      <section class="offer-dedicated-body mt-4 mb-4 pt-2 pb-2">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="offer-dedicated-body-left">

                        <div class="bg-white rounded shadow-sm p-4 mb-4">
                            <h4 class="mb-1">Select Delivery Address</h4>
                            <h6 class="mb-3 text-black-50">Multiple addresses in this location</h6>
                            <div class="row">
                                @if($activeStatus==1)
                                    <div class="col-md-6">
                                        <div class="bg-white card addresses-item mb-4 border border-success">
                                        <div class="gold-members p-4">
                                            <div class="media">
                                                <div class="mr-3"><i class="icofont-ui-home icofont-3x"></i></div>
                                                <div class="media-body">
                                                <h6 class="mb-1 text-black">{{$activeAddress->name}}</h6>
                                                    <p class="text-black">{{$activeAddress->complete_address}}
                                                    </p>
                                                    <p class="text-black">{{$activeAddress->delivery_instruction}}
                                                    </p>

                                                    <div class="row">
                                                    <a class="btn btn-xs btn-success mr-1" href="{{URL::TO('change-address')}}/{{$activeAddress->idaddress}}">Change Address</a><br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                @else

                                    @foreach($address as $ad)
                                        <div class="col-md-6">
                                            <div class="bg-white card addresses-item mb-4 border border-success">
                                                <div class="gold-members p-4">
                                                    <div class="media">
                                                    <div class="mr-3"><i class="icofont-ui-home icofont-3x"></i></div>
                                                    <div class="media-body">
                                                    <h6 class="mb-1 text-black">{{$ad->name}}</h6>
                                                        <p class="text-black">{{$ad->complete_address}}
                                                        </p>
                                                        <p class="text-black">{{$ad->delivery_instruction}}
                                                        </p>
                                                        <div class="row">
                                                        <a class="btn btn-xs btn-success mr-1" href="{{URL::to('deliver-here')}}/{{$ad->idaddress}}"> DELIVER HERE</a><br>
                                                                <a class="btn btn-xs btn-warning mr-1" href="{{URL::to('remove-address')}}/{{$ad->idaddress}}">REMOVE</a>
                                                        </div>


                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="col-md-6">
                                        <div class="bg-white card addresses-item">
                                            <div class="gold-members p-4">
                                                <div class="media">
                                                <div class="mr-3"><i class="icofont-location-pin icofont-3x"></i></div>
                                                <div class="media-body">
                                                    <h6 class="mb-1 text-secondary">Tell us your address</h6>
                                                    <p>Let's deliver you food to your location
                                                    </p>
                                                    <p class="mb-0 text-black font-weight-bold"><a data-toggle="modal" data-target="#add-address-modal" class="btn btn-sm btn-primary mr-2" href="#"> ADD NEW ADDRESS</a>
                                                    </p>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endif
                            </div>
                        </div>

                        <div class="pt-2"></div>

                    </div>
                </div>

                <div class="col-md-4">
                    <div class="generator-bg rounded  mb-4 p-4 osahan-cart-item">
                        <h5 class="mb-1">Your Order</h5>
                        <div class="jquerycartshow">
    
                            @if(!session()->get('cart'))
                                <p class="mb-4 text-white">0 ITEMS</p>
                            @else
                                <p class="mb-4 text-white">{{count(session('cart'))}} ITEMS</p>
                                <form method="get" action="{{URL::TO('checkout')}}">
                                    @csrf
                                    
                                    
                                    @foreach(session()->get('cart') as $id=>$detail)
                                        <div class="dropdown-divider"></div>
                                        <div>
                                            <span>
                                            <p class="float-right" style="color: black; font-weight: bold;">&#8358 {{$detail['price']}}</p>
                                                <div>
                                                <p style="color: black; font-weight: bold;">{{$detail['name']}}</p>
                                                </div>
                                            </span>
    
                                            @if(count($detail['proteins']) !=0)
                                                @foreach($detail['proteins'] as $protein)
                                                <span>
                                                    <p class="float-right">{{$protein['qty']}}</p>
                                                    <div>
                                                        <p>{{$protein['name']}}</p>
                                                    </div>
                                                </span>
                                                @endforeach
                                            @endif
    
                                        
                                            <div class="float-right">
                                                <div class="media">
                                                    
                                                    <input class="quantityUpdate" style="width: 40px; margin-left: 5px;" readonly data-id="{{$id}}" type="text" value="{{$detail['quantity']}}" name="quantity[]">
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="mr-2"></div>
                                                <div class="media-body">
                                                    {{-- <a href="#" class="mb-0 text-black removecart" data-id="{{$id}}">Remove</a> --}}
                                                    {{-- <a href="#" class="removecart" data-id="{{$id}}"><i class="fa fa-trash-alt"></i></a> --}}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
    
                                    
                                    <div class="mb-2 bg-white rounded p-2 clearfix">
                                        <img class="img-fluid float-left" src="https://askbootstrap.com/preview/osahan-eat/img/wallet-icon.png">
                                        <h6 class="font-weight-bold text-right mb-2">Subtotal : <span class="text-danger">&#8358 {{session()->get('cartAmount')}}</span></h6>
                                        @if($service_charge !=0)
                                            <p class="mb-1">Charges <span class="float-right text-dark">&#8358 {{$service_charge}}</span></p>
                                        @endif
                                        <p class="mb-1">Delivery Fee <span class="text-info" data-toggle="tooltip" data-placement="top" title="Total discount breakup">
                                            <i class="icofont-info-circle"></i>
                                            </span> <span class="float-right text-dark">&#8358 {{$delivery_fee + $charges}}</span>
                                        </p>
                                        <p class="mb-1 text-success">Total
                                            <span class="float-right text-success">&#8358 {{session()->get('cartAmount') + $service_charge+$delivery_fee}}</span>
                                        </p>                        
                                        <h6 class="font-weight-bold mb-0">TO PAY  <span class="float-right">&#8358 {{session()->get('cartAmount') + $service_charge+$delivery_fee}}</span></h6>
                                    </div>
                                    {{-- <a href="https://askbootstrap.com/preview/osahan-eat/checkout.html" class="btn btn-success btn-block btn-lg">Checkout <i class="icofont-long-arrow-right"></i></a> --}}
                                    {{-- <button type ="submit" class="btn btn-success btn-block btn-lg">Checkout</button> --}}
                                </form>
                            @endif
                        </div>
                       
                    </div>
                    <div class="pt-2"></div>
                </div>

            </div>

            <div class="form-group col-md-12 mb-0">
                <form method="POST" action="{{URL::TO('transaction')}}">
                    @csrf

                    <div>
                        <label>Pay From Wallet</label>
                        <input type="checkbox" name="wallet" value="1">
                    </div>
                    <button type="submit" class="btn btn-warning btn-block btn-lg">PAY &#8358 {{session()->get('cartAmount') + $service_charge+$delivery_fee}}
                        <i class="icofont-long-arrow-right"></i></a>
                    </button>
                </form>
            </div>
        </div>
      </section>

@endsection
