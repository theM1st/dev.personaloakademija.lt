@extends('app')

@section('title', "CV darbuotojai")

@section('content')
    @include('admin.partials.workerForm')
<br>
    <h1>CV katalogo vartotojai</h1>
    @if ($workers->count())
        <table class="table table-striped">
            <thead>
                <tr>

                    <td>Vardas</td>
                    <td>El. paštas</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @foreach ($workers as $w)
                    <tr>
                        <td>{{$w->name}}</td>
                        <td>{{$w->email}}</td>
                        <td class="text-right">
                            <a href="{{action('AdminController@workerEdit', ['id'=>$w->id])}}" class="btn btn-primary btn-sm">Redaguoti</a>
                            <a href="{{action('AdminController@workerDestroy', ['id'=>$w->id])}}" class="btn btn-danger btn-sm" onclick="return confirm('Ar tikrai ištrinti?')">
                                Trinti
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="text-center">Nėra</div>
    @endif
@endsection