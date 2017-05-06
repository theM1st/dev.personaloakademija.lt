@extends('app')

@section('title', "Pasiūlymo redagavimas -")

@section('content')
    <h1>Pasiūlymo redagavimas</h1>
    {!! Form::open(['action' => array('OffersAdminController@update', $offer->id), 'method'=>'PUT', 'id' => 'offer-form', 'class' => 'offer-from', 'files' => true]) !!}
    @include('admin.offers.partials.form')
    {!! Form::close() !!}
    <br>
@endsection