@php $route = Route::currentRouteName() @endphp
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}" />
    <title> {{  trans(Route::getCurrentRoute()->getName()) . ' | ' .  trans('admin.title')  }} </title>
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('/css/summernote.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <div class="admin">

        @include('partials.admin.top')

        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-4">
                    @include('partials.admin.sidebar')
                </div>
                <div class="main col-md-9 col-sm-8">
                    @include('flash::message')

                    @include('partials.admin.header')
                    <section class="content">
                        <div class="{{ str_replace('.', '-', substr($route, strpos($route, '.') + 1)) }}">
                            @yield('content')
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="{{ asset('js/summernote.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/summernote-lt-LT.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/admin.js') }}" type="text/javascript"></script>
    @yield('scripts')
</body>
</html>