<?php $count=0;?>
@if(session()->get('cart'))
    <?php $count=count(session()->get('cart'));?>
@endif
<div  class="is-hidden-desktop is-flex" id="mobilecart">
    <span style="text-transform: uppercase; font-size: 15px;">{{$count}} items</span>
    <span style="font-size: 17px; text-transform: uppercase; font-weight: 500;" data-toggle="modal" id="mobilecart" data-target="#viewcart">View Cart</span>
    <span style="font-size: 15px;">&#8358 {{session()->get('cartAmount')}}</span>
</div>