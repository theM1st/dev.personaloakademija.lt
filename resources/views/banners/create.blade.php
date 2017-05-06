@extends('app')

@section('title', "Banerio sukūrimas -")

@section('content')
    <div class="banners">
        <a href="{{action('BannersController@index')}}" class="btn btn-link"><span class="glyphicon glyphicon-arrow-left"></span> Atgal prie banerių</a>
        <h1>Banerio sukūrimas</h1>

        {!! Form::open(['action' => 'BannersController@store', 'class'=>'form-horizontal', 'files' => true]) !!}
            @include('banners.partials.form')
        {!! Form::close() !!}
    </div>
@endsection