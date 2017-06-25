@extends('app')

@section('title', 'Siųsti savo CV')

@section('content')
    <h1>CV  SIUNTIMAS Į TOP CV</h1>

    @if (Session::has('success'))
        <div class="alert alert-success text-center">
            <p>Ačių. Jūsų CV sėkmingai išsiųstas!</p>
            <br>
            <p>
                Artimiausiomis valandomis su Jumis susisieks Personalo akademijos atsakingas asmuo.<br>
                <strong>Personalo akademijos</strong> administracija.
            </p>
        </div>
    @endif

    @include('errors.list')

    {!! Form::open(['route' => 'topCv.postSent', 'method'=>'post', 'class' => 'form-horizontal', 'files' => true]) !!}
        <div class="form-group">
            <div class="col-sm-6 col-sm-offset-1">
                <div class="clearfix" style="margin-top:10px">
                    <div class="btn btn-sm btn-default pull-left upload-button" data-name="cv_file" style="padding: 5px 30px;">Pasirinkite savo CV</div>
                    <div id="cv_file-filename" class="btn btn-sm pull-left" style="cursor: default">CV dar nepasirinktas</div>
                </div>
                {!! Form::file('cv_file') !!}
                <p class="help-block">CV turi būti Word arba PDF formatu (iki 10 MB)</p>
                {!! Form::submit('Siųsti savo CV', ['class' => 'btn btn-primary btn-sm']) !!}
            </div>
            <div class="col-sm-5">
                <p style="font-weight: bold">Svarbu:</p>
                <ul style="padding-left:10px">
                    <li style="margin-bottom:10px">
                        Top CV duomenų bazė kaupiama ir naudojama tik
                        Personalo akademijos vykdomų specialistų
                        paieškų ir atrankų tikslams.
                    </li>
                    <li style="margin-bottom:10px">
                        CV duomenys tiesiogiai neprieinami tretiesiems
                        fiziniams ir juridiniams asmenims (kompanijų
                        vadovams).
                    </li>
                    <li style="margin-bottom:10px">
                        CV duomenys kompanijų vadovams pateikiami:<br>
                        - tik CV savininkui davus raštišką sutikimą kiekvienam
                        konkrečiam darbo pasiūlymo atvejui;<br>
                        - tik darbo pasiūlymus teikiantiems kompanijų
                        vadovams;<br>
                        - tik tais atvejais, kai kompanijos vadovai yra davę
                        raštišką įsipareigojimą laikyti paslaptyje gautų CV
                        duomenis.
                    </li>
                    <li style="margin-bottom:10px">
                        Už CV esančios informacijos slaptumo saugojimą
                        Personalo akademija atsako pagal LR įstatymus.
                    </li>
                </ul>
                <p class="text-right" style="font-weight: bold">Personalo akademijos direktorius<br>Kostas Zalatoris</p>
            </div>
        </div>

    {!! Form::close() !!}
@endsection