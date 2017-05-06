<h1>
    @if (isset($worker))
        Redaguoti darbuotoją
    @else
        Naujas darbuotojas
    @endif
</h1>

@include('errors.list')

<div class="row">
    <div class="col-sm-5 center-block" style="float: none">
    @if (isset($worker))
    {!! Form::open(['action'=> array('AdminController@workerUpdate', $worker->id)]) !!}
    @else
    {!! Form::open(['action'=>'AdminController@workerStore']) !!}
    @endif
        <div class="form-group">
            {!! Form::label('name', 'Vardas', ['class' => 'sr-only']) !!}
            {!! Form::text('name', isset($worker->name) ? $worker->name : null, ['class' => 'form-control input-sm', 'placeholder' => 'Vardas, pavardė']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('email', 'El. paštas', ['class' => 'sr-only']) !!}
            {!! Form::text('email', isset($worker->email) ? $worker->email : null, ['class' => 'form-control input-sm', 'placeholder' => 'El. paštas']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('password', 'Slaptžodis', ['class' => 'sr-only']) !!}
            {!! Form::password('password', ['class' => 'form-control input-sm', 'placeholder' => 'Slaptžodis']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Išsaugoti', ['class' => 'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}
    </div>
</div>