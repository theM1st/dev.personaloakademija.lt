@include('errors.list')
@if (Session::has('success'))
    <div class="alert alert-success text-center">
        <p>Ačių, Jūsų klausimas sėkmingai išsiųstas!</p>
        <br>
        <p>Personalo akademija administracija</p>
    </div>
@endif
{{ Form::open(['route' => 'page.requestForm']) }}

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {{ Form::label("rf_name", 'Jūsų vardas, Pavardė', [ 'class' => 'control-label required' ]) }}
                {{ Form::text("rf_name", old("rf_name"), [ 'class' => 'form-control' ]) }}
            </div>
            <div class="form-group">
                {{ Form::label("rf_position", 'Jūsų užimamos vadovaujamos pareigos', [ 'class' => 'control-label required' ]) }}
                {{ Form::text("rf_position", old("rf_position"), [ 'class' => 'form-control' ]) }}
            </div>
            <div class="form-group">
                {{ Form::label("rf_company", 'Įmonės, kurioje dirbate, pavadinimas', [ 'class' => 'control-label required' ]) }}
                {{ Form::text("rf_company", old("rf_company"), [ 'class' => 'form-control' ]) }}
            </div>
            <div class="form-group">
                {{ Form::label("rf_telephone", 'Jūsų mob. tel. numeris', [ 'class' => 'control-label' ]) }}
                {{ Form::text("rf_telephone", old("rf_telephone"), [ 'class' => 'form-control' ]) }}
            </div>
            <div class="form-group">
                {{ Form::label("rf_email", 'Jūsų darbinis el. paštas', [ 'class' => 'control-label required' ]) }}
                {{ Form::text("rf_email", old("rf_email"), [ 'class' => 'form-control' ]) }}
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                {{ Form::label("rf_question_theme", 'Jūsų klausimo tema', [ 'class' => 'control-label required' ]) }}
                {{ Form::text("rf_question_theme", old("rf_question_theme"), [ 'class' => 'form-control' ]) }}
            </div>
            <div class="form-group">
                {{ Form::label("rf_question", 'Jūsų klausimas', [ 'class' => 'control-label required' ]) }}
                {{ Form::textarea("rf_question", old("rf_question"), [ 'class' => 'form-control' ]) }}
            </div>
        </div>
    </div>
    <div class="text-center">
        {{ Form::submit('Siųsti', ['class' => 'btn btn-primary']) }}
    </div>
{{ Form::close() }}