<div class="row">
    <?php $now= time()+3600; $time=(int)date('H',$now);?>
    @foreach($vendors as $vendor)
        <div class="col-md-4 col-sm-6 mb-4 pb-2">
            <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                <div class="list-card-image">
                    <div class="star position-absolute"><span class="badge badge-warning"><i class="icofont-star"></i> {{$vendor->rating}}</span></div>
                    <div class="favourite-heart text-danger position-absolute"><a href="{{ URL::TO('') }}/{{ $category->name }}/{{ $vendor->idvendors }}/{{ $vendor->store_name }}"><i class="icofont-heart"></i></a></div>
                    <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                    @if($time>=$vendor->open_at and $time<=$vendor->close_at+12)
                        <a href="{{ URL::TO('') }}/{{ $category->name }}/{{ $vendor->idvendors }}/{{ $vendor->store_name }}">
                            <img src="{{ $vendor->logo }}" class="img-fluid item-img">
                        </a>
                    @else
                        <a>
                            <img src="{{ asset('web/img/icons/closed.jpeg') }}" class="img-fluid item-img">
                        </a>
                    @endif
                </div>
                <div class="p-3 position-relative">
                    <div class="list-card-body">
                        <h6 class="mb-1"><a href="{{ URL::TO('') }}/{{ $category->name }}/{{ $vendor->idvendors }}/{{ $vendor->store_name }}" class="text-black">{{ $vendor->store_name }}</a></h6>
                        <p class="text-gray mb-3">{{ $vendor->description }}</p>
                    <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="icofont-wall-clock"></i>opens at {{$vendor->open_at}}am</span> <span class="float-right text-black-50">closes at {{$vendor->close_at}}pm</span></p>
                    </div>
                    <div class="list-card-badge">
                        {{--  <span class="badge badge-success">OFFER</span> <small>65% off | Use Coupon OSAHAN50</small>  --}}
                    </div>
                </div>
            </div>
        </div>
        <?php $last_id =$vendor->idvendors;?>
    @endforeach 
 </div>
 <div class="">
    <button class="btn btn-warning btn-block btn-lg loadmore" data-id="{{$last_id}}">Load More</button>
 </div>