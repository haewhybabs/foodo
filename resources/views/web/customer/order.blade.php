<div class="tab-pane fade show active" id="orders" role="tabpanel" aria-labelledby="orders-tab">
    <h4 class="font-weight-bold mt-0 mb-4">Orders</h4>
    @foreach($transactions as $trans)
    <div class="bg-white card mb-4 order-list shadow-sm">
        <div class="gold-members p-4">
            <a href="#">
                <div class="media">
                    {{--  <img class="mr-4" src="https://askbootstrap.com/preview/osahan-eat/img/3.jpg" alt="Generic placeholder image">  --}}
                    <div class="media-body">
                    <span class="float-right text-info">Ref:{{$trans->reference}}<i class="icofont-check-circled text-success"></i></span>
                        <h6 class="mb-2">
                            <a href="#" class="text-black">{{$trans->store_name}}
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
                                <tr>
                                    <td>{{$x}}</td>
                                    <td>{{$detail->name}}</td>
                                    <td>{{$detail->qty}}</td>
                                    <td>{{$detail->stockprice}}</td>
                                </tr>
                                <?php $x++;?>
                                @endforeach
                            </tbody>
                        </table>


                        <hr>
                        <div class="float-right">

                            <?php if($trans->status<2){
                                $spanclass='spinner-grow spinner-grow-sm';
                                $aclass='btn btn-sm btn-outline-warning';
                            }else{
                                $spanclass='';
                                $aclass='btn btn-sm btn-outline-success';
                            }?>

                            <button class="{{$aclass}}" type="button" disabled><span class="{{$spanclass}}" role="status" aria-hidden="true"></span>
                                @if($trans->status==0)
                                    {{'Preparing Food'}}
                                @elseif($trans->status==1)
                                    {{'On Delivery'}}
                                @elseif($trans->status==2)
                                    {{'Received'}}
                                @endif
                            </button>
                            @if($trans->status==1)
                                <a class="btn btn-sm btn-warning" href="{{URL::TO('delivery-confirm')}}/{{$trans->reference}}"><i class="icofont-refresh"></i>Confirm Delivery</a>
                            @endif
                        </div>
                            <p class="mb-0 text-black text-primary pt-2"><span class="text-black font-weight-bold"> Total Paid:</span> &#8358 {{$trans->total_amount}}
                        </p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    @endforeach
</div>
