@extends('layouts.main') @section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

<!-- Modal -->
@include('web.vendor.modal')

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
                                <h6 class="mb-2">{{$user->store_name}}</h6>
                                <p class="mb-1">{{$user->phone_number}}</p>
                                <p>{{Auth::user()->email}}</p>
                                <p ><a href="#" style="color:green;">&#8358 {{$vendorMoney}}</a></p>
                                    <p class="mb-0 text-black font-weight-bold"><a class="text-primary mr-3" data-toggle="modal" data-target="#edit-profile-modal" href="#"><i class="icofont-ui-edit"></i>Bank Update</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-tabs flex-column border-0 pt-4 pl-4 pb-4" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="orders-tab" data-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="true"><i class="icofont-food-cart"></i> Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="stock-tab" data-toggle="tab" href="#stock" role="tab" aria-controls="stock" aria-selected="false"><i class="icofont-sale-discount"></i>Stocks</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="credits-tab" data-toggle="tab" href="#credits" role="tab" aria-controls="credits" aria-selected="false"><i class="icofont-heart"></i>Credits</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="payments-tab" data-toggle="tab" href="#payments" role="tab" aria-controls="payments" aria-selected="false"><i class="icofont-credit-card"></i>Withdrawal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="addresses-tab" data-toggle="tab" href="#addresses" role="tab" aria-controls="addresses" aria-selected="false"><i class="icofont-location-pin"></i> Addresses</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="osahan-account-page-right shadow-sm bg-white p-4">
                    <div class="tab-content" id="myTabContent">
                        @include('web.vendor.vendor-order')

                        @include('web.vendor.stock')

                        @include('web.vendor.credits')

                        @include('web.vendor.withdrawal')
                        
                        <div class="tab-pane fade" id="addresses" role="tabpanel" aria-labelledby="addresses-tab">
                            <h4 class="font-weight-bold mt-0 mb-4">Manage Addresses</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="bg-white card addresses-item mb-4 border border-primary shadow">
                                        <div class="gold-members p-4">
                                            <div class="media">
                                                <div class="mr-3"><i class="icofont-ui-home icofont-3x"></i></div>
                                                <div class="media-body">
                                                    <h6 class="mb-1 text-secondary">Home</h6>
                                                    <p class="text-black">Osahan House, Jawaddi Kalan, Ludhiana, Punjab 141002, India
                                                    </p>
                                                    <p class="mb-0 text-black font-weight-bold"><a class="text-primary mr-3" data-toggle="modal" data-target="#add-address-modal" href="#"><i class="icofont-ui-edit"></i> EDIT</a> <a class="text-danger" data-toggle="modal" data-target="#delete-address-modal" href="#"><i class="icofont-ui-delete"></i> DELETE</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="bg-white card addresses-item mb-4 shadow-sm">
                                        <div class="gold-members p-4">
                                            <div class="media">
                                                <div class="mr-3"><i class="icofont-briefcase icofont-3x"></i></div>
                                                <div class="media-body">
                                                    <h6 class="mb-1">Work</h6>
                                                    <p>NCC, Model Town Rd, Pritm Nagar, Model Town, Ludhiana, Punjab 141002, India
                                                    </p>
                                                    <p class="mb-0 text-black font-weight-bold"><a class="text-primary mr-3" data-toggle="modal" data-target="#add-address-modal" href="#"><i class="icofont-ui-edit"></i> EDIT</a> <a class="text-danger" data-toggle="modal" data-target="#delete-address-modal" href="#"><i class="icofont-ui-delete"></i> DELETE</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row pt-2 pb-2">
                                <div class="col-md-6">
                                    <div class="bg-white card addresses-item mb-4  shadow-sm">
                                        <div class="gold-members p-4">
                                            <div class="media">
                                                <div class="mr-3"><i class="icofont-location-pin icofont-3x"></i></div>
                                                <div class="media-body">
                                                    <h6 class="mb-1">Other</h6>
                                                    <p>Delhi Bypass Rd, Jawaddi Taksal, Ludhiana, Punjab 141002, India
                                                    </p>
                                                    <p class="mb-0 text-black font-weight-bold"><a class="text-primary mr-3" data-toggle="modal" data-target="#add-address-modal" href="#"><i class="icofont-ui-edit"></i> EDIT</a> <a class="text-danger" data-toggle="modal" data-target="#delete-address-modal" href="#"><i class="icofont-ui-delete"></i> DELETE</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="bg-white card addresses-item mb-4  shadow-sm">
                                        <div class="gold-members p-4">
                                            <div class="media">
                                                <div class="mr-3"><i class="icofont-location-pin icofont-3x"></i></div>
                                                <div class="media-body">
                                                    <h6 class="mb-1">Other</h6>
                                                    <p>MT, Model Town Rd, Pritm Nagar, Model Town, Ludhiana, Punjab 141002, India
                                                    </p>
                                                    <p class="mb-0 text-black font-weight-bold"><a class="text-primary mr-3" data-toggle="modal" data-target="#add-address-modal" href="#"><i class="icofont-ui-edit"></i> EDIT</a> <a class="text-danger" data-toggle="modal" data-target="#delete-address-modal" href="#"><i class="icofont-ui-delete"></i> DELETE</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="bg-white card addresses-item shadow-sm">
                                        <div class="gold-members p-4">
                                            <div class="media">
                                                <div class="mr-3"><i class="icofont-location-pin icofont-3x"></i></div>
                                                <div class="media-body">
                                                    <h6 class="mb-1">Other</h6>
                                                    <p>GNE Rd, Jawaddi Taksal, Ludhiana, Punjab 141002, India
                                                    </p>
                                                    <p class="mb-0 text-black font-weight-bold"><a class="text-primary mr-3" data-toggle="modal" data-target="#add-address-modal" href="#"><i class="icofont-ui-edit"></i> EDIT</a> <a class="text-danger" data-toggle="modal" data-target="#delete-address-modal" href="#"><i class="icofont-ui-delete"></i> DELETE</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="bg-white card addresses-item shadow-sm">
                                        <div class="gold-members p-4">
                                            <div class="media">
                                                <div class="mr-3"><i class="icofont-location-pin icofont-3x"></i></div>
                                                <div class="media-body">
                                                    <h6 class="mb-1">Other</h6>
                                                    <p>GTTT, Model Town Rd, Pritm Nagar, Model Town, Ludhiana, Punjab 141002, India
                                                    </p>
                                                    <p class="mb-0 text-black font-weight-bold"><a class="text-primary mr-3" data-toggle="modal" data-target="#add-address-modal" href="#"><i class="icofont-ui-edit"></i> EDIT</a> <a class="text-danger" data-toggle="modal" data-target="#delete-address-modal" href="#"><i class="icofont-ui-delete"></i> DELETE</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
