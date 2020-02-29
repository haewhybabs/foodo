<div class="offer-dedicated-body-left">
    <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-order-online" role="tabpanel" aria-labelledby="pills-order-online-tab">
        
       
        @foreach($stockcategories as $stockcategory)
        {{Request::segment('2')}}
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
                                            <a href="#" class="btn btn-outline-secondary btn-sm  float-right" data-toggle="modal" data-target="#protein{{$stock->idstockdetails}}"><i class="icofont-plus-square add-button"></i></a>
                                            
                                        @elseif($stockcategory->idappstockcategory==$mainMeal)
                                            <a href="#" class="btn btn-outline-secondary btn-sm  float-right" data-toggle="modal" data-target="#protein{{$stock->idstockdetails}}"><i class="icofont-plus-square add-button"></i></a>
                                        @else
                                            <button class="btn btn-outline-secondary btn-sm  float-right cartadd" data-id="{{$stock->idstockdetails}}"><i class="icofont-plus-square add-button"></i></button>
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
                                        <div class="mr-3"><i class="icofont-food-basket" style="font-size: 36px; color: #3ecf8e;"></i></div>
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
                            <img class="img-fluid" src="{{asset('vendorimages')}}/{{$gallery->images}}" style="height: 100%; width: 100%;">
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
            <p class="mb-2 text-black"><i class="icofont-clock-time text-primary mr-2"></i>opens at {{date('h:i A', strtotime($vendor->open_at))}},  closes at {{date('h:i A', strtotime($vendor->close_at))}}
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

<script>
    $(document).ready(function(){ 
        $(".cartadd").click( function(e) {
            $('#spin').append('<i id="spinnercart" class="spinner-border" role="status"></i>');
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
                    $('#spinnercart').remove();

                    $('.jquerycartshow').html(response.html);
                    $('#headercart').html(response.headercart);

                    $('#spinnercart').hide();
                    if(response.newVendor==1){

                        toastr.error(response.message);
                    }
                    

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
    });
</script>