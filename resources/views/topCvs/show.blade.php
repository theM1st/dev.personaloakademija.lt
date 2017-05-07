@extends('app')

@section('title', $cv->cv_name)

@section('content')
    <div class="top-cv-profile">
        @if (request()->has('updated'))
            <div class="alert alert-success text-center" role="alert">
                CV sėkmingai atnaujintas
            </div>
        @endif
        <h1>{{ $cv->cv_name }}</h1>
        <div class="row top-block">
            <div class="col-xs-2">
                <img src="{{asset('assets/img/large-logo.png')}}" alt="" class="img-responsive">
            </div>
            <div class="col-xs-7 middle text-center">
                <div class="side">
                    <div>{{ $cv->genderName }}</div>
                    <div>{{ $cv->age }} m.</div>
                    <div>{{ $cv->city ? $cv->city->name : '' }}</div>
                </div>
                <div class="side">
                    <div>Sritis: {{ $cv->scope ? $cv->scope->name : '' }}</div>
                    <div>Kategorija: {{ $cv->category ? $cv->category->name : '' }}</div>
                </div>
            </div>
            <div class="col-xs-3 right">
                <div class="text-right">
                    CV Nr. <span class="label">{{ $cv->id }}</span>
                </div>
                @if ($cv->cv_tags)
                    <div class="cv-tags">
                        <div class="t">Paieškos žodžiai</div>
                        <span class="label">{{ $cv->cv_tags }}</span>
                    </div>
                @endif
            </div>
        </div>
        @if ($cv->about)
            <div class="middle-block">
                <h2>Trumpai apie save</h2>
                <div>{{ $cv->about }}</div>
            </div>
        @endif

        @if ($cv->studies->count())
            <table class="table">
                <tr>
                    <td class="col1">
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
            <table class="table">
                <tr>
                    <td class="col1">
                        Darbo patirtis
                    </td>
                    <td class="col2">
                        <table class="table">
                            @foreach ($cv->works as $w)
                                <tr class="separator">
                                    <td>{{ $w->work_date }}</td>
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
                    <td class="col1">
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

        <table class="table">
            <tr>
                <td class="col1">
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

        <table class="table">
            <tr>
                <td class="col1">
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
        <div class="clearfix tools">
            <a href="" class="btn btn-link btn-bookmark-cv">
                <i class="fa fa-star-o" aria-hidden="true"></i>
                Įtraukti kandidatą į tinkamų sąrašą
            </a>
            <button class="btn btn-secondary">Užsakyti tinkamus CV</button>
            <a href="{{ route('topCv.index') }}" class="btn btn-default pull-right">Grįžti į CV sąrašą</a>
        </div>
        @if (auth()->check() && auth()->user()->isAdminWorker())
            <div class="text-center">
                <hr>
                <a href="{{ route('topCvs.edit', $cv->id) }}" class="btn btn-primary">Redaguoti</a>
            </div>
        @endif
    </div>

@endsection