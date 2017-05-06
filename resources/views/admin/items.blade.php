@extends('app')

@section('title', "Darbo ir profesinės praktikos pasiūlymų administravimas")

@section('content')
    <a href="{{action('AdminController@index')}}" class="btn btn-link"><span class="glyphicon glyphicon-arrow-left"></span> Atgal prie administravimo meniu</a>
    <h1>Darbo ir profesinės praktikos pasiūlymų administravimas</h1>

    <ul id="itemsMenu" class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#offer" aria-controls="offer" role="tab" data-toggle="tab">
            Darbo ir profesinės praktikos pasiūlymų peržiūra, redagavimas ir paskelbimas
            </a>
        </li>
        <li role="presentation">
            <a href="#cv" aria-controls="cv" role="tab" data-toggle="tab">
                CV peržiūra, redagavimas ir paskelbimas
            </a>
        </li>
    </ul>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="offer">
            <br>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>Sukurta</td>
                        <td>Pareigų pavadinimas</td>
                        <td>Kompanjos pavadinimas</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($offers as $o)
                        <tr>
                            <td>{{$o->created_at->format('Y-m-d H:i')}}</td>
                            <td>
                                <div class="dropdown">
                                    <a href="{{route("company_offer_edit", ['id'=>$o->id])}}" onclick="location.href=this.href" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="offer{{$o->id}}">{{$o->work_position}}</a>
                                    <ul class="dropdown-menu" aria-labelledby="offer{{$o->id}}">
                                        <li>
                                            <a href="{{route("company_offer_edit", ['id'=>$o->id])}}">Redaguoti ir paskelbti</a>
                                            <a href="{{route("{$pageScope}_offer", ['id'=>$o->id])}}">Peržiūrėti ir paskelbti</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <a href="{{route('company_profile', ['id'=>$o->user_id])}}" onclick="location.href=this.href" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="company{{$o->id}}">
                                        {{$o->user->company_name}}
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="company{{$o->id}}">
                                        <li>
                                            <a href="{{route('company_profile', ['id'=>$o->user_id])}}" target="_blank">Redaguoti</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="text-center">{!! $offers->render() !!}</div>
        </div>
        <div role="tabpanel" class="tab-pane" id="cv">
            <br>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>Sukurta</td>
                        <td>CV pavadinimas</td>
                        <td>CV autorius</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cvs as $c)
                        <tr>
                            <td>{{$c->created_at->format('Y-m-d H:i')}}</td>
                            <td>
                                <div class="dropdown">
                                    <a href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="cv{{$c->id}}">{{$c->cv_fullname}}</a>
                                    <ul class="dropdown-menu" aria-labelledby="cv{{$c->id}}">
                                        <li>
                                            <a href="{{route("graduate_cv_show", ['id'=>$c->id])}}">Redaguoti ir paskelbti</a>
                                            <a href="{{action('CompaniesController@cv', ['id'=>$c->id])}}">Peržiūrėti ir paskelbti</a>

                                        </li>
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <a href="{{route('company_profile', ['id'=>$c->user_id])}}" onclick="location.href=this.href">
                                    {{$c->user->name}}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
    $().ready(function() {
        @if (!empty($request->get('cv')))
            $('#itemsMenu a[href="#cv"]').tab('show') ;
        @endif
    });
    </script>
@endsection