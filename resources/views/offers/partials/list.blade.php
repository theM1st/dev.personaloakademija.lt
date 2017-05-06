<div class="offers-filter">
    <form class="form-vertical" action="{{route('offers_index')}}" method="GET" accept-charset="utf-8">
        <div class="row" style="margin-bottom: 5px">
            <div class="col-sm-5">
                <select name="offerType" class="form-control input-sm">
                    <option value="">Darbo pasiūlymai</option>
                    <option value="hot"@if(isset($filter['offerType']) && $filter['offerType'] == 'hot') selected="selected"@endif>Karšti pasiūlymai</option>
                </select>
            </div>
			<div class="col-sm-4">
                <select name="offerOrder" class="form-control input-sm">
                    <option value="">Karšti ir naujausi viršuje</option>
                    <option value="recent"@if(isset($filter['offerOrder']) && $filter['offerOrder'] == 'recent') selected="selected"@endif>Naujausi viršuje</option>
                    <option value="oldest"@if(isset($filter['offerOrder']) && $filter['offerOrder'] == 'oldest') selected="selected"@endif>Seniausi viršuje</option>
                </select>
            </div>
            <div class="col-sm-3">
                {!! Form::text('tag', (isset($filter['tag']) ? $filter['tag'] : null), ['class' => 'form-control input-sm', 'placeholder'=>'Paieška pagal raktinį žodį']) !!}
            </div>
        </div>
        <div class="row form-group">
            <div class="col-sm-3">
            {!! Form::select(null, $cities, (isset($filter['cities']) ? $filter['cities'] : null), ['class' => 'form-control input-sm multiselect select-cities', 'multiple'=>'multiple']) !!}
            </div>
            <div class="col-sm-7">
            {!! Form::select(null, $scopes, (isset($filter['scopes']) ? $filter['scopes'] : null), ['class' => 'form-control input-sm multiselect select-scopes', 'multiple'=>'multiple']) !!}
            </div>
            
            <div class="col-sm-1 col-xs-2">
                <button type="submit" class="btn btn-sm btn-default" title="Ieškoti">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </div>
            <div class="col-sm-1 col-xs-2">
                <button type="button" class="btn btn-sm btn-default" title="Išvalyti nustatymus" onclick="clearFilter()">
                    <span class="glyphicon glyphicon-remove"></span>
                </button>
            </div>
        </div>
        <input type="hidden" name="cities[]" value="">
        <input type="hidden" name="scopes[]" value="">
    </form>
</div>
<br>
<table class="table table-striped">
    @foreach($offers as $o)
        <tr>
            <td class="offer-logo">
                @if ($o->logo && $o->show_company_info)
                    <img src="{{$o->logo->relativeLogoSm}}" alt="" class="img-responsive">
                @endif
            </td>
            <td class="offer-name">
                <div>
                    @if($o->recruitment == 'soon' && empty($filter['offerOrder']))
                        <div  class="offer-hot">
                            <img src="{{ asset('assets/img/hot.png') }}" alt="hot" width="15">
                        </div>
                    @endif
                    <a href="{{route("offers_show", ['id'=>$o->id])}}" class="offer-title">{{$o->work_position}}</a>
                </div>
                <div class="offer-city">{{ $o->cities->pluck('name')->implode(', ') }}</div>
            </td>
            <td>
                <div class="offer-valid">
                    Nuo {{$o->offer_valid_from->format('Y.m.d')}}<br>
                    Iki {{$o->offer_valid_until->format('Y.m.d')}}
                </div>
            </td>
        </tr>
    @endforeach
</table>
@section('scripts')
<script type="text/javascript">
$().ready(function() {
    $('.select-cities').multiselect('setOptions', {
        //numberDisplayed: 2,
        nSelectedText: ' miestai pažymėti',
        nonSelectedText: 'Pasirenkami miestai',
        checkboxName: 'cities[]',
        onChange: msOnChange
    });

    $('.select-cities').multiselect('rebuild');

    $('.select-scopes').multiselect('setOptions', {
        //numberDisplayed: 1,
        nSelectedText: ' sritys pažymėtos',
        nonSelectedText: 'Profesijų sritys',
        checkboxName: 'scopes[]',
        onChange: msOnChange
    });
    $('.select-scopes').multiselect('rebuild');
});

function clearFilter() {
    location.href = '{{route("offers_index")}}';
}
</script>
@endsection