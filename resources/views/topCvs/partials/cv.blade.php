<h1 class="text-center" style="text-align: center">
    {{ $cv->cv_name }}<br>
    <span>CV Nr. {{ $cv->cv_number }}</span>
</h1>
<div class="top-block">
    <div class="logo">
        <img src="{{asset('assets/img/large-logo.png')}}" alt="" class="img-responsive">
    </div>
    <div class="user-info">
        <table>
            <tr>
                <td class="col1">
                    @if (empty($withContacts))
                        <div>{{ $cv->genderName }}</div>
                    @else
                        <div>{{ $cv->name }}</div>
                    @endif
                    <div>{{ $cv->age }} m.</div>
                    <div>{{ $cv->city ? $cv->city->name : '' }}</div>
                    @if (!empty($withContacts))
                        <div>{{ $cv->telephone }}</div>
                        <div>{{ $cv->email }}</div>
                    @endif
                </td>
                <td class="col2">
                    <div>Sritis: {{ $cv->scope ? $cv->scope->name : '' }}</div>
                    <div>
                        Kategorija:
                        {{ $cv->categories->count() ? $cv->categories->pluck('name')->implode(', ') : '' }}
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>

<div class="middle-block row">
    @if ($cv->about)
        <div class="{{ $withContacts && empty($pdf) ? ' col-sm-7' : ' col-sm-12' }}">
            <div>
                <strong>Trumpai apie save</strong>
            </div>
            <div>{{ $cv->about }}</div>
        </div>
    @endif
    @if ($withContacts && empty($pdf))
        <div class="col-sm-5 comments">
            @if ($comment = $cv->comments->first())
            @endif
            {{ Form::open(['route' => ['topCv.comments.store', $cv->id]]) }}
                <div class="form-group">
                    {!! Form::label('comment', '', ['class' => 'sr-only']) !!}
                    {!!
                        Form::textarea('comment',
                            ($comment ?
                                $comment->comment:
                                null),
                            ['rows' => 2,
                            'placeholder' => 'Komentaras',
                            'class' => 'form-control input-sm'])
                    !!}
                </div>

                <div class="text-right">
                    @if ($comment)
                        <div style="display: inline-block;margin-right: 10px;">
                            <strong>{{ $comment->user->firstname }}</strong>
                            įrašė
                            {{ $comment->created_at->format('Y-m-d') }}
                        </div>
                    @endif
                    {!! Form::submit('Išsaugoti komentarą', ['class' => 'btn btn-sm btn-secondary']) !!}
                </div>
            {{ Form::close() }}
        </div>
    @endif
</div>

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
                            <td class="col21">
                                {{ $s->study_date }}
                                @if ($s->study_now)
                                    - studijos tęsiamos
                                @endif
                            </td>
                            <td>
                                <strong>{{ $s->institution }}</strong>{{ ($s->specialty ? ", $s->specialty" : '') }}
                            </td>
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
                            <td class="col21">
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
                                <strong>
                                    @if (!$w->workplace_hide || $withContacts)
                                        {{ $w->workplace }}
                                    @else
                                        ... (įmonė)
                                    @endif
                                </strong>
                                <div>
                                    @if (!$w->work_position_hide || $withContacts)
                                        <strong>{{ $w->work_position }}</strong>
                                    @else
                                        &nbsp;
                                    @endif
                                </div>
                                <div>{{ $w->work_task }}</div>
                            </td>
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
                <table class="table" style="width: auto">
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
    <table class="table cv-skills">
        @if ($cv->cv_skills)
            <tr>
                <td class="col1" width="150">
                    Profesiniai įgūdžiai
                </td>
                <td class="col2">
                    {!! nl2br(e($cv->cv_skills)) !!}
                </td>
            </tr>
        @endif
        @if ($cv->cv_trainings)
            <tr>
                <td class="col1" width="150">
                    Mokymai
                </td>
                <td class="col2">
                    {!! nl2br(e($cv->cv_trainings)) !!}
                </td>
            </tr>
        @endif
        @if ($cv->cv_certificates)
            <tr>
                <td class="col1" width="150">
                    Sertifikatai
                </td>
                <td class="col2 last">
                    {!! nl2br(e($cv->cv_certificates)) !!}
                </td>
            </tr>
        @endif
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
                        <td>{!! nl2br(e($cv->cv_info)) !!}</td>
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