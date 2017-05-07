@extends('app')

@section('title', 'Top CV')

@section('content')
    <div class="top-cv">
        <h1>Top CV ({{ $cvs->total() }})</h1>
        <form class="form-vertical" action="{{ route('topCv.index') }}" method="GET" accept-charset="utf-8">
            <div class="filters">
                <div class="row" style="margin-bottom: 10px;">
                    <div class="col-sm-3">
                        <div class="city-filter">
                            @foreach ($cities as $id => $city)
                                <div>
                                    {{ Form::label('cities', $city) }}
                                    <input name="cities[]" type="checkbox" value="{{ $id }}"{{ (isset($filter['cities']) && in_array($id, $filter['cities']) ? ' checked="checked"' : '') }}>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-sm-3">

                    </div>
                    <div class="col-sm-6">

                    </div>
                </div>
                <div class="text-center">
                    {{ Form::submit('Ieškoti', ['class' => 'btn btn-default']) }}
                </div>
            </div>
        </form>
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