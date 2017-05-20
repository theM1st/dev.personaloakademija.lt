<div class="top-cv-form">
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
        {!! Form::label('scope_id', 'Profesijų sritis', ['class' => 'col-sm-5 control-label required']) !!}
        <div class="col-sm-5">
            {!! Form::select('scope_id', $scopes, old('scope_id'), ['class' => 'form-control input-sm']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('scope_category_id', 'Kategorija', ['class' => 'col-sm-5 control-label required']) !!}
        <div class="col-sm-5">
            {!! Form::select('scope_category_id', (!empty($cv) ? $cv->scope->categories->pluck('name', 'id') : []), old('scope_category_id'), ['class' => 'form-control input-sm', 'placeholder' => 'Iš pradžių pasirinkite sritį']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('cv_status', 'CV statusas', ['class' => 'col-sm-5 control-label']) !!}
        <div class="col-sm-5">
            {!! Form::select('cv_status', App\TopCvProfile::getStatuses(), old('cv_status'), ['class' => 'form-control input-sm']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('cv_name', 'CV Pavadinimas', ['class' => 'control-label', 'style' => 'display:block;margin-bottom:5px;text-align:center' ]) !!}
        <div>
            {!! Form::text('cv_name', old('cv_name'), ['class' => 'form-control input-sm', 'placeholder' => 'Įrašyti']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('about', 'Trumpai apie save', ['class' => 'control-label', 'style' => 'display:block;margin-bottom:5px;text-align:center' ]) !!}
        <div>
            {!! Form::text('about', old('about'), ['class' => 'form-control input-sm', 'placeholder' => 'Įrašyti']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('study', 'Išsilavimas', ['class' => 'control-label', 'style' => 'display:block;margin-bottom:5px;text-align:center' ]) !!}
        @foreach ($cvStudies as $k => $item)
            <div class="form-group" @if ($k == 0) id="study-clone-area" @endif>
                @if (!empty($cv) && $item->id)
                    <a href="{{ route('topCvs.removeStudy', [$cv->id, $item->id]) }}" class="remove-multiple-item">
                        <span class="glyphicon glyphicon-minus-sign"></span>
                    </a>
                @endif
                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::text('study_date[]', $item->study_date, ['class' => 'form-control input-sm', 'placeholder' => 'yyyy/mm - yyyy/mm']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::text('institution[]', $item->institution, ['class' => 'form-control input-sm', 'placeholder' => 'Aukštojo mokslo įstaiga']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::text('specialty[]', $item->specialty, ['class' => 'form-control input-sm', 'placeholder' => 'Įgyta specialybė, mokslinis laipsnis']) !!}
                    </div>
                </div>
            </div>
        @endforeach
        <div id="study-clone-area-container"></div>
        <button type="button" class="btn btn-link btn-sm clone-button" style="color: #008534;margin-left:-10px" data-clone-type="block" data-clone-area="study-clone-area">
            <span class="glyphicon glyphicon-plus-sign"></span> Pridėti dar įrašų
        </button>
    </div>
    <div class="form-group">
        {!! Form::label('work', 'Darbo patirtis', ['class' => 'control-label', 'style' => 'display:block;margin-bottom:5px;text-align:center' ]) !!}
        @foreach ($cvWorks as $k => $item)
            <div class="form-group" @if ($k == 0) id="work-clone-area" @endif>
                @if (!empty($cv) && $item->id)
                    <a href="{{ route('topCvs.removeWork', [$cv->id, $item->id]) }}" class="remove-multiple-item">
                        <span class="glyphicon glyphicon-minus-sign"></span>
                    </a>
                @endif
                <div class="row" style="margin-bottom: 10px;">
                    <div class="col-sm-4">
                        {!! Form::text('work_date[]', $item->work_date, ['class' => 'form-control pull-left input-sm', 'placeholder' => 'yyyy/mm - yyyy/mm', 'style' => 'width:auto']) !!}
                        <span class="clone-ignore">
                            <label class="pull-right" style="margin:4px 0">
                                {{ Form::checkbox('work_now[]', 1, $item->work_now) }} iki dabar
                            </label>
                        </span>
                    </div>
                    <div class="col-sm-4">
                        {!! Form::text('workplace[]', $item->workplace, ['class' => 'form-control input-sm', 'placeholder' => 'Darbovietės pavadinimas']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::text('work_position[]', $item->work_position, ['class' => 'form-control input-sm', 'placeholder' => 'Pareigos']) !!}
                    </div>
                </div>
                <div>
                    {!! Form::text('work_task[]', $item->work_task, ['class' => 'form-control input-sm', 'placeholder' => 'Darbo pobūdis']) !!}
                </div>
            </div>
        @endforeach
        <div id="work-clone-area-container"></div>
        <button type="button" class="btn btn-link btn-sm clone-button" style="color: #008534;margin-left:-10px" data-clone-type="block" data-clone-area="work-clone-area">
            <span class="glyphicon glyphicon-plus-sign"></span> Pridėti dar įrašų
        </button>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-7 languages-form">
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
                <button type="button" class="btn btn-link btn-sm clone-button" style="color: #008534;margin-left:-10px" data-clone-type="block" data-clone-area="language-clone-area">
                    <span class="glyphicon glyphicon-plus-sign"></span> Pridėti dar įrašų
                </button>
            </div>
            <div class="col-sm-5" style="padding-right: 0;">
                {!! Form::label("cv_tag", 'Raktiniai žodžiai', ['class' => 'control-label']) !!}
                {!! Form::textarea('cv_tag', old('cv_tag'), ['class' => 'form-control input-sm', 'placeholder' => 'Įrašyti', 'rows' => 3]) !!}
            </div>
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
        {!! Form::text('salary_trial', old('salary_trial'), ['class' => 'form-control input-sm', 'style' => 'width:120px;display:inline;']) !!}
        <span style="padding: 0 10px">€ per bandomąjį</span>
        {!! Form::text('salary', old('salary'), ['class' => 'form-control input-sm', 'style' => 'width:120px;display:inline;']) !!}
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
</div>
