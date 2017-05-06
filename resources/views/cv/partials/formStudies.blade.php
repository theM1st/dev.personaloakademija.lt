<div id="studyForms">
    @include('errors.list')
    @foreach ($data as $k => $s)
        <div class="form @if($k == 0)first @endif" @if($k == 0) id="study-clone-area"@endif>
        {!! Form::open(['class' => 'form-horizontal']) !!}
            <div class="form-group">
                {!! Form::label('', 'Studijų/ mokymosi laikotarpis', ['class' => 'col-sm-5 control-label']) !!}
                <div class="col-sm-5">
                    <div class="row">
                        <div class="col-sm-6">
                            {!! Form::select('study_from_year', $yearsFrom, $s->study_from_year, ['class' => 'form-control input-sm']) !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::select('study_to_year', $yearsTo, $s->study_to_year, ['class' => 'form-control input-sm']) !!}
                        </div>
                    </div>
                </div>
                @if ($s->id)
                    <a href="{{Request::url()}}?removeStudy={{$s->id}}" class="remove-multiple-item" title="Ištrinti"><span class="glyphicon glyphicon-minus-sign"></span></a>
                @endif
            </div>
            <?php /*
            <div class="form-group">
                {!! Form::label('institution_id', 'Švietimo įstaiga Lietuvoje', ['class' => 'col-sm-5 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::select('institution_id', $institutions, $s->institution_id, ['class' => 'form-control input-sm', 'onchange' => 'institutionIdChange(this)']) !!}
                </div>
            </div> */ ?>
            <div class="form-group">
                {!! Form::label('institution_name', 'Švietimo įstaigos pavadinimas', ['class' => 'col-sm-5 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::text('institution_name', $s->institution_name, ['class' => 'form-control input-sm', 'placeholder' => 'Įrašyti']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('study_scope', 'Studijų/ mokymosi sritis', ['class' => 'col-sm-5 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::text('study_scope', $s->study_scope, ['class' => 'form-control input-sm', 'placeholder' => 'Įrašyti (pvz. Statybų inžinerija ir pan.)']) !!}
                </div>
                <div class="col-sm-1">
                    <span class="glyphicon glyphicon-info-sign" title="Svarbu! Nepildyti pradinio/viduriniojo mokslo įstaigos, jei įgytas ar įgyjamas aukštasis ar profesinis specialusis išsilavinimas."></span>
                </div>
            </div>
            <?php /*
            <div class="form-group">
                {!! Form::label('study_scope_id', 'Profesijos sritis', ['class' => 'col-sm-5 control-label required']) !!}
                <div class="col-sm-5">
                    {!! Form::select('study_scope_id', $scopes, $s->study_scope_id, ['class' => 'form-control input-sm']) !!}
                </div>
            </div>
            */ ?>
            <div class="form-group">
                {!! Form::label('specialty', 'Specialybės pavadinimas', ['class' => 'col-sm-5 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::text('specialty', $s->specialty, ['class' => 'form-control input-sm', 'placeholder' => 'Įrašyti']) !!}
                </div>
                <div class="col-sm-1">
                    <span class="glyphicon glyphicon-info-sign" title="Svarbu! Nepildyti pradinio/viduriniojo mokslo įstaigos, jei įgytas ar įgyjamas aukštasis ar profesinis specialusis išsilavinimas."></span>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('study_grade_id', 'Įgytas laipsnis', ['class' => 'col-sm-5 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::select('study_grade_id', $grades,  $s->study_grade_id, ['class' => 'form-control input-sm']) !!}
                </div>
                <div class="col-sm-1">
                    <span class="glyphicon glyphicon-info-sign" title="Svarbu! Nepildyti pradinio/viduriniojo mokslo įstaigos, jei įgytas ar įgyjamas aukštasis ar profesinis specialusis išsilavinimas."></span>
                </div>
            </div>
            {!! Form::hidden('id', $s->id) !!}
        {!! Form::close() !!}
        </div>
    @endforeach
    <div id="study-clone-area-container"></div>
    <div class="row">
        <div class="col-sm-offset-5 col-sm-5">
            <button type="button" class="btn btn-link clone-button" style="color: #008534" data-clone-type="block" data-clone-area="study-clone-area">
                <span class="glyphicon glyphicon-plus-sign"></span> Pridėti dar įrašų
            </button>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-offset-5 col-sm-5">
            <div class="row">
                <div class="col-sm-6">
                    {!! Form::button('Išsaugoti ir toliau', ['class' => 'btn btn-primary btn-sm', 'onclick'=>'ajaxForms(\'studyForms\')']) !!}
                </div>
                <div class="col-sm-6">
                    {!! Form::button('Praleisti ir toliau', ['class' => 'btn btn-secondary btn-sm', 'onclick'=>"skipState($cv->id, $currentState)"]) !!}
                </div>
            </div>
        </div>
    </div>
</div>