@extends('modal')

@section('content')
    {!! Form::open(['action'=>['CvController@destroy', $cv->id], 'method' => 'DELETE']) !!}
    <div class="form-group text-center">
        {!! Form::submit('Trinti', ['class' => 'btn btn-danger btn-sm', 'style'=>'margin-right:20px']) !!}
        {!! Form::button('Atšaukti', ['class' => 'btn btn-default btn-sm', 'data-dismiss'=>'modal']) !!}
    </div>
    {!! Form::close() !!}

@endsection