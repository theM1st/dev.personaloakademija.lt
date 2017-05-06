<div id="recomendationForms">
    @include('errors.list')
    @foreach ($data as $k => $r)
        <div class="form @if($k == 0)first @endif" @if ($k == 0) id="recomendation-clone-area"@endif>
            {!! Form::open(['class' => 'form-horizontal']) !!}
                <div class="form-group">
                    {!! Form::label('recomendation_type_id', 'Kas įteikta/ gauta', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-4">
                        {!! Form::select('recomendation_type_id', $types, $r->recomendation_type_id, ['class' => 'form-control input-sm']) !!}
                    </div>
                    @if ($r->id)
                        <a href="{{Request::url()}}?removeRecomendation={{$r->id}}" class="remove-multiple-item" title="Ištrinti"><span class="glyphicon glyphicon-minus-sign"></span></a>
                    @endif
                </div>
                <div class="form-group">
                    {!! Form::label('recomendation_year', 'Kada įteikta/ gauta', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-4">
                        {!! Form::select('recomendation_year', $years, $r->recomendation_year, ['class' => 'form-control input-sm']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('recomendation_name', 'Kas įteikė', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-8">
                        {!! Form::text('recomendation_name', $r->recomendation_name, ['class' => 'form-control input-sm', 'placeholder' => 'Dokumentą įteikusi organizacija/asmuo']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('recomendation_description', 'Dokumento turinys', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-8">
                    {!! Form::text('recomendation_description', $r->recomendation_description, ['class' => 'form-control input-sm', 'placeholder' => 'Trumpas dokumento turinio aprašymas']) !!}
                    </div>
                </div>
                {!! Form::hidden('id', $r->id) !!}
            {!! Form::close() !!}
        </div>
    @endforeach
    <div id="recomendation-clone-area-container"></div>
    <div class="row">
        <div class="col-sm-offset-3 col-sm-5">
            <button type="button" class="btn btn-link clone-button" style="color: #008534" data-clone-type="block" data-clone-area="recomendation-clone-area">
                <span class="glyphicon glyphicon-plus-sign"></span> Pridėti dar įrašų
            </button>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-offset-3 col-sm-5">
            <div class="row">
                <div class="col-sm-6">
                    {!! Form::button('Išsaugoti ir toliau', ['class' => 'btn btn-primary btn-sm', 'onclick'=>'ajaxForms(\'recomendationForms\')']) !!}
                </div>
                <div class="col-sm-6">
                    {!! Form::button('Praleisti ir toliau', ['class' => 'btn btn-secondary btn-sm', 'onclick'=>"skipState($cv->id, $currentState)"]) !!}
                </div>
            </div>
        </div>
    </div>
</div>
