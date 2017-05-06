@extends('modal')

@section('content')
    {!! Form::open(['action'=>['OffersAdminController@deactivate', $offer->id], 'method' => 'post']) !!}
    <div class="form-group text-center">
        {!! Form::submit('Pasyvuoti', ['class' => 'btn btn-primary btn-sm', 'style'=>'margin-right:20px']) !!}
        {!! Form::button('Atšaukti', ['class' => 'btn btn-default btn-sm', 'data-dismiss'=>'modal']) !!}
    </div>
    {!! Form::close() !!}

@endsection