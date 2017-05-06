@extends('app')

@section('title', 'Įmonės profilis -')

@section('content')
    @include('errors.list')

    @if (Session::has('success'))
        <div class="row">
            <div class="col-sm-5 center-block" style="float: none">
                <div class="alert alert-success" role="alert">
                    @if (Session::get('success') == 'sentPassword')
                        <p>Išsaugota ir slaptažodis išsiųstas!</p>
                    @else
                        <p>Išsaugota!</p>
                    @endif
                </div>
            </div>
        </div>
    @endif
    <h1>
        Mano profilis
        @if ($user->isAdmin())
            <a href="{{action('UsersController@delete', ['id'=>$user->id])}}" class="btn btn-link action-modal" data-size="modal-sm" data-method="get" style="color:#C20606;margin-left:80px;font-size:22px" title="Profilio trynimas">
                <span class="glyphicon glyphicon-remove-sign"></span>
            </a>
        @endif
    </h1>
    <div class="row">
        {!! Form::open(['action'=>array('UsersController@update', $user->id), 'method' => 'PUT']) !!}

        <div class="col-sm-5 center-block" style="float: none">
            <div class="form-group">
                {!! Form::label('name', 'Vardas, pavardė', ['class' => 'sr-only']) !!}
                {!! Form::text('name', $user->name, ['class' => 'form-control input-sm', 'placeholder' => 'Vardas, pavardė*']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('telephone', 'Mobilus tel. nr.', ['class' => 'sr-only']) !!}
                {!! Form::text('telephone', $user->telephone, ['class' => 'form-control input-sm', 'placeholder' => 'Mobilus tel. nr.*']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email', 'El. paštas', ['class' => 'sr-only']) !!}
                {!! Form::text('email', $user->email, ['class' => 'form-control input-sm', 'placeholder' => 'El. paštas*']) !!}
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    {!! Form::submit('Išsaugoti', ['class' => 'btn btn-primary']) !!}
                </div>

            </div>
        </div>
        {!! Form::hidden('user_id', $user->id) !!}
        {!! Form::close() !!}
    </div>

    <div class="row">
        <div class="col-sm-5 center-block" style="float: none">
            <br>
            @include('users.changePasswordForm')
        </div>
    </div>
@endsection