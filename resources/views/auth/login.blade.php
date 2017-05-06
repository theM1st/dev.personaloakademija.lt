@extends('app')

@section('title', 'Prisijungimas -')

@section('content')
    <h1>Prisijungimas</h1>
    @include('errors.list')
    <div class="row">
        <div class="col-sm-8">
            {!! Form::open(['method' => 'POST', 'route' => 'auth.login.post', 'class' => 'form-horizontal login-form']) !!}
                <div class="form-group">
                    {!! Form::label('email', 'Prisijungimo vardas', ['class' => 'col-sm-4 control-label']) !!}
                    <div class="col-sm-8">
                        {!! Form::text('email', null, ['class' => 'form-control input-sm', 'placeholder' => '...@...']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('password', 'Slaptažodis', ['class' => 'col-sm-4 control-label']) !!}
                    <div class="col-sm-8">
                        {!! Form::password('password', ['class' => 'form-control input-sm']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <div class="checkbox">
                            <label>
                                {!! Form::checkbox('remember', 1, true) !!} Prisiminti mane
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        {!! Form::submit('Prisijungti', ['class' => 'btn btn-secondary']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <a class="btn btn-primary" style="width: 49%" href="{{ route('password.reset') }}">Priminti slaptažodį</a>
                        <a class="btn btn-grey" style="margin-left: 2px; width: 49%" href="{{ route('auth.register') }}">Registruotis</a>
                    </div>
                </div>
                <input type="hidden" name="redirect" value="/">
            {!! Form::close() !!}
        </div>
        <div class="col-sm-4">
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
@endsection