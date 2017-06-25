@include('partials.head')
<body>
    @include('partials.header')

    <div class="container">
        <div class="row">
            <div class="col-sm-2 col-xs-12 text-center">
                @if (!empty($leftBanners))
                    @foreach ($leftBanners as $b)
                        @if(request()->segment(1) != 'top-cv')
                            <div class="okaycv-ad">
                                <a href="{{$b->banner_link}}" target="_blank">
                                    <img src="{{$b->getImage()}}" class="img-responsive">
                                </a>
                            </div>
                        @endif
                    @endforeach
                @endif
                @if (request()->segment(1) == 'top-cv')
                        <div class="okaycv-ad">
                            <a href="{{ route('topCv.sent') }}">
                                <img src="/uploads/banners/rNb1eN.gif" class="img-responsive">
                            </a>
                        </div>
                @endif
            </div>
            <div class="col-sm-8 page-content">

                @yield('content')
            </div>
            <div class="col-sm-2">
                @include('partials.right')
                @if (!empty($rightBanners))
                    @foreach ($rightBanners as $b)
                        <div class="okaycv-ad">
                            <a href="{{$b->banner_link}}" target="_blank">
                                <img src="{{$b->getImage()}}" class="img-responsive">
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
	</div>
	@include('partials.footer')

	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	{!! Html::script('/js/jquery.ui.datepicker-lt.js') !!}
	{!! Html::script('/js/bootstrap-multiselect.js') !!}
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="{{ asset('/js/jquery.waterwheelCarousel.js') }}"></script>

    {!! Html::script('/js/common.js?v=20170601') !!}

	@yield('scripts')


</body>
</html>
