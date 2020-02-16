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
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $stocks=DB::table('stockdetails')->where('stock_category_id',$stockcategory->idstockcategories)
                        ->where('vendor_id',$vendor_id)->get(); $x=1;?>
                        @foreach($stocks as $stock)
                            <tr>
                                <td>{{$x}}</td>
                                <td>{{$stock->name}}</td>
                                <td>{{$stock->status}}</td>
                                <td>
                                    @if($stock->status=="Available")
                                        <button  class="btn btn-warning stockupdate" onClick="stockupdate({{$stock->idstockdetails}},0)">Finished</button>
                                    @else
                                        <button class="btn btn-success stockupdate" onClick="stockupdate({{$stock->idstockdetails}},1)">Available</button>
                                    @endif
                                </td>
                                <td>
                                    <p class="mb-0 text-black font-weight-bold">
                                        <a class="text-primary mr-3" data-toggle="modal" data-target="#editstock{{$stock->idstockdetails}}" href="#">
                                            <i class="icofont-ui-edit"></i>
                                        </a>
                                    </p>

                                    <div class="modal fade" id="editstock{{$stock->idstockdetails}}" tabindex="-1" role="dialog" aria-labelledby="editstock{{$stock->idstockdetails}}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="add-address">Edit</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="{{URL::TO('edit-stock')}}" id="editstock">
                                                    @csrf
                                                    <div class="modal-body">
                                    
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12">
                                                                <label for="inputPassword4">Stock Name</label>
                                                                <div class="input-group">
                                                                    <input type="hidden" name="stock_id" value="{{$stock->idstockdetails}}">
                                                                <input type="text" class="form-control" placeholder="Stock Name" name="stock_name" value="{{$stock->name}}">
                                                                    <div class="input-group-append">
                                                                        <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="icofont-ui-pointer"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                    
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn d-flex w-50 text-center justify-content-center btn-outline-warning" data-dismiss="modal">CANCEL
                                                        </button><button type="submit" class="btn d-flex w-50 text-center justify-content-center btn-warning" id="withdrawsubmit">SUBMIT</button>
                                                    </div>
                                                </form>
                                    
                                            </div>
                                        </div>
                                    </div>
                                </td>
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