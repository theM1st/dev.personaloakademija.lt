@include('errors.list')

<div class="form-group">
    {!! Form::label('name', 'Vardas, pavardė', ['class' => 'col-sm-5 control-label required']) !!}
    <div class="col-sm-5">
        {!! Form::text('name', old('name'), ['class' => 'form-control input-sm', 'placeholder' => '']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('gender', 'Lytis', ['class' => 'col-sm-5 control-label required']) !!}
    <div class="col-sm-5">
        {!! Form::select('gender', $genders, old('gender'), ['class' => 'form-control input-sm']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('age', 'Amžius (m.)', ['class' => 'col-sm-5 control-label required']) !!}
    <div class="col-sm-5">
        {!! Form::text('age', old('age'), ['class' => 'form-control input-sm', 'placeholder' => '']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('city_id', 'Miestas', ['class' => 'col-sm-5 control-label required']) !!}
    <div class="col-sm-5">
        {!! Form::select('city_id', $cities, old('city_id'), ['class' => 'form-control input-sm cities']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('telephone', 'Telefono nr.', ['class' => 'col-sm-5 control-label required']) !!}
    <div class="col-sm-5">
        {!! Form::text('telephone', old('telephone'), ['class' => 'form-control input-sm', 'placeholder' => '']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('email', 'El. paštas', ['class' => 'col-sm-5 control-label required']) !!}
    <div class="col-sm-5">
        {!! Form::text('email', old('email'), ['class' => 'form-control input-sm', 'placeholder' => '']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('scope_id', 'Sritis', ['class' => 'col-sm-5 control-label required']) !!}
    <div class="col-sm-5">
        {!! Form::select('scope_id', $scopes, old('scope_id'), ['class' => 'form-control input-sm']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('scope_category_id', 'Kategorija', ['class' => 'col-sm-5 control-label required']) !!}
    <div class="col-sm-5">
        {!! Form::select('scope_category_id', [], old('scope_category_id'), ['class' => 'form-control input-sm', 'placeholder' => 'Iš pradžių pasirinkite sritį']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('cv_status', 'CV statusas', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-5">
        {!! Form::select('cv_status', App\TopCvProfile::getStatuses(), old('cv_status'), ['class' => 'form-control input-sm']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('about', 'Trumpai apie save', ['class' => 'control-label', 'style' => 'display:block;margin-bottom:5px;text-align:center' ]) !!}
    <div>
        {!! Form::text('about', old('about'), ['class' => 'form-control input-sm', 'placeholder' => 'Įrašyti']) !!}
    </div>
</div>

<div class="form-group languages-form">
    <div class="col-sm-7">
        @foreach ($cvLanguages as $k => $item)
            @if ($k == 0)
                <div class="form-group">
                    {!! Form::label('first_language_id', 'Gimtoji kalba', ['class' => 'control-label']) !!}
                    <div>
                        {!!
                            Form::select('first_language_id',
                                $languages,
                                old('first_language_id', ($item->first_language_id ? $item->first_language_id : 1)),
                                ['class' => 'form-control input-sm', 'data-language-value' => "first-language-value"]
                            )
                        !!}
                    </div>
                </div>
            @endif
            @if ($k == 0 || $item->foreign_language_id)
                <div @if ($k == 0) id="language-clone-area" @endif class="foreign-language">
                    <div class="form-group">
                        @if (!empty($cv) && $item->foreign_language_id)
                            <a href="{{ route('topCvs.removeLanguage', [$cv->id, $item->id]) }}" class="remove-multiple-item">
                                <span class="glyphicon glyphicon-minus-sign"></span>
                            </a>
                        @endif
                        <div>
                            <div class="row">
                                <div class="col-sm-4">
                                    {!! Form::label("foreign_language_id[]", 'Užsienio kalba', ['class' => 'control-label']) !!}
                                    {!! Form::select("foreign_language_id[]", $languages, $item->foreign_language_id, ['class' => 'form-control input-sm']) !!}
                                </div>
                                <div class="col-sm-4">
                                    <label class="control-label">Kalbėti</label>
                                    {!!
                                        Form::select("speaking_level[]",
                                            $languageLevels,
                                            ($item->speaking_level ? $item->speaking_level : 'average'),
                                            ['class' => 'form-control input-xs']
                                        )
                                    !!}
                                </div>
                                <div class="col-sm-4">
                                    <label class="control-label">Rašyti</label>
                                    {!!
                                        Form::select("writing_level[]",
                                        $languageLevels,
                                        ($item->writing_level ? $item->writing_level : 'average'),
                                        ['class' => 'form-control input-xs'])
                                    !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

        <div id="language-clone-area-container"></div>
        <button type="button" class="btn btn-link btn-sm clone-button" style="color: #008534;margin-left:-20px" data-clone-type="block" data-clone-area="language-clone-area">
            <span class="glyphicon glyphicon-plus-sign"></span> Pridėti dar įrašų
        </button>
    </div>
    <div class="col-sm-5" style="padding-right: 0;">
        {!! Form::label("cv_tags", 'Raktiniai žodžiai', ['class' => 'control-label']) !!}
        {!! Form::textarea('cv_tags', old('cv_tags'), ['class' => 'form-control input-sm', 'placeholder' => 'Įrašyti', 'rows' => 3]) !!}
    </div>
</div>


<div class="form-group">
    {!! Form::label('cv_skills', 'Profesiniai įgūdžiai', ['class' => 'control-label', 'style' => 'margin-bottom:5px;']) !!}
    <div>
        {!! Form::text('cv_skills', old('cv_skills'), ['class' => 'form-control input-sm', 'placeholder' => 'IT įgūdžiai, kompiuterinis raštingumas, programiniai paketai']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('cv_trainings', 'Mokymai', ['class' => 'control-label', 'style' => 'margin-bottom:5px;']) !!}
    <div>
        {!! Form::text('cv_trainings', old('cv_trainings'), ['class' => 'form-control input-sm', 'placeholder' => 'Seminarai, mokymai, tobulėjimo kursai']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('cv_certificates', 'Sertifikatai', ['class' => 'control-label', 'style' => 'margin-bottom:5px;']) !!}
    <div>
        {!! Form::text('cv_certificates', old('cv_certificates'), ['class' => 'form-control input-sm', 'placeholder' => 'Sertifikatai']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('cv_info', 'Papildoma informacija', ['class' => 'control-label', 'style' => 'margin-bottom:5px;']) !!}
    <div>
        {!! Form::text('cv_info', old('cv_info'), ['class' => 'form-control input-sm', 'placeholder' => 'Laisvalaikis, pomėgiai, visuomeninė veikla, asmeninės savybės']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('driving_license', 'Vairuotojo teisės', ['class' => 'control-label', 'style' => 'margin-bottom:5px;display:inline-block;padding-right:15px']) !!}
    {!! Form::text('driving_license', old('driving_license', (isset($cv) ? $cv->driving_license : 'B')), ['class' => 'form-control input-sm text-center', 'style' => 'width:50px;display:inline;']) !!}
    {!! Form::text('driving_license_year', old('driving_license_year'), ['class' => 'form-control input-sm text-center', 'placeholder' => 'metai', 'style' => 'width:80px;display:inline;']) !!}
</div>
<div class="form-group">
    {!! Form::label('salary_trial', 'Atlyginimo lūkesčiai', ['class' => 'control-label', 'style' => 'margin-bottom:5px;display:inline-block;padding-right:15px']) !!}
    {!! Form::text('salary_trial', old('salary_trial'), ['class' => 'form-control input-sm', 'style' => 'width:auto;display:inline;']) !!}
    <span style="padding: 0 10px">€ bandomuoju</span>
    {!! Form::text('salary', old('salary'), ['class' => 'form-control input-sm', 'style' => 'width:auto;display:inline;']) !!}
    <span style="padding: 0 10px">€ po bandomojo</span>
</div>
<hr>
<div class="text-center">
    @if (isset($cv) && $cv->active)
        {!! Form::submit('Išsaugoti pakeitimus', ['class' => 'btn btn-primary']) !!}
    @else
        {!! Form::submit('Išsaugoti ir peržiūrėti', ['class' => 'btn btn-primary', 'onclick'=>"$('#form-action').val('save')", 'style' => 'margin-right: 20px']) !!}
        {!! Form::submit('Išsaugoti ir įkelti į sistemą', ['class' => 'btn btn-secondary', 'onclick'=>"$('#form-action').val('activate')"]) !!}
    @endif
</div>
{{ Form::hidden('action', 'save', ['id'=>'form-action']) }}
