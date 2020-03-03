<div class="tab-pane fade show active" id="orders" role="tabpanel" aria-labelledby="orders-tab">
    <h4 class="font-weight-bold mt-0 mb-4">Orders</h4>
    @foreach($transactions as $trans)
    <div class="bg-white card mb-4 order-list shadow-sm">
        <div class="gold-members p-4">
            <a href="#">
                <div class="media">
                    {{--  <img class="mr-4" src="https://askbootstrap.com/preview/osahan-eat/img/3.jpg" alt="Generic placeholder image">  --}}
                    <div class="media-body">
                        <span class="float-right text-info">Review<i class="icofont-check-circled text-success"></i></span>
                        <h6 class="mb-2">
                            <a href="#" class="text-black">{{$trans->email}}
                            </a>
                        </h6>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $x=1; $details= DB::table('orderdetails')
                                ->join('ordersummaries','orderdetails.order_summaries_id','=','ordersummaries.idordersummaries')->join('stockdetails','orderdetails.stock_details_id','=','stockdetails.idstockdetails')
                                ->where('orderdetails.order_summaries_id',$trans->idordersummaries)->get();?>

                                @foreach($details as $detail)

                                    <?php $proteins = DB::table('orderprotein')->join('stockdetails','stockdetails.idstockdetails','=','orderprotein.stock_id')
                                    ->join('orderdetails','orderdetails.idorderdetails','=','orderprotein.order_detail_id')
                                    ->where('orderprotein.order_detail_id',$detail->idorderdetails)
                                    ->select('orderprotein.*','stockdetails.name')
                                    ->get();?>

                                <tr>
                                    <td><strong>{{$x}}</td>
                                    <td><strong>{{$detail->name}}</td>
                                    <td><strong>{{$detail->qty}}</strong></td>
                                    <td><strong> ₦ {{$detail->price * $detail->qty}}</strong></td>
                                </tr>

                                @if(count($proteins)>0)
                                    <?php $j=1;?>
                                       
                                    
                                    @foreach($proteins as $protein)
                                        <tr>
                                            <td>
                                               
                                            </td>
                                            <td>
                                                {{$protein->name}}  
                                            </td>
                                            <td>
                                                {{$protein->qty}}
                                            </td>
                                            <td> </td>
                                        </tr>
                                        <?php $j++;?>
                                    @endforeach

                                @endif
                                
                                <?php $x++;?>
                                @endforeach
                            </tbody>
                        </table>


                        <hr>
                        <div class="float-right">
                            <a class="btn btn-sm btn-outline-success" href="#"><i class="icofont-headphone-alt"></i>
                                @if($trans->status==1)
                                    {{'New Order'}}
                                @elseif($trans->status==2)
                                    {{'On Delivery'}}
                                @elseif($trans->status==3)
                                    {{'Received'}}
                                @endif
                            </a>
                            @if($trans->status==1)
                                <a class="btn btn-sm btn-warning" href="{{URL::TO('vendor-delivery')}}/{{$trans->idordersummaries}}"><i class="icofont-refresh"></i>Set on Delivery</a>
                            @endif
                        </div>
                        <p class="mb-0 text-black text-primary pt-2"><span class="text-black font-weight-bold"> Total Paid:</span> &#8358 {{$trans->vendor_fee}}
                        </p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    @endforeach
</div>

{{-- <script>
    $(document).ready(function(){
        var token = $('input[name="_token"]').val();
        function load_data(id ="", _token){

            $.ajax({
                url:"{{route('vendor-loadmore')}}",
                method:"POST",
                data:{id:id,_token:_token},
                success:function(data)
                {
                    $
                }
            })
        }
    })
</script> --}}
