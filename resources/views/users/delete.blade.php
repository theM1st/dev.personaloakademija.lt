@extends('modal')

@section('content')
    {!! Form::open(['action'=>['UsersController@destroy', $user->id], 'method' => 'DELETE']) !!}
        <div class="form-group">
            {!! Form::submit('Taip', ['class' => 'btn btn-danger', 'style'=>'margin-right:20px']) !!}
            {!! Form::button('Ne', ['class' => 'btn btn-primary', 'data-dismiss'=>'modal']) !!}
        </div>
    {!! Form::close() !!}
@endsection