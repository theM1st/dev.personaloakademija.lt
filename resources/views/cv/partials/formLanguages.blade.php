<div class="languages-form">
@include('errors.list')
{!! Form::open(['class' => 'form-horizontal']) !!}
    @foreach ($data as $k => $l)
        @if ($k == 0)
            <div class="form-group">
                {!! Form::label('first_language_id', 'Gimtoji kalba', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-3">
                    {!! Form::select('first_language_id', $languages, $l->first_language_id, ['class' => 'form-control input-sm', 'data-language-value' => "first-language-value"]) !!}
                </div>
                <div class="col-sm-3 first-language-value" style="display: none">
                    {!! Form::text('first_language_value', $l->first_language_value, ['class' => 'form-control input-sm', 'placeholder' => 'Įrašyti']) !!}
                </div>
            </div>
            <br>
        @endif
        <div @if ($k == 0) id="language-clone-area"@else style="margin-top:20px;"@endif class="foreign-language">
            <div class="form-group">
                @if ($l->id)
                    <a href="{{Request::url()}}?removeLang={{$l->id}}" class="remove-multiple-item">
                        <span class="glyphicon glyphicon-minus-sign"></span>
                    </a>
                @endif
                {!! Form::label("foreign_language_id[$k]", 'Užsienio kalba', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-3">
                            {!! Form::select("foreign_language_id[$k]", $languages, $l->foreign_language_id, ['class' => 'form-control input-sm', 'data-language-value' => "foreign-language-value-$k"]) !!}
                        </div>
                        <div class="col-sm-2" style="margin-top:-15px">
                            Supratimas
                            {!! Form::select("understanding_level[]", $languageLevels, $l->understanding_level, ['class' => 'form-control input-xs']) !!}
                        </div>
                        <div class="col-sm-2" style="margin-top:-15px">
                            Kalbėjimas
                            {!! Form::select("speaking_level[]", $languageLevels, $l->speaking_level, ['class' => 'form-control input-xs']) !!}
                        </div>
                        <div class="col-sm-2" style="margin-top:-15px">
                            Skaitymas
                            {!! Form::select("reading_level[]", $languageLevels, $l->reading_level, ['class' => 'form-control input-xs']) !!}
                        </div>
                        <div class="col-sm-2" style="margin-top:-15px">
                            Rašymas
                            {!! Form::select("writing_level[]", $languageLevels, $l->writing_level, ['class' => 'form-control input-xs']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group" style="display: none">
                <div class="col-sm-offset-3 col-sm-3">
                    {!! Form::text("foreign_language_value[$k]", $l->foreign_language_value, ['class' => 'form-control input-sm', 'placeholder' => 'Įrašyti']) !!}
                </div>
            </div>
        </div>
        @if ($l->id)
            <input type="hidden" name="id[]" value="{{ $l->id }}">
        @endif
    @endforeach
    <div id="language-clone-area-container"></div>
    <div class="row">
        <div class="col-sm-offset-3 col-sm-5">
            <button type="button" class="btn btn-link clone-button" style="color: #008534" data-clone-type="block" data-clone-area="language-clone-area">
                <span class="glyphicon glyphicon-plus-sign"></span> Pridėti dar kalbų
            </button>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-offset-3 col-sm-5">
            <div class="row">
                <div class="col-sm-6">
                    {!! Form::submit('Išsaugoti ir toliau', ['class' => 'btn btn-primary btn-sm']) !!}
                </div>
                <div class="col-sm-6">
                    {!! Form::button('Praleisti ir toliau', ['class' => 'btn btn-secondary btn-sm', 'onclick'=>"skipState($cv->id, $currentState)"]) !!}
                </div>
            </div>
        </div>
    </div>

{!! Form::close() !!}
</div>