
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
                                        <a href="#" class="float-right" data-toggle="modal" data-target="#protein{{$stock->idstockdetails}}"><i class="icofont-plus-square add-button"></i></a>

                                    @elseif($stockcategory->idappstockcategory==$mainMeal)
                                        <a href="#" class="float-right" data-toggle="modal" data-target="#protein{{$stock->idstockdetails}}"><i class="icofont-plus-square add-button"></i></a>
                                    @else
                                        <button class="float-right cartadd" style="border: none; background: transparent" data-id="{{$stock->idstockdetails}}"><i class="icofont-plus-square add-button"></i></button>
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
                    $('#mobilecart').html(response.mobilecart);

                    $('#spinnercart').hide();
                    if(response.newVendor==1){

                        toastr.error(response.message);
                    }
                    if(response.close==1){

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
