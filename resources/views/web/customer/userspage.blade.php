@extends('layouts.main') @section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

<!-- Modal -->
{{--  @include('web.customer.modal')  --}}

<section class="section pt-4 pb-4 osahan-account-page">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="osahan-account-page-left shadow-sm bg-white h-100">
                    <div class="border-bottom p-4">
                        <div class="osahan-user text-center">
                            <div class="osahan-user-media">
                                <img class="mb-3 rounded-pill shadow-sm mt-1" src="https://askbootstrap.com/preview/osahan-eat/img/user/4.png" alt="gurdeep singh osahan">
                                <div class="osahan-user-media-body">
                                <h6 class="mb-2">{{$user->name}}</h6>
                                <p class="mb-1">{{$user->phone_number}}</p>
                                <p>{{Auth::user()->email}}</p>
                                    <p class="mb-0 text-black font-weight-bold"><a class="text-primary mr-3" data-toggle="modal" data-target="#edit-profile-modal" href="#"><i class="icofont-ui-edit"></i> EDIT</a></p>
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
                            <a class="nav-link" id="favourites-tab" data-toggle="tab" href="#favourites" role="tab" aria-controls="favourites" aria-selected="false"><i class="icofont-heart"></i> Favourites</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="payments-tab" data-toggle="tab" href="#payments" role="tab" aria-controls="payments" aria-selected="false"><i class="icofont-credit-card"></i> Payments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="addresses-tab" data-toggle="tab" href="#addresses" role="tab" aria-controls="addresses" aria-selected="false"><i class="icofont-location-pin"></i> Addresses</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="osahan-account-page-right shadow-sm bg-white p-4 h-100">
                    <div class="tab-content" id="myTabContent">
                        @include('web.customer.order')

                        {{--  @include('web.vendor.stock')  --}}

                        <div class="tab-pane fade" id="favourites" role="tabpanel" aria-labelledby="favourites-tab">
                            <h4 class="font-weight-bold mt-0 mb-4">Favourites</h4>
                            <div class="row">
                                <div class="col-md-4 col-sm-6 mb-4 pb-2">
                                    <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                        <div class="list-card-image">
                                            <div class="star position-absolute"><span class="badge badge-success"><i class="icofont-star"></i> 3.1 (300+)</span></div>
                                            <div class="favourite-heart text-danger position-absolute"><a href="https://askbootstrap.com/preview/osahan-eat/detail.html"><i class="icofont-heart"></i></a></div>
                                            <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                                            <a href="https://askbootstrap.com/preview/osahan-eat/detail.html">
                                                <img src="https://askbootstrap.com/preview/osahan-eat/img/list/4.png" class="img-fluid item-img">
                                            </a>
                                        </div>
                                        <div class="p-3 position-relative">
                                            <div class="list-card-body">
                                                <h6 class="mb-1"><a href="https://askbootstrap.com/preview/osahan-eat/detail.html" class="text-black">Famous Dave's Bar-B-Que
                                             </a>
                                          </h6>
                                                <p class="text-gray mb-3">Vegetarian • Indian • Pure veg</p>
                                                <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="icofont-wall-clock"></i> 15–30 min</span> <span class="float-right text-black-50"> $350 FOR TWO</span></p>
                                            </div>
                                            <div class="list-card-badge">
                                                <span class="badge badge-danger">OFFER</span> <small> Use Coupon OSAHAN50</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-4 pb-2">
                                    <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                        <div class="list-card-image">
                                            <div class="star position-absolute"><span class="badge badge-success"><i class="icofont-star"></i> 3.1 (300+)</span></div>
                                            <div class="favourite-heart text-danger position-absolute"><a href="https://askbootstrap.com/preview/osahan-eat/detail.html"><i class="icofont-heart"></i></a></div>
                                            <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                                            <a href="https://askbootstrap.com/preview/osahan-eat/detail.html">
                                                <img src="https://askbootstrap.com/preview/osahan-eat/img/list/5.png" class="img-fluid item-img">
                                            </a>
                                        </div>
                                        <div class="p-3 position-relative">
                                            <div class="list-card-body">
                                                <h6 class="mb-1"><a href="https://askbootstrap.com/preview/osahan-eat/detail.html" class="text-black">Thai Famous Cuisine</a></h6>
                                                <p class="text-gray mb-3">North Indian • Indian • Pure veg</p>
                                                <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="icofont-wall-clock"></i> 30–35 min</span> <span class="float-right text-black-50"> $250 FOR TWO</span></p>
                                            </div>
                                            <div class="list-card-badge">
                                                <span class="badge badge-success">OFFER</span> <small>65% off</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-4 pb-2">
                                    <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                        <div class="list-card-image">
                                            <div class="star position-absolute"><span class="badge badge-success"><i class="icofont-star"></i> 3.1 (300+)</span></div>
                                            <div class="favourite-heart text-danger position-absolute"><a href="https://askbootstrap.com/preview/osahan-eat/detail.html"><i class="icofont-heart"></i></a></div>
                                            <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                                            <a href="https://askbootstrap.com/preview/osahan-eat/detail.html">
                                                <img src="https://askbootstrap.com/preview/osahan-eat/img/list/6.png" class="img-fluid item-img">
                                            </a>
                                        </div>
                                        <div class="p-3 position-relative">
                                            <div class="list-card-body">
                                                <h6 class="mb-1"><a href="https://askbootstrap.com/preview/osahan-eat/detail.html" class="text-black">The osahan Restaurant
                                             </a>
                                          </h6>
                                                <p class="text-gray mb-3">North • Hamburgers • Pure veg</p>
                                                <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="icofont-wall-clock"></i> 15–25 min</span> <span class="float-right text-black-50"> $500 FOR TWO</span></p>
                                            </div>
                                            <div class="list-card-badge">
                                                <span class="badge badge-danger">OFFER</span> <small>65% OSAHAN50</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-4 pb-2">
                                    <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                        <div class="list-card-image">
                                            <div class="star position-absolute"><span class="badge badge-success"><i class="icofont-star"></i> 3.1 (300+)</span></div>
                                            <div class="favourite-heart text-danger position-absolute"><a href="https://askbootstrap.com/preview/osahan-eat/detail.html"><i class="icofont-heart"></i></a></div>
                                            <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                                            <a href="https://askbootstrap.com/preview/osahan-eat/detail.html">
                                                <img src="https://askbootstrap.com/preview/osahan-eat/img/list/7.png" class="img-fluid item-img">
                                            </a>
                                        </div>
                                        <div class="p-3 position-relative">
                                            <div class="list-card-body">
                                                <h6 class="mb-1"><a href="https://askbootstrap.com/preview/osahan-eat/detail.html" class="text-black">Stan's Restaurant
                                             </a>
                                          </h6>
                                                <p class="text-gray mb-3">North Indian • Indian • Pure veg</p>
                                                <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="icofont-wall-clock"></i> 15–25 min</span> <span class="float-right text-black-50"> $250 FOR TWO</span></p>
                                            </div>
                                            <div class="list-card-badge">
                                                <span class="badge badge-danger">OFFER</span> <small>65% Coupon OSAHAN50</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-4 pb-2">
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
                                                <h6 class="mb-1"><a href="https://askbootstrap.com/preview/osahan-eat/detail.html" class="text-black">Polo Lounge
                                             </a>
                                          </h6>
                                                <p class="text-gray mb-3">North Indian • Indian • Pure veg</p>
                                                <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="icofont-wall-clock"></i> 15–25 min</span> <span class="float-right text-black-50"> $250 FOR TWO</span></p>
                                            </div>
                                            <div class="list-card-badge">
                                                <span class="badge badge-danger">OFFER</span> <small> Coupon OSAHAN50</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-4 pb-2">
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
                                                <h6 class="mb-1"><a href="https://askbootstrap.com/preview/osahan-eat/detail.html" class="text-black">Jack Fry's
                                             </a>
                                          </h6>
                                                <p class="text-gray mb-3">North Indian • Indian • Pure veg</p>
                                                <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="icofont-wall-clock"></i> 15–25 min</span> <span class="float-right text-black-50"> $250 FOR TWO</span></p>
                                            </div>
                                            <div class="list-card-badge">
                                                <span class="badge badge-danger">OFFER</span> <small>65% </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 text-center load-more">
                                    <button class="btn btn-primary" type="button" disabled>
                                        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Loading...
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="payments" role="tabpanel" aria-labelledby="payments-tab">
                            <h4 class="font-weight-bold mt-0 mb-4">Payments</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="bg-white card payments-item mb-4 shadow-sm">
                                        <div class="gold-members p-4">
                                            <a href="#">
                                                <div class="media">
                                                    <img class="mr-3" src="https://askbootstrap.com/preview/osahan-eat/img/bank/1.png" alt="Generic placeholder image">
                                                    <div class="media-body">
                                                        <h6 class="mb-1">6070-XXXXXXXX-0666</h6>
                                                        <p>VALID TILL 10/2025</p>
                                                        <p class="mb-0 text-black font-weight-bold">
                                                            <a class="text-danger" data-toggle="modal" data-target="#delete-address-modal" href="#"><i class="icofont-ui-delete"></i> DELETE</a></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="bg-white card payments-item mb-4 shadow-sm">
                                        <div class="gold-members p-4">
                                            <a href="#">
                                                <div class="media">
                                                    <img class="mr-3" src="https://askbootstrap.com/preview/osahan-eat/img/bank/2.png" alt="Generic placeholder image">
                                                    <div class="media-body">
                                                        <h6 class="mb-1">6070-XXXXXXXX-0666</h6>
                                                        <p>VALID TILL 10/2025</p>
                                                        <p class="mb-0 text-black font-weight-bold">
                                                            <a class="text-danger" data-toggle="modal" data-target="#delete-address-modal" href="#"><i class="icofont-ui-delete"></i> DELETE</a></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row pt-2 pb-2">
                                <div class="col-md-6">
                                    <div class="bg-white card payments-item mb-4 shadow-sm">
                                        <div class="gold-members p-4">
                                            <a href="#">
                                                <div class="media">
                                                    <img class="mr-3" src="https://askbootstrap.com/preview/osahan-eat/img/bank/3.png" alt="Generic placeholder image">
                                                    <div class="media-body">
                                                        <h6 class="mb-1">6070-XXXXXXXX-0666</h6>
                                                        <p>VALID TILL 10/2025</p>
                                                        <p class="mb-0 text-black font-weight-bold">
                                                            <a class="text-danger" data-toggle="modal" data-target="#delete-address-modal" href="#"><i class="icofont-ui-delete"></i> DELETE</a></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="bg-white card payments-item mb-4 shadow-sm">
                                        <div class="gold-members p-4">
                                            <a href="#">
                                                <div class="media">
                                                    <img class="mr-3" src="https://askbootstrap.com/preview/osahan-eat/img/bank/4.png" alt="Generic placeholder image">
                                                    <div class="media-body">
                                                        <h6 class="mb-1">6070-XXXXXXXX-0666</h6>
                                                        <p>VALID TILL 10/2025</p>
                                                        <p class="mb-0 text-black font-weight-bold">
                                                            <a class="text-danger" data-toggle="modal" data-target="#delete-address-modal" href="#"><i class="icofont-ui-delete"></i> DELETE</a></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="bg-white card payments-item mb-4 shadow-sm">
                                        <div class="gold-members p-4">
                                            <a href="#">
                                                <div class="media">
                                                    <img class="mr-3" src="https://askbootstrap.com/preview/osahan-eat/img/bank/5.png" alt="Generic placeholder image">
                                                    <div class="media-body">
                                                        <h6 class="mb-1">6070-XXXXXXXX-0666</h6>
                                                        <p>VALID TILL 10/2025</p>
                                                        <p class="mb-0 text-black font-weight-bold">
                                                            <a class="text-danger" data-toggle="modal" data-target="#delete-address-modal" href="#"><i class="icofont-ui-delete"></i> DELETE</a></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="bg-white card payments-item mb-4 shadow-sm">
                                        <div class="gold-members p-4">
                                            <a href="#">
                                                <div class="media">
                                                    <img class="mr-3" src="https://askbootstrap.com/preview/osahan-eat/img/bank/6.png" alt="Generic placeholder image">
                                                    <div class="media-body">
                                                        <h6 class="mb-1">6070-XXXXXXXX-0666</h6>
                                                        <p>VALID TILL 10/2025</p>
                                                        <p class="mb-0 text-black font-weight-bold">
                                                            <a class="text-danger" data-toggle="modal" data-target="#delete-address-modal" href="#"><i class="icofont-ui-delete"></i> DELETE</a></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-md-6">
                                    <div class="bg-white card payments-item shadow-sm">
                                        <div class="gold-members p-4">
                                            <a href="#">
                                                <div class="media">
                                                    <img class="mr-3" src="https://askbootstrap.com/preview/osahan-eat/img/bank/1.png" alt="Generic placeholder image">
                                                    <div class="media-body">
                                                        <h6 class="mb-1">6070-XXXXXXXX-0666</h6>
                                                        <p class="text-black">VALID TILL 10/2025</p>
                                                        <p class="mb-0 text-black font-weight-bold">
                                                            <a class="text-danger" data-toggle="modal" data-target="#delete-address-modal" href="#"><i class="icofont-ui-delete"></i> DELETE</a></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="bg-white card payments-item shadow-sm">
                                        <div class="gold-members p-4">
                                            <a href="#">
                                                <div class="media">
                                                    <img class="mr-3" src="https://askbootstrap.com/preview/osahan-eat/img/bank/2.png" alt="Generic placeholder image">
                                                    <div class="media-body">
                                                        <h6 class="mb-1">6070-XXXXXXXX-0666</h6>
                                                        <p>VALID TILL 10/2025</p>
                                                        <p class="mb-0 text-black font-weight-bold">
                                                            <a class="text-danger" data-toggle="modal" data-target="#delete-address-modal" href="#"><i class="icofont-ui-delete"></i> DELETE</a></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
