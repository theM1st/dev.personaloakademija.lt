<h1>Pakeisti slaptažodį</h1>
{!! Form::open(['action'=>array('UsersController@changePassword', $user->id)]) !!}
    <div class="form-group">
        {!! Form::label('password', 'Naujas slaptažodis', ['class' => 'sr-only']) !!}
        {!! Form::password('password', ['class' => 'form-control input-sm', 'placeholder' => 'Naujas slaptažodis']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('password_confirmation', 'Pakartoti slaptažodį', ['class' => 'sr-only']) !!}
        {!! Form::password('password_confirmation', ['class' => 'form-control input-sm', 'placeholder' => 'Pakartoti slaptažodį']) !!}
    </div>
    <div class="form-group row">
        <div class="col-sm-8">
            {!! Form::submit('Pakeisti', ['class' => 'btn btn-secondary']) !!}
        </div>
    </div>
{!! Form::close() !!}