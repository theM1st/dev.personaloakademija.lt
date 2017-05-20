@extends('app')

@section('title', "Naujas Top CV -")

@section('content')
    <h1>Naujas Top CV</h1>

    {!! Form::open(['route' => 'topCvs.store', 'class' => 'form-horizontal ajax-form']) !!}

        @include('admin.topCvs.partials.form')

    {!! Form::close() !!}

@endsection
@section('styles')
@endsection
@section('scripts')
    <script type="text/javascript">
        scopeCategoriesTrigger();
    </script>
@endsection