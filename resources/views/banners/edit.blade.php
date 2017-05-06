@extends('app')

@section('title', "Banerio redagavimas -")

@section('content')
    <div class="banners">
        <a href="{{action('BannersController@index')}}" class="btn btn-link"><span class="glyphicon glyphicon-arrow-left"></span> Atgal prie banerių</a>
        <h1>Banerio redagavimas</h1>

        {!! Form::open(['action' => ['BannersController@update', $banner->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'files' => true]) !!}
            @include('banners.partials.form')
        {!! Form::close() !!}
    </div>
@endsection