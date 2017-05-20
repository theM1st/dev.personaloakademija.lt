<h1 class="text-center" style="text-align: center">{{ $cv->cv_name }}</h1>
<div class="top-block">
    <table class="table" width="100%">
        <tr>
            <td class="col1" width="150">
                <img src="{{asset('assets/img/large-logo.png')}}" alt="" class="img-responsive">
            </td>
            <td class="col2 text-center" align="center">
                <table class="table" width="100%">
                    <tr>
                        <td class="sub-col1" align="center" width="50%">
                            <div>{{ $cv->genderName }}</div>
                            <div>{{ $cv->age }} m.</div>
                            <div>{{ $cv->city ? $cv->city->name : '' }}</div>
                        </td>
                        <td class="sub-col2" width="50%">
                            <div>Sritis: {{ $cv->scope ? $cv->scope->name : '' }}</div>
                            <div>Kategorija: {{ $cv->category ? $cv->category->name : '' }}</div>
                        </td>
                    </tr>
                </table>
            </td>
            <td class="col3">
                <div class="text-right" style="text-align: right">
                    CV Nr. <span class="cv-id">{{ $cv->id }}</span>
                </div>
                @if ($cv->cv_tag)
                    <div class="cv-tags">
                        <div class="t">Paieškos žodžiai</div>
                        <span>{{ $cv->cv_tag }}</span>
                    </div>
                @endif
            </td>
        </tr>
    </table>
</div>
@if ($cv->about)
    <div class="middle-block">
        <p style="text-align: center">
            <strong>Trumpai apie save</strong>
        </p>
        <div>{{ $cv->about }}</div>
    </div>
@endif
@if ($cv->studies->count())
    <table class="table">
        <tr>
            <td class="col1" width="150">
                Išsilavinimas
            </td>
            <td class="col2">
                <table class="table">
                    @foreach ($cv->studies as $s)
                        <tr class="separator">
                            <td>{{ $s->study_date }}</td>
                            <td><strong>{{ $s->institution }}</strong></td>
                            <td>{{ $s->specialty }}</td>
                        </tr>
                    @endforeach
                </table>
            </td>
        <tr>
    </table>
@endif

@if ($cv->works->count())
    <table class="table" style="width:auto">
        <tr>
            <td class="col1" width="150">
                Darbo patirtis
            </td>
            <td class="col2">
                <table class="table">
                    @foreach ($cv->works as $w)
                        <tr class="separator">
                            <td style="padding-right: 15px">
                                <div>
                                    {{ $w->work_date }}
                                    @if ($w->work_now)
                                        - iki dabar
                                    @endif
                                </div>
                                @if ($diffDate = $cv->getDiffDate($w->work_date, $w->work_now))
                                    <div class="label">
                                        {{ $diffDate }}
                                    </div>
                                @endif
                            </td>
                            <td>
                                <strong>Kompanija neskelbiama</strong>{{ $w->work_position ? ', ' . $w->work_position : '' }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">{{ $w->work_task }}</td>
                        </tr>
                    @endforeach
                </table>
            </td>
        <tr>
    </table>
@endif

@if ($cv->languages)
    <table class="table">
        <tr>
            <td class="col1" width="150">
                Kalbų mokėjimas
            </td>
            <td class="col2">
                <table>
                    @foreach ($cv->languages as $l)
                        @if ($l->first_language_id)
                            <tr class="first-language">
                                <td><strong>{{ $l->firstLanguage->name }}</strong></td>
                                <td colspan="2">Gimtoji kalba</td>
                            </tr>
                        @endif
                    @endforeach

                    @foreach ($cv->languages as $k => $l)
                        @if ($k == 0 && $l->foreign_language_id)
                            <tr class="foreign-language-title">
                                <td></td>
                                <td><strong>Kalbėti</strong></td>
                                <td><strong>Rašyti</strong></td>
                            </tr>
                        @endif
                        @if ($l->foreign_language_id)
                            <tr>
                                <td><strong>{{ $l->foreignLanguage->name }}</strong></td>
                                <td>{{ $l->speaking }}</td>
                                <td>{{ $l->writing }}</td>
                            </tr>
                        @endif
                    @endforeach
                </table>
            </td>
        </tr>
    </table>
@endif

@if ($cv->cv_skills || $cv->cv_trainings || $cv->cv_certificates)
    <table class="table">
        <tr>
            <td class="col1" width="150">
                Profesiniai įgūdžiai<br>
                Mokymai<br>
                Sertifikatai<br>
            </td>
            <td class="col2">
                <table class="table">
                    @if ($cv->cv_skills)
                        <tr class="separator">
                            <td>{{ $cv->cv_skills }}</td>
                        </tr>
                    @endif
                    @if ($cv->cv_trainings)
                        <tr class="separator">
                            <td>{{ $cv->cv_trainings }}</td>
                        </tr>
                    @endif
                    @if ($cv->cv_certificates)
                        <tr class="separator">
                            <td>{{ $cv->cv_certificates }}</td>
                        </tr>
                    @endif
                </table>
            </td>
        </tr>
    </table>
@endif
<table class="table">
    <tr>
        <td class="col1" width="150">
            Papildoma<br>
            informacija<br>
        </td>
        <td class="col2">
            <table class="table">
                @if ($cv->cv_info)
                    <tr class="separator">
                        <td>{{ $cv->cv_info }}</td>
                    </tr>
                @endif
                @if ($cv->driving_license)
                    <tr class="separator">
                        <td>
                            {{ $cv->driving_license }} kategorija
                            {{ ($cv->driving_license_year ? $cv->driving_license_year.' m.' : '') }}
                        </td>
                    </tr>
                @endif
                @if ($cv->salary_trial || $cv->salary)
                    <tr class="separator salary">
                        <td>
                            Atlyginimo lūkesčiai:
                            @if ($cv->salary_trial)
                                <span>
                                            {{ $cv->salary_trial }}
                                    eur per bandomąjį
                                        </span>
                            @endif
                            @if ($cv->salary)
                                <span>
                                            {{ $cv->salary }}
                                    eur po bandomojo
                                        </span>
                            @endif
                        </td>
                    </tr>
                @endif
            </table>
        </td>
    </tr>
</table>