<div id="participationForms">
    @include('errors.list')
    @foreach ($data as $k => $p)
        <div class="form @if($k == 0)first @endif" @if($k == 0) id="participation-clone-area"@endif>
            {!! Form::open(['class' => 'form-horizontal']) !!}
                <div class="form-group">
                    {!! Form::label('participation_type_id', 'Įvykis', ['class' => 'col-sm-4 control-label']) !!}
                    <div class="col-sm-7">
                        {!! Form::select('participation_type_id', $types, $p->participation_type_id, ['class' => 'form-control input-sm']) !!}
                    </div>
                    @if ($p->id)
                        <a href="{{Request::url()}}?removeParticipation={{$p->id}}" class="remove-multiple-item" title="Ištrinti"><span class="glyphicon glyphicon-minus-sign"></span></a>
                    @endif
                </div>
                <div class="form-group">
                    {!! Form::label('participation_year', 'Įvykio metai', ['class' => 'col-sm-4 control-label']) !!}
                    <div class="col-sm-7">
                        {!! Form::select('participation_year', $years, $p->participation_year, ['class' => 'form-control input-sm']) !!}
                    </div>
                </div>
            <div class="form-group">
                {!! Form::label('participation_name', 'Įvykio pavadinimas', ['class' => 'col-sm-4 control-label']) !!}
                <div class="col-sm-7">
                    {!! Form::text('participation_name', $p->participation_name, ['class' => 'form-control input-sm', 'placeholder' => 'Įrašyti']) !!}
                </div>
            </div>
                <div class="form-group">
                    {!! Form::label('participation_organizer', 'Įvykio rengėjas', ['class' => 'col-sm-4 control-label']) !!}
                    <div class="col-sm-7">
                        {!! Form::text('participation_organizer', $p->participation_organizer, ['class' => 'form-control input-sm', 'placeholder' => 'Įrašyti įvykio rengėjo vardą/įmonės pavadinimą']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('participation_description', 'Įvykio turinys/ pobūdis', ['class' => 'col-sm-4 control-label']) !!}
                    <div class="col-sm-7">
                    {!! Form::textarea('participation_description', $p->participation_description, ['rows' => '3', 'class' => 'form-control input-sm', 'placeholder' => 'Trumpai aprašyti įvykio turinį ir pobūdį']) !!}
                    </div>
                </div>
                {!! Form::hidden('id', $p->id) !!}
            {!! Form::close() !!}
        </div>
    @endforeach
    <div id="participation-clone-area-container"></div>
    <div class="row">
        <div class="col-sm-offset-4 col-sm-5">
            <button type="button" class="btn btn-link clone-button" style="color: #008534" data-clone-type="block" data-clone-area="participation-clone-area">
                <span class="glyphicon glyphicon-plus-sign"></span> Pridėti dar įrašų
            </button>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-sm-offset-4 col-sm-5">
            <div class="row">
                <div class="col-sm-6">
                    {!! Form::button('Išsaugoti ir toliau', ['class' => 'btn btn-primary btn-sm', 'onclick'=>'ajaxForms(\'participationForms\')']) !!}
                </div>
                <div class="col-sm-6">
                    {!! Form::button('Praleisti ir toliau', ['class' => 'btn btn-secondary btn-sm', 'onclick'=>"skipState($cv->id, $currentState)"]) !!}
                </div>
            </div>
        </div>
    </div>
</div>
