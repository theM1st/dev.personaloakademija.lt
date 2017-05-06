@extends('app')

@section('title', "CV $cv->cv_name -")

@section('content')
    @include('cv.partials.cv')
@endsection
