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
                </div>
                <div class="text-center">
                    {{ Form::text('tags', (isset($filter['tags']) ? $filter['tags'] : null), ['class'=>'form-control', 'placeholder'=>'Raktiniai žodžiai', 'style'=>'display:inline;width: auto;vertical-align: middle;']) }}

                    {{ Form::submit('Ieškoti', ['class' => 'btn btn-default', 'style'=>'margin: 0 10px']) }}
                    <a href="{{ route('topCv.index') }}" class="btn btn-secondary">Išvalyti paiešką</a>
                </div>
            </div>
        </form>
        <div style="margin-bottom: 20px">
            <a href="{{action('TopCvsAdminController@create')}}" class="btn btn-primary">Naujas Top CV</a>
        </div>
        <table class="table table-striped">
            @foreach($cvs as $item)
                <tr>
                    <td{{ !$item->active ? ' class=inactive' : '' }}>
                        <a href="{{ route('topCv.show', $item->id) }}">
                            <strong>{{ $item->cv_name }}</strong>
                        </a>
                    </td>
                    <td>
                        {{ $item->genderName }}<br>
                        {{ $item->age }} m.<br>
                        {{ $item->city ? $item->city->name : '' }}<br>
                    </td>
                    <td>
                        {{ $item->scope ? $item->scope->name : '' }}<br>
                        {{ $item->category ? $item->category->name : '' }}<br>
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