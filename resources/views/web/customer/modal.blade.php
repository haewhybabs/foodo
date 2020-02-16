

<div class="modal fade" id="edit-profile-modal" tabindex="-1" role="dialog" aria-labelledby="edit-profile" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-profile">Edit profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{URL::TO('user-edit-profile')}}" method="POST">
                @csrf
                <div class="modal-body">

                    <div class="form-row">

                        <div class="form-group col-md-12">
                            <label>Name
                            </label>
                            <input type="text" value="{{$user->name}}" class="form-control" name="name" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Phone number
                            </label>
                            <input type="text" value="{{$user->phone_number}}" class="form-control" name="phone_number" required>
                        </div>

                        <div class="form-group col-md-12 mb-0">
                            <label>Address
                            </label>
                            <input type="text" value="{{$user->address}}" class="form-control" required name="address">
                        </div>

                        {{-- <button class="btn btn-warning" type="submit">Submit</button> --}}
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn d-flex w-50 text-center justify-content-center btn-outline-warning" data-dismiss="modal">CANCEL
                    </button><button type="submit" class="btn d-flex w-50 text-center justify-content-center btn-warning">UPDATE</button>
                </div>
            </form>
        </div>
    </div>
 </div>


 <div class="modal fade" id="credit" tabindex="-1" role="dialog" aria-labelledby="withdraw" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-address">New Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{URL::TO('credit-wallet')}}" id="withdrawform">
                @csrf
                <div class="modal-body">

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Amount</label>
                            <div class="input-group">
                                <input type="number" class="form-control" placeholder="Amount" name="amount">
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
 {{--  <!-- Modal --> Stock Category  --}}






 <!-- Modal -->



