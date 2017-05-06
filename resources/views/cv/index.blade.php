@extends('app')

@section('title', "CV katalogas -")

@section('content')
    <div class="cvs">
        <h1>CV katalogas <span>({{$total}} CV)</span></h1>

        <div class="offers-filter">
            <form class="form-vertical" action="{{route('cv_index')}}" method="GET" accept-charset="utf-8">
                <div class="row form-group">
                    <div class="col-sm-3">
                    {!! Form::select(null, $cities, (isset($filter['cities']) ? $filter['cities'] : null), ['class' => 'form-control input-sm multiselect select-cities', 'multiple'=>'multiple']) !!}
                    </div>
                    <div class="col-sm-3">
                        <select name="gender" class="form-control input-sm">
                            <option value="">Lytis</option>
                            <option value="M"@if(isset($filter['gender']) && $filter['gender'] == 'M') selected="selected"@endif>Vyrai</option>
                            <option value="F"@if(isset($filter['gender']) && $filter['gender'] == 'F') selected="selected"@endif>Moterys</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <select name="cvOrder" class="form-control input-sm">
                            <option value="recent"@if(isset($filter['cvOrder']) && $filter['cvOrder'] == 'recent') selected="selected"@endif>Naujausi viršuje</option>
                            <option value="oldest"@if(isset($filter['cvOrder']) && $filter['cvOrder'] == 'oldest') selected="selected"@endif>Seniausi viršuje</option>
                        </select>
                    </div>
                    <div class="col-sm-3" style="margin-top: -6px">
                        <label>Amžius:</label>
                        <input type="text" id="age" name="age" readonly style="border:0;display:inline-block;width: 50px">
                        <div id="age-range"></div>
                    </div>

                </div>
                <div class="row form-group">
                    <div class="col-sm-6">
                        {!! Form::select(null, $scopes, (isset($filter['scopes']) ? $filter['scopes'] : null), ['class' => 'form-control input-sm multiselect select-scopes', 'multiple'=>'multiple']) !!}
                    </div>
                    <div class="col-sm-3">
                        {!! Form::text('tag', (isset($filter['tag']) ? $filter['tag'] : null), ['class' => 'form-control input-sm', 'placeholder'=>'Paieška pagal raktinį žodį']) !!}
                    </div>

                    <div class="col-sm-1">
                        <button type="submit" class="btn btn-sm btn-default" title="Ieškoti"><span class="glyphicon glyphicon-search"></span></button>
                    </div>
                    <div class="col-sm-1">
                        <button type="button" class="btn btn-sm btn-default" title="Išvalyti nustatymus" onclick="clearFilter()">
                            <span class="glyphicon glyphicon-remove"></span>
                        </button>
                    </div>
                </div>

                <input type="hidden" name="cities[]" value="">
                <input type="hidden" name="scopes[]" value="">
                <input type="hidden" name="institutions[]" value="">
            </form>
        </div>
        @include('cv.partials.list')
        <div class="text-center">{!! $cvs->render() !!}</div>
    </div>
@endsection

@section('styles')
<link href="{{ asset('/css/star-rating.min.css') }}" rel="stylesheet">
@endsection

@section('scripts')
<script src="{{ asset('/js/star-rating.min.js') }}"></script>
<script type="text/javascript">
$().ready(function() {
    $('.select-cities').multiselect('setOptions', {
        //numberDisplayed: 3,
        nSelectedText: ' miestai pažymėti',
        nonSelectedText: 'Pasirenkami miestai',
        checkboxName: 'cities[]',
        onChange: msOnChange
    });

    $('.select-cities').multiselect('rebuild');

    $('.select-scopes').multiselect('setOptions', {
        //numberDisplayed: 3,
        nSelectedText: ' sritys pažymėtos',
        nonSelectedText: 'Profesijų sritys',
        checkboxName: 'scopes[]',
        onChange: msOnChange
    });
    $('.select-scopes').multiselect('rebuild');

    $('.select-institutions').multiselect('setOptions', {
        //numberDisplayed: 3,
        nSelectedText: ' įstaigos pažymėtos',
        nonSelectedText: 'Mokslo įstaiga',
        checkboxName: 'institutions[]',
        onChange: msOnChange
    });
    $('.select-institutions').multiselect('rebuild');

    $('.select-courses').multiselect('setOptions', {
        //numberDisplayed: 3,
        nSelectedText: ' kursai pažymėti',
        nonSelectedText: 'Studijų kursas',
        checkboxName: 'courses[]',
        onChange: msOnChange
    });
    $('.select-courses').multiselect('rebuild');

    $('#age-range').slider({
          range: true,
          min: 0,
          max: 100,
          values: [{{$filter['age_from'] or 0}}, {{$filter['age_to'] or 100}}],
          slide: function( event, ui ) {
            $("#age").val(ui.values[0] + "-" + ui.values[1] );
          }
    });
    $("#age").val($("#age-range").slider("values", 0) + "-" + $("#age-range").slider("values", 1));


});

    function clearFilter() {
        location.href = '{{route('cv_index')}}';
    }

    $(".rating").rating({
        showClear: false,
        showCaption: false,
        disabled: true,
        step: 1,
        size: 'xs'
    });

</script>

@endsection