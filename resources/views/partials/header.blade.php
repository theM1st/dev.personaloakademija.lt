<div class="header hidden-print">
    <div class="container">

        <div class="navbar-header">
            <button aria-controls="bs-navbar" aria-expanded="false" class="collapsed navbar-toggle" data-target="#bs-navbar" data-toggle="collapse" type="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="/" class="navbar-brand">
                <img src="{{asset('assets/img/large-logo.png')}}" alt="" class="img-responsive">
            </a>
        </div>

        <nav id="bs-navbar" class="collapse navbar-collapse">
            {!! $navigation or null !!}

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check())
                    @if (Auth::user()->isAdminWorker())
                        <li>
                            <a href="{{route('cv_index')}}">
                                CV katalogas
                            </a>
                        </li>
                        <li>
                            <a href="{{route('user_profile')}}">Mano profilis</a>
                        </li>
                        <li class="administration">
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Administravimas <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu">
                                <li><a href="{{action('OffersAdminController@index')}}">Darbo pasiūlymai</a></li>
                                <li><a href="{{action('TopCvsAdminController@create')}}">Naujas Top CV</a></li>
                                <li><a href="{{action('BannersController@index')}}">Baneriai</a></li>
                                @if (Auth::user()->isAdmin())
                                    <li><a href="{{action('AdminController@workers')}}">Darbuotojai</a></li>
                                @endif
                            </ul>
                        </li>
                    @else
                        <li><a href="{{route('cv_create')}}" class="btn btn-default">Mano CV</a></li>
                        <li><a href="{{route('user_profile')}}" class="btn btn-default">Mano profilis</a></li>
                    @endif
                    <li>
                        <a href="#">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            {{Auth::user()->email}}
                        </a>
                    </li>
                    <li>{!! Html::linkRoute('auth.logout', 'Atsijungti') !!}</li>
                @else
                    <li class="register">{!! Html::linkRoute('auth.register', 'Registruotis') !!}</li>
                    <li>{!! Html::linkRoute("auth.login", 'Prisijungti') !!}</li>
                @endif
            </ul>
        </nav>
@php /*
        <div class="row">
            <div class="col-sm-10">

                <div class="clearfix">
                    <div class="login-menu">
                        <ul class="nav nav-pills">
                            @if (Auth::check())
                                <li>
                                    <a href="#">
                                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                        {{Auth::user()->email}}
                                    </a>
                                </li>
                                <li>{!! Html::linkRoute('auth.logout', 'Atsijungti') !!}</li>
                            @else
                                <li>{!! Html::linkRoute('auth.register', 'Registruotis') !!}</li>
                                <li>{!! Html::linkRoute("auth.login", 'Prisijungti') !!}</li>
                            @endif
                        </ul>
                    </div>
                    @if (Auth::check())
                        <div class="user-navigation">
                            <div class="text-right">
                                @if(Auth::user()->isAdminWorker())
                                    <a href="{{route('cv_index')}}" class="btn btn-default">
                                        CV katalogas
                                    </a>
                                @endif
                                @if(Auth::user()->isAdminWorker())
                                    <a href="{{route('user_profile')}}" class="btn btn-default">Mano profilis</a>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Administravimas <span class="caret"></span>
                                        </button>

                                        <ul class="dropdown-menu">
                                            <li><a href="{{action('OffersAdminController@index')}}">Darbo pasiūlymai</a></li>
                                            <li><a href="{{action('BannersController@index')}}">Baneriai</a></li>
                                            @if(Auth::user()->isAdmin())
                                                <li><a href="{{action('AdminController@workers')}}">Darbuotojai</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                @else
                                    <a href="{{route('cv_create')}}" class="btn btn-default">Mano CV</a>
                                    <a href="{{route('user_profile')}}" class="btn btn-default">Mano profilis</a>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>

                <div class="top-nav">{!! $navigation or null !!}</div>
            </div>

        </div>
        */
        @endphp
        @if (isset($slideshow))
            <div id="carousel">
                @foreach ($slideshow as $slide)
                    <img src="/{{ $slide->image }}" alt="{{ $slide->name }}" class="img-responsive">
                @endforeach
                <div class="carouselNav">
                    <a href="#" class="carouselPrev"><</a>
                    <a href="#" class="carouselNext">></a>
                </div>
            </div>
        @endif

        <div class="social-links hidden-xs">
            <a href="http://www.facebook.com/pages/Pardavim%C5%B3-akademija/353567544685396" class="facebook" target="_blank">facebook</a>
            <a href="https://www.linkedin.com/company/personalo-akademija" class="linkedIn" target="_blank">linkedIn</a>
        </div>
    </div>
</div>
<div class="visible-print-block">
    <img src="{{asset('assets/img/logo.png')}}" alt="okaycv">
</div>