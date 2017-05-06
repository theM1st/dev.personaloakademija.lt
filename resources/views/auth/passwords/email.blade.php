@extends('app')

@section('title', 'Slaptažodžio atstatymas -')

<!-- Main Content -->
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Slaptažodžio atstatymas</div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <div>{{ $error }}</div>
                                    @endforeach
                                </div>
                        @endif

                        {!! Form::open(['method' => 'POST', 'route' => 'password.email', 'class' => 'form-horizontal']) !!}
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Jūsų el. paštas</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Gauti naują slaptažodį
                                    </button>
                                </div>
                            </div>
                        {!!  Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
