<div class="tab-pane fade" id="stock" role="tabpanel" aria-labelledby="stock-tab">
    <div class="row">
        <div>
            <h4 class="font-weight-bold mt-0 mb-4">Stock</h4>
        </div>
        <div class="row" style="margin-top:5px; margin-left:7px;">
            <div style="margin-left:7px;">
                <div class="well">
                    <a href="#" data-toggle="modal" data-target="#add-stockcategory-modal"> Stock Category</a>
                </div>
            </div>
            <div>
                <div class="well">
                    <a href="#" data-toggle="modal" data-target="#add-stock-modal">|Add Stock</a>
                </div>
            </div>
        </div>

    </div>

    <div class="row mb-4 pb-2">
        @foreach($stockcategories as $stockcategory)
        <div class="col-md-6">
            <div class="card offer-card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{$stockcategory->name}}</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Stock Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $stocks=DB::table('stockdetails')->where('stock_category_id',$stockcategory->idstockcategories)
                            ->where('vendor_id',$user->idvendors)->get(); $x=1;?>
                            @foreach($stocks as $stock)
                                <tr>
                                    <td>{{$x}}</td>
                                    <td>{{$stock->name}}</td>
                                    <td>{{$stock->status}}</td>
                                    <td>
                                        @if($stock->status=="Available")
                                    <a href="{{URL::TO('stock-status')}}/{{$stock->idstockdetails}}/finish" class="btn btn-warning">Finished</a>
                                        @else
                                            <a href="{{URL::TO('stock-status')}}/{{$stock->idstockdetails}}/available" class="btn btn-success">Available</a></td>
                                        @endif
                                </tr>
                            <?php $x++;?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @endforeach
        {{--  <div class="col-md-6">
            <div class="card offer-card shadow-sm">
                <div class="card-body">
                <h5 class="card-title"><img src="https://askbootstrap.com/preview/osahan-eat/img/bank/2.png"> EAT730</h5>
                <h6 class="card-subtitle mb-2 text-block">Get 50% OFF on your first osahan eat order</h6>
                <p class="card-text">Use code EAT730 &amp; get 50% off on your first osahan order on Website and Mobile site. Maximum discount: $600</p>
                <a href="#" class="card-link">COPY CODE</a>
                <a href="#" class="card-link">KNOW MORE</a>
                </div>
            </div>
        </div>  --}}
    </div>

    {{--  <div class="row mb-4 pb-2">
        <div class="col-md-6">
            <div class="card offer-card shadow-sm">
                <div class="card-body">
                <h5 class="card-title"><img src="https://askbootstrap.com/preview/osahan-eat/img/bank/3.png"> SAHAN50</h5>
                <h6 class="card-subtitle mb-2 text-block">Get 50% OFF on your first osahan eat order</h6>
                <p class="card-text">Use code SAHAN50 &amp; get 50% off on your first osahan order on Website and Mobile site. Maximum discount: $200</p>
                <a href="#" class="card-link">COPY CODE</a>
                <a href="#" class="card-link">KNOW MORE</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card offer-card shadow-sm">
                <div class="card-body">
                <h5 class="card-title"><img src="https://askbootstrap.com/preview/osahan-eat/img/bank/4.png"> GURDEEP50</h5>
                <h6 class="card-subtitle mb-2 text-block">Get 50% OFF on your first osahan eat order</h6>
                <p class="card-text">Use code GURDEEP50 &amp; get 50% off on your first osahan order on Website and Mobile site. Maximum discount: $600</p>
                <a href="#" class="card-link">COPY CODE</a>
                <a href="#" class="card-link">KNOW MORE</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card offer-card shadow-sm">
                <div class="card-body">
                <h5 class="card-title"><img src="https://askbootstrap.com/preview/osahan-eat/img/bank/1.png"> OSAHANEAT50</h5>
                <h6 class="card-subtitle mb-2 text-block">Get 50% OFF on your first osahan eat order</h6>
                <p class="card-text">Use code OSAHANEAT50 &amp; get 50% off on your first osahan order on Website and Mobile site. Maximum discount: $200</p>
                <a href="#" class="card-link">COPY CODE</a>
                <a href="#" class="card-link">KNOW MORE</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card offer-card shadow-sm">
                <div class="card-body">
                <h5 class="card-title"><img src="https://askbootstrap.com/preview/osahan-eat/img/bank/2.png"> EAT730</h5>
                <h6 class="card-subtitle mb-2 text-block">Get 50% OFF on your first osahan eat order</h6>
                <p class="card-text">Use code EAT730 &amp; get 50% off on your first osahan order on Website and Mobile site. Maximum discount: $600</p>
                <a href="#" class="card-link">COPY CODE</a>
                <a href="#" class="card-link">KNOW MORE</a>
                </div>
            </div>
        </div>
    </div>  --}}
</div>
