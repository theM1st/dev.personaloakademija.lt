@include('errors.list')
@if (Session::has('success'))
    <div class="alert alert-success text-center">
        <p>Ačių, Jūsų klausimas sėkmingai išsiųstas!</p>
        <br>
        <p>Personalo akademija administracija</p>
    </div>
@endif
{{ Form::open(['route' => 'page.contactForm']) }}

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {{ Form::label("cf_name", 'Jūsų vardas, Pavardė', [ 'class' => 'control-label required' ]) }}
                {{ Form::text("cf_name", old("cf_name"), [ 'class' => 'form-control' ]) }}
            </div>
            <div class="form-group">
                {{ Form::label("cf_email", 'Jūsų el. paštas', [ 'class' => 'control-label required' ]) }}
                {{ Form::text("cf_email", old("cf_email"), [ 'class' => 'form-control' ]) }}
            </div>
            <div class="form-group">
                {{ Form::label("cf_question_theme", 'Jūsų klausimo tema', [ 'class' => 'control-label required' ]) }}
                {{ Form::text("cf_question_theme", old("cf_question_theme"), [ 'class' => 'form-control' ]) }}
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                {{ Form::label("cf_question", 'Jūsų klausimas', [ 'class' => 'control-label required' ]) }}
                {{ Form::textarea("cf_question", old("cf_question"), [ 'class' => 'form-control' ]) }}
            </div>
        </div>
    </div>
    <div class="text-center">
        {{ Form::submit('Siųsti', ['class' => 'btn btn-primary']) }}
    </div>
{{ Form::close() }}