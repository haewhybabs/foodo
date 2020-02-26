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
                        <input class="quantityUpdate" data-id="{{$id}}" type="number" value="{{$detail['quantity']}}" name="quantity[]">
                        <input type="hidden" value="{{$id}}" name="id[]">
                        </span>
                        <div class="media">
                        <div class="mr-2"><a href="#" class="removecart" data-id="{{$id}}"><i class="fa fa-trash-alt"></i></a></div>
                            <div class="media-body">
                                <p class="mt-1 mb-0 text-black">{{$detail['name']}}</p>
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
                <button type ="submit" class="btn btn-success btn-block btn-lg">Checkout <i id="spinnercart" class="spinner-border" role="status"></i></button>
            </div>
        </form>

    @endif
</div>

