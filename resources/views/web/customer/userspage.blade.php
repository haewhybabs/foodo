@extends('layouts.main') @section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

<!-- Modal -->
@include('web.customer.modal')

<section class="section pt-4 pb-4 osahan-account-page">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="osahan-account-page-left shadow-sm bg-white h-100">
                    <div class="border-bottom p-4">
                        <div class="osahan-user text-center">
                            <div class="osahan-user-media">
                                <img class="mb-3 rounded-pill shadow-sm mt-1" src="{{asset('web/img/icons/usericon.jpg')}}" alt="gurdeep singh osahan">
                                <div class="osahan-user-media-body">
                                <h6 class="mb-2">{{$user->name}}</h6>
                                <p class="mb-1">{{$user->phone_number}}</p>
                                <p>{{Auth::user()->email}}</p>
                                <p ><a href="#" data-toggle="modal" data-target="#credit" style="color:green;">&#8358 {{number_format($user->amount,2)}}</a></p>
                                    <p class="mb-0 text-black font-weight-bold" ><a  class="text-primary mr-3" data-toggle="modal" data-target="#edit-profile-modal" href="#"><i class="icofont-ui-edit"></i> EDIT</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-tabs flex-column border-0 pt-4 pl-4 pb-4" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="orders-tab" data-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="true"><i class="icofont-food-cart"></i> Orders</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="favourites-tab" data-toggle="tab" href="#favourites" role="tab" aria-controls="favourites" aria-selected="false"><i class="icofont-heart"></i> Favourites</a>
                        </li>
                         <li class="nav-item">
                            <a class="nav-link" id="wallet-tab" data-toggle="tab" href="#wallet" role="tab" aria-controls="wallet" aria-selected="false"><i class="icofont-credit-card"></i>Wallet</a>
                        </li>
                        {{--  <li class="nav-item">
                            <a class="nav-link" id="addresses-tab" data-toggle="tab" href="#addresses" role="tab" aria-controls="addresses" aria-selected="false"><i class="icofont-location-pin"></i> Addresses</a>
                        </li>   --}}
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="osahan-account-page-right shadow-sm bg-white p-4">
                    <div class="tab-content" id="myTabContent">
                        @include('web.customer.order')
                        @include('web.customer.favourites')
                        @include('web.customer.wallet')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
