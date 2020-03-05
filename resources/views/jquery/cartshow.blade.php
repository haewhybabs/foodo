<div class="jquerycartshow">

    @if(!session()->get('cart'))
        <p class="mb-4 text-white">0 ITEMS</p>
    @else

        <form method="get" action="{{URL::TO('checkout')}}">
            @csrf
            <p class="mb-4 text-white">{{count(session('cart'))}} ITEMS</p>

            @foreach(session()->get('cart') as $id=>$detail)
                <div class="dropdown-divider" style="margin: 1.1rem 0rem;"></div>
                <div>
                    <span>
                    <p class="float-right" style="color: black; font-weight: bold;">&#8358 {{$detail['price']}}</p>
                        <div>
                        <p style="color: black; font-weight: bold;">{{$detail['name']}}</p>
                        </div>
                    </span>

                    @if(count($detail['proteins']) !=0)
                        @foreach($detail['proteins'] as $protein)
                        <span>
                            <p class="float-right">{{$protein['qty']}}</p>
                            <div>
                                <p>{{$protein['name']}}</p>
                            </div>
                        </span>
                        @endforeach
                    @endif


                    <div class="float-right">
                        <div class="media">
                            <p>{{$detail['quantity']}}</p>
                            <input class="quantityUpdate" style="width: 40px; margin-left: 5px;" data-id="{{$id}}" type="text" value="{{$detail['quantity']}}" name="quantity[]">
                        </div>
                    </div>
                    <div class="media">
                        <div class="mr-2"></div>
                        <div class="media-body">
                            <a href="#"><p class="mb-0 text-black removecart" data-id="{{$id}}"><i class="icofont-ui-delete text-danger"></i>Remove</p></a>

                        </div>
                    </div>
                </div>
            @endforeach


            <div class="mb-2 bg-white rounded p-2 clearfix">
                <img class="img-fluid float-left" src="https://askbootstrap.com/preview/osahan-eat/img/wallet-icon.png">
                <h6 class="font-weight-bold text-right mb-2">Subtotal : <span class="text-danger">&#8358 {{session()->get('cartAmount')}}</span></h6>
                <p class="seven-color mb-1 text-right">Extra charges may apply</p>

            </div>
            {{-- <a href="https://askbootstrap.com/preview/osahan-eat/checkout.html" class="btn btn-success btn-block btn-lg">Checkout <i class="icofont-long-arrow-right"></i></a> --}}
            <button type ="submit" class="btn btn-success btn-block btn-lg" id="spin">Checkout</button>
        </form>
    @endif
</div>

