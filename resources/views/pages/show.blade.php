@extends('app')

@section('title', "$page->title -")

@section('content')
    <h1>{{ $page->title }}</h1>
    {!! str_replace('{contact_form}', $contactForm, str_replace('{request_form}', $requestForm, $page->content)) !!}
@endsection