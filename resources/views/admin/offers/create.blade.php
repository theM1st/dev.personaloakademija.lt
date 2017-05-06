@extends('app')

@section('title', "Naujas darbo pasiūlymas -")

@section('content')
    <h1>Naujas darbo pasiūlymas</h1>
    {!! Form::open(['action' => 'OffersAdminController@store', 'id' => 'offer-form', 'class' => 'offer-from', 'files' => true]) !!}
    @include('admin.offers.partials.form')
    {!! Form::close() !!}
    <br>
@endsection