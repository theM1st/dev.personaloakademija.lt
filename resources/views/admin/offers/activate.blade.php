@extends('modal')

@section('content')
    <p>Po aktyvavimo pasiūlymas galioja 30 dienų.</p>

    {!! Form::open(['action'=>['OffersAdminController@activate', $offer->id], 'method' => 'post']) !!}
    <div class="form-group text-center">
        {!! Form::submit('Aktyvuoti', ['class' => 'btn btn-primary btn-sm', 'style'=>'margin-right:20px']) !!}
        {!! Form::button('Atšaukti', ['class' => 'btn btn-default btn-sm', 'data-dismiss'=>'modal']) !!}
    </div>
    {!! Form::close() !!}

@endsection