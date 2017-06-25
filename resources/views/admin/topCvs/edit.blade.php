@extends('app')

@section('title', "CV Redagavimas -")

@section('content')
    <h1>CV Redagavimas</h1>

    {!! Form::model($cv, ['route' => ['topCvs.update', $cv->id], 'method'=>'put', 'class'=>'form-horizontal ajax-form']) !!}

        @include('admin.topCvs.partials.form')

    {!! Form::close() !!}

@endsection
@section('styles')
@endsection
@section('scripts')
    <script type="text/javascript">
       scopeCategoriesTrigger({!! json_encode($cv->categories->pluck('id', 'id')->toArray()) !!});
    </script>
@endsection