@php
    $languages = appLanguages();
    $route = Route::currentRouteName()
@endphp

<div>
    <ul class="nav nav-tabs" role="tablist">
        @foreach ($languages as $k => $lang)
            <li role="presentation" class="{{ ($k ?'':' active') }}">
                <a href="#page-{{ $lang->locale }}" aria-controls="page-{{ $lang->locale }}" role="tab">
                    <img src="{{ $lang->image }}" alt="{{ $lang->locale }}">
                    {{ $lang->name }}
                </a>
            </li>
        @endforeach
    </ul>
    <div class="tab-content">
        @foreach ($languages as $k => $lang)
            <div role="tabpanel" class="tab-pane{{ ($k ?'':' active') }}" id="page-{{ $lang->locale }}">
                @include('errors.validation')
                @if (strpos($route, 'edit'))
                    {{ Form::model($page, [ 'route' => ['admin.page.update', $page->id, "#page-{$lang->locale}"], 'method' => 'put' ]) }}
                @else
                    {{ Form::open(['route' => 'admin.page.store']) }}
                @endif
                    <div class="form-group">
                        {{ Form::label("title_$lang->locale", trans('admin.fields.page.title'), [ 'class' => 'control-label' ]) }}
                        {{ Form::text("title_$lang->locale", old("title_$lang->locale"), [ 'class' => 'form-control' ]) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label("content_$lang->locale", trans('admin.fields.page.content'), [ 'class' => 'control-label' ]) }}
                        {{ Form::textarea("content_$lang->locale", old("content_$lang->locale"), [ 'class' => 'form-control summernote' ]) }}
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                {{ Form::label("parent_$lang->locale", 'Priklauso kategorijai', [ 'class' => 'control-label' ]) }}
                                {{ Form::select('parent_id', $pages, old('parent_id'), [ 'placeholder'=> 'Pagrindinė', 'class' => 'form-control select2', 'id' => "parent_$lang->locale", 'style' => 'width:100%' ]) }}
                            </div>
                            <div class="col-sm-6">
                                {{ Form::label("menu_$lang->locale", 'Meniu pozicija', [ 'class' => 'control-label' ]) }}
                                {{ Form::select('menu', [ 1 => 'Pagrindinis meniu' ], old('menu'), [ 'placeholder'=> 'Nepriskirtas', 'class' => 'form-control select2', 'id' => "menu_$lang->locale", 'style' => 'width:100%' ]) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                {{ Form::label("active_$lang->locale", 'Ar aktyvus', [ 'class' => 'control-label' ]) }}
                                {{ Form::select('active', [ 1 => 'Taip' ], old('active'), [ 'placeholder'=> 'Ne', 'class' => 'form-control select2', 'id' => "active_$lang->locale", 'style' => 'width:100%' ]) }}
                            </div>
                            <div class="col-sm-6">
                                {{ Form::label("main_page_$lang->locale", 'Pagrindinis puslapis', [ 'class' => 'control-label' ]) }}
                                {{ Form::select('main_page', [ 1 => 'Taip' ], old('main_page'), [ 'placeholder'=> 'Ne', 'class' => 'form-control select2', 'id' => "main_page_$lang->locale", 'style' => 'width:100%' ]) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                {{ Form::label("link_$lang->locale", trans('admin.fields.page.link'), [ 'class' => 'control-label' ]) }}
                                {{ Form::text("link_$lang->locale", old("link_$lang->locale"), [ 'class' => 'form-control' ]) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label("description_$lang->locale", trans('admin.fields.page.description'), [ 'class' => 'control-label' ]) }}
                        {{ Form::text("description_$lang->locale", old("description_$lang->locale"), [ 'class' => 'form-control' ]) }}
                        <p class="help-block">Paieškos sistemoms.</p>
                    </div>
                    {{ Form::submit('Išsaugoti', ['class' => 'btn btn-primary']) }}
                {{ Form::close() }}
            </div>
        @endforeach
    </div>
</div>

@section('scripts')
    <script>
        $('.nav-tabs a').click(function (e) {
        // No e.preventDefault() here
            $(this).tab('show');
        });
        $(document).ready(function() {
            if (location.hash !== '') $('a[href="' + location.hash + '"]').tab('show');
            return $('a[data-toggle="tab"]').on('shown', function(e) {
                return location.hash = $(e.target).attr('href').substr(1);
            });
        });
    </script>
@endsection