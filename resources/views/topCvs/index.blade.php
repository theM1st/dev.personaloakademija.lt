@extends('app')

@section('title', 'Top CV')

@section('content')
    <div class="top-cv">
        <h1>Top CV ({{ $cvs->total() }})</h1>
        <form class="form-vertical" action="{{ route('topCv.index') }}" method="GET" accept-charset="utf-8">
            <div class="filters">
                <div class="row" style="margin-bottom: 10px;">
                    <div class="col-sm-2">
                        <div class="city-filter">
                            @foreach ($cities as $id => $city)
                                <div>
                                    {{ Form::label("city-$id", $city) }}
                                    <input name="cities[]" type="checkbox" id="city-{{ $id }}" value="{{ $id }}"{{ (isset($filter['cities']) && in_array($id, $filter['cities']) ? ' checked="checked"' : '') }}>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="gender-filter">
                            @foreach ($genders as $val => $gender)
                                <div>
                                    {{ Form::label("gender-$val", $gender) }}
                                    <input name="genders[]" type="checkbox" id="gender-{{ $val }}" value="{{ $val }}"{{ (isset($filter['genders']) && in_array($val, $filter['genders']) ? ' checked="checked"' : '') }}>
                                </div>
                            @endforeach
                        </div>
                        <div class="age-filter text-right">
                            {{ Form::label('ageFrom', 'Amžius: nuo') }}
                            {{ Form::text('ageFrom', (isset($filter['ageFrom']) ? $filter['ageFrom'] : null), ['class'=>'form-control input-sm']) }}
                            {{ Form::label('ageTo', 'Amžius: iki') }}
                            {{ Form::text('ageTo', (isset($filter['ageTo']) ? $filter['ageTo'] : null), ['class'=>'form-control input-sm']) }}
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="scope-filter">
                            @foreach ($scopes as $scope)
                                <div>
                                    {{ Form::label('scopes', $scope->name) }}
                                    <span class="form-group">
                                        {!! Form::select('scopes[]', $scope->categories->pluck('name', 'id'), (isset($filter['scopes']) ? $filter['scopes'] : null), ['class' => 'form-control input-sm multiselect select-scopes', 'multiple'=>'multiple']) !!}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @if (auth()->check() && auth()->user()->isAdminWorker())
                        <div class="col-sm-12 text-center base-filter">
                            <span>
                                <input type="checkbox" name="bases[]" id="cv-base-top" value="top"{{ (isset($filter['bases']) && in_array('top', $filter['bases']) ? ' checked="checked"' : '') }}>
                                {{ Form::label('cv-base-top', 'Top CV') }}
                            </span>
                            <span>
                                <input type="checkbox" name="bases[]" id="cv-base-common" value="common"{{ (isset($filter['bases']) && in_array('common', $filter['bases']) ? ' checked="checked"' : '') }}>
                                {{ Form::label('cv-base-common', 'Ne Top CV') }}
                            </span>
                        </div>
                    @endif
                </div>
                <div class="text-center">
                    {{ Form::text('tags', (isset($filter['tags']) ? $filter['tags'] : null), ['class'=>'form-control', 'placeholder'=>'Raktiniai žodžiai', 'style'=>'display:inline;width: auto;vertical-align: middle;']) }}

                    {{ Form::submit('Ieškoti', ['class' => 'btn btn-default', 'style'=>'margin: 0 10px']) }}
                    <a href="{{ route('topCv.index') }}" class="btn btn-secondary">Išvalyti paiešką</a>
                </div>
            </div>
        </form>
        @if (auth()->check() && auth()->user()->isAdminWorker())
            <div style="margin-bottom: 20px">
                <a href="{{action('TopCvsAdminController@create')}}" class="btn btn-primary">
                    Naujas CV
                </a>
            </div>
        @endif
        <table class="table table-striped">
            <thead>
                <tr>
                    <th></th>
                    <th colspan="2">
                        Profesinė patirtis
                    </th>
                    <th colspan="2">
                        Išsilavinimas
                    </th>
                    <th></th>
                </tr>
            </thead>
            @foreach($cvs as $item)
                <tr>
                    <td>
                        <a href="{{ route('topCv.show', $item->cv_number) }}">
                            {{ $item->genderName }}<br>
                            {{ $item->age }} m.<br>
                            {{ $item->city ? $item->city->name : '' }}<br>
                        </a>
                    </td>
                    <td class="scope-col">
                        {{ $item->scope ? $item->scope->name : '' }}
                    </td>
                    <td class="category-col">
                        <div class="bordered">
                            @if ($item->categories->count())
                                @foreach ($item->categories as $c)
                                    <div title="{{ $c->name }}">{{ str_limit($c->name, 24) }}</div>
                                @endforeach
                            @endif
                        </div>
                    </td>
                    <td class="institution-col">
                        @if ($studies = $item->studies->sortByDesc('id')->take(2))
                            @foreach ($studies as $s)
                                <div title="{{ $s->institution }}">{{ str_limit($s->institution, 24) }}</div>
                            @endforeach
                        @endif
                    </td>
                    <td class="specialty-col">
                        <div class="bordered">
                            @foreach ($item->studies as $s)
                                <div title="{{ $s->specialty }}">{{ str_limit($s->specialty, 24) }}</div>
                            @endforeach
                        </div>
                    </td>
                    <td>
                        <strong>
                            CV įkeltas<br>
                            {{ $item->created_at->format('Y.m.d') }}<br>
                        </strong>
                    </td>
                </tr>
            @endforeach
        </table>
        <div class="text-center">{!! $cvs->render() !!}</div>
    </div>
@endsection