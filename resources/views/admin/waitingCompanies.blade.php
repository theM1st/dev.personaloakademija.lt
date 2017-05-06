@extends('app')

@section('title', "Įmonės")

@section('content')
    <a href="{{action('AdminController@index')}}" class="btn btn-link"><span class="glyphicon glyphicon-arrow-left"></span> Atgal prie administravimo meniu</a>
    <h1>Įmonės laukia patvirtinimo</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <td>Įmonės pavadinimas</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($companies as $c)
                <tr>
                    <td>
                        <div class="dropdown">
                            <a href="{{route('company_profile', ['id'=>$c->id])}}" onclick="location.href=this.href" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="company{{$c->id}}">
                                {{$c->company_name}}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="company{{$c->id}}">
                                <li>
                                    <a href="{{route('company_profile', ['id'=>$c->id])}}" target="_blank">Redaguoti</a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-center">{!! $companies->render() !!}</div>
@endsection