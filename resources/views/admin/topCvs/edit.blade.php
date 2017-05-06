@extends('app')

@section('title', "Top CV Redagavimas -")

@section('content')
    @if (request()->has('updated'))
        <div class="alert alert-success text-center" role="alert">
            CV sėkmingai atnaujintas
        </div>
    @endif
    <h1>Top CV Redagavimas</h1>

    {!! Form::model($cv, ['route' => ['topCvs.update', $cv->id], 'method'=>'put', 'class'=>'form-horizontal ajax-form']) !!}

        @include('admin.topCvs.partials.form')

    {!! Form::close() !!}

@endsection
@section('scripts')
    <script type="text/javascript">
        scopeCategoriesTrigger();
    </script>
@endsection