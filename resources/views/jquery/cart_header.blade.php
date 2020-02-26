<li class="nav-item dropdown dropdown-cart">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-shopping-basket"></i> Cart
        @if(!session()->get('cart'))
        <span class="badge badge-success">0</span>
        @else
        <span class="badge badge-success">{{count(session('cart'))}}</span>
        @endif
    </a>
    @if(session()->get('cart'))
        <?php $vendor=DB::table('vendors')->where('idvendors',session()->get('vendor_id'))->first();?>
        <div class="dropdown-menu dropdown-cart-top p-0 dropdown-menu-right shadow-sm border-0">
            <div class="dropdown-cart-top-header p-4">
                <img class="img-fluid mr-3" alt="osahan" src="https://askbootstrap.com/preview/osahan-eat/img/cart.jpg">
                <h6 class="mb-0">{{$vendor->store_name}}</h6>
            </div>
            <div class="dropdown-cart-top-body border-top p-4">
                @foreach(session()->get('cart') as $id=>$detail)
                    <p class="mb-2"><i class="icofont-ui-press text-danger food-item"></i> {{$detail['name']}} <span class="float-right text-secondary">&#8358 {{$detail['price'] * $detail['quantity']}}</span></p>
                @endforeach
            </div>
            <div class="dropdown-cart-top-footer border-top p-4">
                <p class="mb-0 font-weight-bold text-secondary">Sub Total <span class="float-right text-dark">&#8358 {{session()->get('cartAmount')}}</span></p>
            </div>
            <div class="dropdown-cart-top-footer border-top p-2">
            <a class="btn btn-success btn-block btn-lg" href="{{URL::TO('checkout')}}"> Checkout</a>
            </div>
        </div>
    @endif
</li>