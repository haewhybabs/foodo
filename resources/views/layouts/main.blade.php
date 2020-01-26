@include('layouts.header')
    <div class="container"><br><br>
        @if (count($errors)> 0)
            @foreach($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{$error}}

                </div>
            @endforeach
        @endif

        @if(session('message'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{session('message')}}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{session('error')}}
            </div>
        @endif
    </div>
    @yield('content')
@include('layouts.footer')
