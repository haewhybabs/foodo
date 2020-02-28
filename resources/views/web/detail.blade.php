@extends('layouts.main')
@section('content')
<link href="{{ asset('web/css/detailview.css')}}" rel="stylesheet">
<section class="restaurant-detailed-banner">
    <div class="text-center">
    <img class="img-fluid cover" src="https://askbootstrap.com/preview/osahan-eat/img/mall-dedicated-banner.png">
    </div>
    <div class="restaurant-detailed-header">
    <div class="container">
        <div class="row d-flex align-items-end">
            <div class="col-md-8">
                <div class="restaurant-detailed-header-left">
                <img class="img-fluid mr-3 float-left" alt="osahan" src="https://askbootstrap.com/preview/osahan-eat/img/1.jpg">
                <h2 class="text-white">{{ $vendor->store_name }}</h2>

                <p class="text-white mb-1"><i class="icofont-location-pin"></i>{{$vendor->address}}
                    @if($close==false)
                    <span class="badge badge-success">OPEN</span>
                    @else
                        <span class="badge badge-success">CLOSED</span>
                    @endif
                </p>
                {{--  <p class="text-white mb-0"><i class="icofont-food-cart"></i> North Indian, Chinese, Fast Food, South Indian
                </p>  --}}
                </div>
            </div>
            <div class="col-md-4">
                <div class="restaurant-detailed-header-right text-right">
                <button class="btn btn-success" type="button"><i class="icofont-clock-time"></i> 25–35 min
                </button>
                    <h6 class="text-white mb-0 restaurant-detailed-ratings"><span class="generator-bg rounded text-white"><i class="icofont-star"></i> {{$vendor->rating}}</span> {{$reviewCount}} Rating(s)</h6>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</section>

<section class="offer-dedicated-nav bg-white border-top-0 shadow-sm">
    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <ul class="nav" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-order-online-tab" data-toggle="pill" href="#pills-order-online" role="tab" aria-controls="pills-order-online" aria-selected="true">Order Online</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-gallery-tab" data-toggle="pill" href="#pills-gallery" role="tab" aria-controls="pills-gallery" aria-selected="false">Gallery</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-restaurant-info-tab" data-toggle="pill" href="#pills-restaurant-info" role="tab" aria-controls="pills-restaurant-info" aria-selected="false">Restaurant Info</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="pills-reviews-tab" data-toggle="pill" href="#pills-reviews" role="tab" aria-controls="pills-reviews" aria-selected="false">Ratings & Reviews</a>
                </li>
            </ul>
        </div>
    </div>
    </div>
</section>
<div class="container">
    @if(session('cartSuccess'))
        <br><br>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{session('cartSuccess')}}
        </div>
    @endif
    @if(session('cartError'))
        <br><br>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{session('cartError')}}
        </div>
    @endif
</div>
<section class="offer-dedicated-body pt-2 pb-2 mt-4 mb-4">
    <div class="container">

        <div class="row">
            <div class="col-md-8">
                <div class="offer-dedicated-body-left">
                    <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-order-online" role="tabpanel" aria-labelledby="pills-order-online-tab">
                        <div id="cartshow"></div>

                        @foreach($stockcategories as $stockcategory)
                            @if($stockcategory->app_category_id !=$soupProteins)
                                <?php $stocks=DB::table('stockdetails')->where('stock_category_id',$stockcategory->idstockcategories)
                                ->where('vendor_id',$id)->where('status','Available')->get(); $x=1; $count=count($stocks);?>

                                <div class="row">
                                    <h5 class="mb-4 mt-3 col-md-12">{{$stockcategory->name}} <small class="h6 text-black-50"> {{$count}} ITEMS</small></h5>
                                    <div class="col-md-12">
                                        <div class="bg-white rounded border shadow-sm mb-4">

                                            @foreach($stocks as $stock)
                                                <div class="gold-members p-3 border-bottom">
                                                    @if($close==false)
                                                        @if($stockcategory->idappstockcategory==$soupCategory)
                                                            <a href="#" class="btn btn-outline-secondary btn-sm  float-right" data-toggle="modal" data-target="#protein{{$stock->idstockdetails}}">ADD</a>
                                                            
                                                        @elseif($stockcategory->idappstockcategory==$mainMeal)
                                                            <a href="#" class="btn btn-outline-secondary btn-sm  float-right" data-toggle="modal" data-target="#protein{{$stock->idstockdetails}}">ADD</a>
                                                        @else
                                                            <button class="btn btn-outline-secondary btn-sm  float-right cartadd" data-id="{{$stock->idstockdetails}}">ADD</button>
                                                        @endif
                                                        {{-- {{URL::TO('add-to-cart')}}/{{$stock->idstockdetails}} --}}

                                                        <div class="modal fade" id="protein{{$stock->idstockdetails}}" tabindex="-1" role="dialog" aria-labelledby="protein" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="add-address">Select the supplements you want for this package</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form method="POST" action="{{URL::TO('protein-soup')}}" id="proteinSoup">
                                                                        @csrf
                                                                        <div class="modal-body">
                                                                            @if(count($stock_proteins) !=0)
                                                                                @foreach($stock_proteins as $stock_protein)
                                                                                    <div class="row">    
                                                                                        <div class="col-sm-12">
                                                                                            <div class="row">
                                                                                                <div class="checkbox col-4">
                                                                                                    <label>
                                                                                                        <input type="hidden" name="id" value="{{$stock->idstockdetails}}">
                                                                                                        <input type="checkbox" value="{{$stock_protein->idstockdetails}}" name="stock_protein[]">
                                                                                                            {{$stock_protein->name}}
                                                                                                        
                                                                                                    </label>
                                                                                                </div>
                                                                                                <div class="quantity col-4">
                                                                                                    <input type="number" min="1" max="3" step="1" value="1" name="quantity[]">
                                                                                                </div>
                                                                                                <div class="col-4">
                                                                                                    <p> &#8358 {{$stock_protein->stockprice}}</p>
                                                                                                </div>

                                                                                            </div>
                                                                                            
                                                                                        </div> 
                                                                                    </div>
                                                                                @endforeach
                                                                            @endif
                            
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn d-flex w-50 text-center justify-content-center btn-outline-warning" data-dismiss="modal">CANCEL
                                                                            </button><button type="submit" class="btn d-flex w-50 text-center justify-content-center btn-warning" id="withdrawsubmit">SUBMIT</button>
                                                                        </div>
                                                                    </form>
                                                        
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="media">
                                                        <div class="mr-3"><i class="icofont-ui-press text-danger food-item"></i></div>
                                                        <div class="media-body">
                                                        <h6 class="mb-1">{{$stock->name}}</h6>
                                                        
                                                            <p class="text-gray mb-0">&#8358 {{$stock->stockprice}}</p>
                                                    
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="tab-pane fade" id="pills-gallery" role="tabpanel" aria-labelledby="pills-gallery-tab">
                        <div id="gallery" class="bg-white rounded shadow-sm p-4 mb-4">
                            <div class="restaurant-slider-main position-relative homepage-great-deals-carousel">
                                <div class="owl-carousel owl-theme homepage-ad">

                                    @foreach($galleries as $gallery)
                                        <div class="item">
                                            <img class="img-fluid" src="{{$gallery->images}}">
                                        </div>
                                    @endforeach

                                </div>
                                {{-- <div class="position-absolute restaurant-slider-pics bg-dark text-white">2 of 14 Photos</div> --}}
                                {{-- <div class="position-absolute restaurant-slider-view-all"><button type="button" class="btn btn-light bg-white">See all Photos</button></div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-restaurant-info" role="tabpanel" aria-labelledby="pills-restaurant-info-tab">
                        <div id="restaurant-info" class="bg-white rounded shadow-sm p-4 mb-4">
                            <div class="text-center">



                            <h5 class="mb-4">Restaurant Info</h5>
                            <p class="mb-3">
                                    {{$vendor->address}}
                            </p>
                            <p class="mb-2 text-black"><i class="icofont-phone-circle text-primary mr-2"></i>{{$vendor->phone_number}}</p>
                            <p class="mb-2 text-black"><i class="icofont-email text-primary mr-2"></i>{{$vendor->email}}</p>
                            <p class="mb-2 text-black"><i class="icofont-clock-time text-primary mr-2"></i>opens at {{$vendor->open_at}}am,  closes at {{$vendor->close_at}}pm
                                @if($close==false)
                                    <span class="badge badge-success"> OPEN NOW </span>
                                @else
                                    <span class="badge badge-success">CLOSED</span>
                                @endif
                            </p>
                        </div>

                        </div>
                    </div>
                    {{-- <div class="tab-pane fade" id="pills-book" role="tabpanel" aria-labelledby="pills-book-tab">
                        <div id="book-a-table" class="bg-white rounded shadow-sm p-4 mb-5 rating-review-select-page">
                            <h5 class="mb-4">Book A Table</h5>
                            <form>
                                <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input class="form-control" type="text" placeholder="Enter Full Name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <input class="form-control" type="text" placeholder="Enter Email address">
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Mobile number</label>
                                        <input class="form-control" type="text" placeholder="Enter Mobile number">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date And Time</label>
                                        <input class="form-control" type="text" placeholder="Enter Date And Time">
                                    </div>
                                </div>
                                </div>
                                <div class="form-group text-right">
                                <button class="btn btn-primary" type="button"> Submit </button>
                                </div>
                            </form>
                        </div>
                    </div> --}}
                    <div class="alert alert-success alert-dismissible" id="alert-success">

                    </div>

                    <div class="tab-pane fade" id="pills-reviews" role="tabpanel" aria-labelledby="pills-reviews-tab">
                        @auth
                            <div id="ratings-and-reviews" class="bg-white rounded shadow-sm p-4 mb-4 clearfix restaurant-detailed-star-rating">

                                <span class="star-rating float-right">
                                    <i class="fa fa-star fa-2x"  data-index="0" ></i>
                                    <i class="fa fa-star fa-2x"  data-index="1" ></i>
                                    <i class="fa fa-star fa-2x"  data-index="2" ></i>
                                    <i class="fa fa-star fa-2x"  data-index="3" ></i>
                                    <i class="fa fa-star fa-2x"  data-index="4" ></i>
                                </span>
                                <h5 class="mb-0 pt-1">Rate this Place</h5>


                            </div>
                        @endauth

                        <div class="bg-white rounded shadow-sm p-4 mb-4 restaurant-detailed-ratings-and-reviews">
                            <a href="#" class="btn btn-outline-primary btn-sm float-right">Top Rated</a>
                            <h5 class="mb-1">All Ratings and Reviews</h5>
                            @foreach($reviews as $review)
                                <div class="reviews-members pt-4 pb-4">
                                    <div class="media">
                                    {{--  <a href="#"><img alt="Generic placeholder image" src="https://askbootstrap.com/preview/osahan-eat/img/user/1.png" class="mr-3 rounded-pill"></a>  --}}
                                    <div class="media-body">
                                        <div class="reviews-members-header">
                                            <span class="star-rating float-right">
                                                @for($i=0; $i<$review->rating; $i++)
                                                    <i class="fa fa-star"></i>
                                                @endfor
                                            </span>
                                            <h6 class="mb-1"><a class="text-black" href="#">{{$review->name}}</a></h6>
                                            <p class="text-gray">{{$review->created_at}}</p>
                                        </div>
                                        <div class="reviews-members-body">
                                            <p>{{$review->review}}</p>
                                        </div>
                                        @auth
                                            <div class="reviews-members-footer">
                                                @if($like==true)
                                                    <a class="total-like likes" style="background:#ffb200;" id="like_count{{$review->idvendorsreviews}}" onClick="cwRating({{$review->idvendorsreviews}},0,'like_count{{$review->idvendorsreviews}}')"><i class="icofont-thumbs-up"></i> {{$review->likes}}</a>
                                                @else
                                                    <a class="total-like likes" id="like_count{{$review->idvendorsreviews}}" onClick="cwRating({{$review->idvendorsreviews}},1,'like_count{{$review->idvendorsreviews}}')"><i class="icofont-thumbs-up"></i> {{$review->likes}}</a>
                                                @endif


                                                {{--  <a class="total-like dislikes"  id="{{$review->idvendorsreviews}}"><i class="icofont-thumbs-down"></i>{{$review->dislikes}}</a>  --}}
                                            </div>
                                        @endauth
                                    </div>
                                    </div>
                                </div>
                                <hr>
                            @endforeach

                            <a class="text-center w-100 d-block mt-4 font-weight-bold" href="#">See All Reviews</a>
                        </div>
                        <div class="alert alert-success alert-dismissible" id="review-message"></div>
                        @auth
                            <div class="bg-white rounded shadow-sm p-4 mb-5 rating-review-select-page">
                                <h5 class="mb-4">Review</h5>
                                <form id="form-review">
                                    @csrf
                                    <div class="form-group">
                                        <label>Your Review</label>
                                        <textarea class="form-control" name="review"></textarea>
                                        <input type="hidden" value="{{$id}}" name="vendor_id">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-warning btn-sm" type="submit"> Submit Review </button>
                                    </div>
                                </form>

                            </div>
                        @endauth
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">


                <div class="generator-bg rounded shadow-sm mb-4 p-4 osahan-cart-item" style="position: fixed; bottom: 0; right: 0;">
                    <h5 class="mb-1 text-white">Your Order</h5>
                    <div class="jquerycartshow">

                        @if(!session()->get('cart'))
                            <p class="mb-4 text-white">0 ITEMS</p>
                        @else

                            <form method="get" action="{{URL::TO('checkout')}}">
                                @csrf
                                <p class="mb-4 text-white">{{count(session('cart'))}} ITEMS</p>
                                <div class="bg-white rounded shadow-sm mb-2">

                                    @foreach(session()->get('cart') as $id=>$detail)
                                        <div class="gold-members p-2 border-bottom">
                                            <p class="text-gray mb-0 float-right ml-2"></p>
                                            <span class="count-number float-right">
                                            <div class="quantify">
                                                <input class="quantityUpdate" data-id="{{$id}}" type="number" value="{{$detail['quantity']}}" name="quantity[]">
                                            </div>
                                                <input type="hidden" value="{{$id}}" name="id[]">
                                            </span>
                                            <div class="media">
                                            <div class="mr-2"><a href="#" class="removecart" data-id="{{$id}}"><i class="fa fa-trash-alt"></i></a></div>
                                                <div class="media-body">
                                                    <p class="mt-1 mb-0 text-black">{{$detail['name']}}</p>
                                                    @if(count($detail['proteins']) !=0)
                                                        @foreach($detail['proteins'] as $protein)
                                                            <p>{{$protein['name']}}</p>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mb-2 bg-white rounded p-2 clearfix">
                                    <img class="img-fluid float-left" src="https://askbootstrap.com/preview/osahan-eat/img/wallet-icon.png">
                                    <h6 class="font-weight-bold text-right mb-2">Subtotal : <span class="text-danger">&#8358 {{session()->get('cartAmount')}}</span></h6>
                                    <p class="seven-color mb-1 text-right">Extra charges may apply</p>

                                </div>
                                    <button type ="submit" class="btn btn-success btn-block btn-lg">Checkout<i id="spinnercart" class="spinner-border" role="status"></i></button>
                                </div>
                            </form>

                        @endif
                    </div>
                </div>

                

            </div>
        </div>
    </div>
</section>

<script src="http://code.jquery.com/jquery-3.4.0.min.js"></script>
<script src="{{asset('web/js/webscript.js')}}"></script>
<script type="text/javascript">
    var ratedIndex=-1; uID=0;
    $("#review-message").hide();

    function cwRating(id,type,target){

        $.ajax({

            url:"{{URL::TO('like-review')}}",
            type:"GET",
            dataType:'json',
            data:{

                id:id,
                type:type

            },success:function(r){

                if(r.status==true){

                    $('#'+target).css({
                        'background': '#fff',
                    });

                    $('#'+target).html(r.result);

                }
                else{

                    $('#'+target).css({
                        'background': '#ffb200',
                    });

                    $('#'+target).html(r.result);
                }


            }
        })
    }


    $('#form-review').bind("submit", function(event){
        event.preventDefault();

        var me=$(this);

        $.ajax({
            url:"{{URL::TO('vendor-review')}}",
            type:"POST",
            data:me.serialize(),
            dataType:'json',
            success:function(response){

                $("#review-message").show();
                $('#review-message').append('<div  id="rad" class="alert-success">'+response.message+'</div>');
                $('#review-message').delay(500).show(10,function(){
                $(this).delay(1000).hide(10,function(){
                   $('#rad').remove();
                   });
               })

            }
        });
    });

    $(document).ready(function(){
        $("#alert-success").hide();
        resetStarColors();

        if(localStorage.getItem('ratedIndex')!=null){
            setStars(parseInt(localStorage.getItem('ratedIndex')));
            uID=localStorage.getItem('uID');
        }

        $('.fa-star').on('click',function(){
            ratedIndex = parseInt($(this).data('index'));
            localStorage.setItem('ratedIndex',ratedIndex);
            saveTotheDB()
        });

        $('.likess').on('click',function(e){
            e.preventDefault();
        })



        $('.fa-star').mouseover(function(){
            resetStarColors();

            var currentIndex = parseInt($(this).data('index'));

            setStars(currentIndex);
        });

        $('.fa-star').mouseleave(function (){
            resetStarColors();

            if(ratedIndex != -1)
                setStars(ratedIndex);

        });


    });

    function setStars(max){
        for (var i=0; i<=max; i++)
            $('.fa-star:eq('+i+')').css('color','green');
    }

    function saveTotheDB(){
        $.ajax({
            url:"{{URL::TO('vendor-rating')}}",
            method:"GET",
            dataType:'json',
            data:{
                save:1,
                uID:uID,
                ratedIndex:ratedIndex,
                vendor_id:{{$id}}
            },success:function(r){
                uID=r.id;
                localStorage.setItem('uID',uID);

                $("#alert-success").show();
                $('#alert-success').append('<div  id="mad" class="alert-success">Thank you for the rating!!!</div>');
                $('#alert-success').delay(500).show(10,function(){
                $(this).delay(1000).hide(10,function(){
                   $('#mad').remove();
                   });
               })
            }
        })
    }

    function resetStarColors(){
        $('.fa-star').css('color','#ffb200');
    }

    $(document).ready(function(){

        $('#spinnercart').hide();

        $(".cartadd").click( function(e) {
            e.preventDefault();
            $('#spinnercart').show();
            $(".cartadd").attr("disabled", true);
           
            
            var id =$(this).attr('data-id');
            $.ajax({
                url:"{{URL::TO('add-to-cart')}}",
                type:"POST",
                dataType:'json',
                data:{
                    id:id,
                    "_token": "{{ csrf_token() }}"
                },
                success:function(response){
                    $(".cartadd").attr("disabled", false);
                    

                    $('.jquerycartshow').html(response.html);
                    $('#headercart').html(response.headercart);

                    $('#spinnercart').hide();

                    // $("#cartshow").show();
                    // $('#cartshow').append('<div class="alert alert-success alert-dismissible" id="cartview">'+response.message+'</div>');
                    // $('#cartshow').delay(500).show(10,function(){
                    //     $(this).delay(1000).hide(10,function(){
                    //         $('#cartview').remove();
                    //     });
                    // })

                    

                }

            });
        });

        


        $(function(){
            $(document).on('click','.removecart',function(e){
                e.preventDefault();
                $('#spinnercart').show();
                var id =$(this).attr('data-id');
                $.ajax({
                    url:"{{URL::TO('remove-cart')}}",
                    type:"POST",
                    dataType:'json',
                    data:{
                        id:id,
                        "_token": "{{ csrf_token() }}"
                    },
                    success:function(response){


                        $('.jquerycartshow').html(response.html);
                        $('#headercart').html(response.headercart);

                        $('#spinnercart').hide();

                        // $("#cartshow").show();
                        // $('#cartshow').append('<div class="alert alert-success alert-dismissible" id="cartview">'+response.message+'</div>');
                        // $('#cartshow').delay(500).show(10,function(){
                        //     $(this).delay(1000).hide(10,function(){
                        //         $('#cartview').remove();
                        //     });
                        // });

                    }


                });
            });
        });



        $(function(){
            $(document).on('input','.quantityUpdate',function(){
                clearTimeout(this.delay);
                this.delay = setTimeout(function(){
                    $(this).trigger('search');
                }.bind(this), 800);
                }).on('search', '.quantityUpdate', function(){
                if(this.value){
                    var id =$(this).attr('data-id');
                    var quantity = this.value;
                    $.ajax({
                        url:"{{URL::TO('update-cart')}}",
                        type:"GET",
                        dataType:'json',
                        data:{
                            id:id,
                            quantity:quantity
                        },
                        success:function(response){
                            $('.jquerycartshow').html(response.html);
                            $('#headercart').html(response.headercart);
                            $('#spinnercart').hide();
                        }


                    });
                    
                
                }
            });

        });
        
    });


    jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
    jQuery('.quantity').each(function() {
      var spinner = jQuery(this),
        input = spinner.find('input[type="number"]'),
        btnUp = spinner.find('.quantity-up'),
        btnDown = spinner.find('.quantity-down'),
        min = input.attr('min'),
        max = input.attr('max');

      btnUp.click(function() {
        var oldValue = parseFloat(input.val());
        if (oldValue >= max) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue + 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
      });

      btnDown.click(function() {
        var oldValue = parseFloat(input.val());
        if (oldValue <= min) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue - 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
      });

    });
</script>
@endsection

