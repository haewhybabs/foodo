<div class="tab-pane fade" id="wallet" role="tabpanel" aria-labelledby="wallet-tab">
    <h4 class="font-weight-bold mt-0 mb-4">Credit History</h4>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Reference</th>
                        <tbody><?php $x = 1;?>
                            @foreach($credits as $credit)
                                <tr>
                                    <td>{{$x}}</td>

                                    <td> &#8358 {{$credit->amount}}</td>

                                    <td>{{$credit->created_at}}</td>

                                    <td>{{$credit->reference}}</td>

                                </tr><?php $x++;?>

                            @endforeach

                        </tbody>
                    </tr>
                </thead>
            </table>
            <div class="text-center">
                <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#credit">Credit</a>
            </div>
        </div>

    </div>
</div>
