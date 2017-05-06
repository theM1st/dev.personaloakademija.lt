@extends('app')

@section('title', "Darbo pasiūlymai -")

@section('content')
    <div class="admin-offers">
        <h1>Darbo pasiūlymai</h1>

        <form class="form-vertical" action="{{action('OffersAdminController@index')}}" method="GET" accept-charset="utf-8">
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

                <div class="col-sm-1">
                    <button type="submit" class="btn btn-sm btn-default" title="Ieškoti">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </div>
                <div class="col-sm-1">
                    <button type="button" class="btn btn-sm btn-default" title="Išvalyti nustatymus" onclick="clearFilter()">
                        <span class="glyphicon glyphicon-remove"></span>
                    </button>
                </div>
            </div>
            <input type="hidden" name="cities[]" value="">
            <input type="hidden" name="scopes[]" value="">
        </form>
        <br>
        <div style="margin-bottom: 10px">
            <a href="{{action('OffersAdminController@create')}}" class="btn btn-primary">Naujas darbo pasiūlymas</a>
        </div>
        @if ($offers->count())
            <table class="table table-striped">
                <tbody>
                @foreach ($offers as $o)
                    <tr @if (!$o->active)class="offer-inactive"@endif>
                        <td class="offer-logo">
                            @if ($o->logo)
                                <img src="{{$o->logo->relativeLogoSm}}" alt="" class="img-responsive">
                            @endif
                        </td>
                        <td class="offer-name">
                            <div>
                                @if($o->recruitment == 'soon' && $o->active)
                                    <div class="offer-hot"><img src="{{asset('assets/img/hot.png')}}" alt="hot" width="15"></div>
                                @endif
                                @if (!$o->active)
                                        <div class="offer-inactive-sign" title="Pasiūlymas pasyvuotas"><span class="glyphicon glyphicon-alert"></span></div>
                                @endif
                                <a href="{{route('offers_show', ['id' => $o->id])}}" class="offer-title">{{$o->work_position}}</a>
                            </div>
                            <div class="offer-city">
                                {{ $o->cities->pluck('name')->implode(', ') }}
                            </div>
                        </td>
                        <td>
                            <div class="offer-valid">Galioja {{$o->offer_valid_from->format('Y.m.d')}}-{{$o->offer_valid_until->format('Y.m.d')}}</div>

                            <div>
                                @if ($o->candidates()->count() > 0)
                                    <a href="{{action('CandidatesController@index', $o->id)}}">Gauti CV ({{$o->candidates()->count()}})</a>
                                @else
                                    Gauti CV (0)
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="glyphicon glyphicon-option-horizontal"></span>
                                </button>

                                <ul class="dropdown-menu dropdown-menu-right">

                                    <li><a href="{{action('OffersAdminController@edit', $o->id)}}">Redaguoti</a></li>
                                    <li>
                                        @if ($o->active)
                                            <a href="{{action('OffersAdminController@deactivate', $o->id)}}" class="action-modal" data-size="modal-sm" data-method="get">
                                                Pasyvuoti
                                            </a>
                                        @else
                                            <a href="{{action('OffersAdminController@activate', $o->id)}}" class="action-modal" data-size="modal-sm" data-method="get">
                                                Aktyvuoti
                                            </a>
                                        @endif
                                    </li>
                                    <li>
                                        <a href="{{action('OffersAdminController@delete', $o->id)}}" class="action-modal" data-size="modal-sm" data-method="get">
                                            Trinti
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="text-center">{!! $offers->render() !!}</div>
        @endif
    </div>
@endsection
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
            location.href = '{{action('OffersAdminController@index')}}';
        }
    </script>
@endsection