@php
    $route = Route::currentRouteName()
@endphp

<div>
    @if (strpos($route, 'edit'))
        {{ Form::model($slideshow, [ 'route' => ['admin.slideshow.update', $slideshow->id], 'method' => 'put', 'files' => true ]) }}
    @else
        {{ Form::open(['route' => 'admin.slideshow.store', 'files' => true]) }}
    @endif

        <div class="form-group">
            {{ Form::label("image", 'Nuotrauka', [ 'class' => 'control-label' ]) }}
            {{ Form::file('image') }}
        </div>

        @if (isset($slideshow))
            <div class="form-group">
                <img src="\{{ $slideshow->image }}" alt="" class="img-responsive">
            </div>
        @endif
        {{ Form::submit('Išsaugoti', ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
</div>