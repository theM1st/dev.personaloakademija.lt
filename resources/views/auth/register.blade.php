@extends('app')

@section('title', 'Registracija -')

@section('content')

    @include('errors.list')

    @if (Session::has('success'))
        <div class="text-center" style="font-weight: bold">
            <p>Jūs sėkmingai užsiregistravote!</p>
            <p style="font-weight: bold">Prisijungimo slaptažodžiai Jums išsiųsti į el. paštą.</p>
            <br>
            <p><span style="color:#003366">Personalo akademija</span> administracija</p>
        </div>
    @else
        <h1>Registracija</h1>
        <div class="row registration-form">
            <div class="col-sm-5 col-sm-offset-2">
                {!! Form::open(['method' => 'POST', 'route' => 'auth.register.post', 'class' => 'form-horizontal']) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'Vardas, pavardė', ['class' => 'sr-only']) !!}
                        {!! Form::text('name', null, ['class' => 'form-control input-sm', 'placeholder' => 'Vardas, pavardė*']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('telephone', 'Mobilus tel. nr.', ['class' => 'sr-only']) !!}
                        {!! Form::text('telephone', null, ['class' => 'form-control input-sm', 'placeholder' => 'Mobilus tel. nr.*']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('email', 'El. paštas', ['class' => 'sr-only']) !!}
                        {!! Form::text('email', null, ['class' => 'form-control input-sm', 'placeholder' => 'El. paštas*']) !!}
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12">
                            {!! Form::submit('Sutinku registruotis', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
            <div class="col-sm-5">
                <p style="font-weight: bold">Svarbu:</p>
                <ul style="padding-left:10px">
                    <li style="margin-bottom:10px">CV duomenų bazė naudojama tik Personalo akademijos specialistų paieškai ir atrankoms.</li>
                    <li style="margin-bottom:10px">Asmenų CV neteikiami tretiesiems fiziniams ir juridiniams asmenims.</li>
                    <li style="margin-bottom:10px">
                        Už CV esančios informacijos slaptumo saugojimą Personalo akademija atsako pagal LR įstatymus.
                    </li>
                </ul>
                <p class="text-right" style="font-weight: bold">Personalo akademijos direktorius<br>Kostas Zalatoris</p>
            </div>
        </div>
    @endif
@endsection