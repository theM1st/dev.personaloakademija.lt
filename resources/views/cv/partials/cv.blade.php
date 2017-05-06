<div class="cv-info">
    @if (isset($type) && $type == 'preview')
        <div class="cv-logo">
            <img src="{{ asset('assets/img/large-logo.png') }}" alt="">
        </div>
    @endif
    @if ($cv->cv_name)
        <h1>{{$cv->cv_name}}</h1>
    @endif
    <div class="row">
        <div class="col-xs-2">
            <div class="cv-photo"><img src="{{$cv->photos()->getPhoto()}}" alt=""></div>
        </div>
        <div class="col-xs-4">
            <div class="cv-user">{{$cv->name}}</div>
            <div class="cv-gender">{{$cv->genderName}}, {{$cv->age}} m.</div>
            <div class="cv-city">{{$cv->city}}</div>
            <div class="cv-telephone">{{$cv->telephone}}</div>
            <div class="cv-email">{{$cv->email}}</div>
        </div>
        @if (Auth::user()->isAdminWorker())
            <div class="col-xs-6">
                {!! Form::open(['action' => 'CvCommentsController@store']) !!}
                    {!! Form::hidden('cv_id', $cv->id) !!}
                    <div class="row">
                        <div class="col-sm-8">
                            <label>Efektyvumas:</label>
                            <input id="cvRating" type="number" name="rating" class="rating" value="{{$cv->comments->first()->rating or null}}" style="display: none">
                        </div>
                        @if ($cv->comments->first())
                            <div class="col-sm-4 text-right" style="line-height:28px">{{$cv->comments->first()->created_at->format('Y-m-d')}}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        {!! Form::label('comment', 'Konsultanto komentaras:', ['class' => '']) !!}
                        {!! Form::textarea('comment', null, ['rows' => '2', 'class' => 'form-control input-sm']) !!}
                    </div>

                    <div class="text-right">
                         {!! Form::submit('Išsaugoti ir grįžti į CV sąrašą', ['class' => 'btn btn-sm btn-secondary']) !!}
                    </div>
                {!! Form::close() !!}
                @if ($cv->comments)

                    @foreach ($cv->comments()->has('user')->where('comment', '!=', '')->limit(2)->get() as $c)
                        <p>
                            {{$c->user->firstname}} {{$c->created_at->format('Y-m-d')}}<br>
                            {{str_limit($c->comment, 200)}}
                        </p>
                    @endforeach
                    @if ($cv->comments()->where('comment', '!=', '')->count() > 2)
                        <div class="text-right"><a href="{{action('CvCommentsController@index', ['cv' => $cv->id])}}" class="action-modal" data-method="get" data-size="md">Daugiau</a> </div>
                    @endif
                @endif
            </div>
        @endif
    </div>
    @if ($cv->description)
         <h4>Trumpas prisistatymas</h4>
         <div class="cv-description">{!! nl2br(e($cv->description)) !!}</div>
    @endif
    @if ($studies->count())
        <h4>{{ $states[3]['name'] }}</h4>
        @foreach ($studies as $s)
            <div class="study-item">
                <div class="row">
                    <div class="col-xs-5">
                        <div class="cv-label">{{$s->study_from_year}} - {{$s->study_to_year}}</div>
                    </div>
                    <div class="col-xs-7">
                        <div class="cv-institution-name cv-row">
                            @if ($s->institution_name)
                                {{ $s->institution_name }}
                            @endif
                        </div>
                    </div>
                </div>
                @if ($s->study_scope)
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="cv-label">Studijų/ mokymosi sritis</div>
                        </div>
                        <div class="col-xs-7">
                            <div class="cv-study-specialty cv-row">{{$s->study_scope}}</div>
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-xs-5">
                        <div class="cv-label">Specialybės pavadinimas</div>
                    </div>
                    <div class="col-xs-7">
                        <div class="cv-study-specialty cv-row">{{$s->specialty}}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-5">
                        <div class="cv-label">Įgytas laipsnis</div>
                    </div>
                    <div class="col-xs-7">
                        <div class="cv-study-specialty cv-row">
                            {{$s->grade->name}}
                            @if ($s->courseName)<span class="cv-study-course">, {{$s->courseName}}</span>@endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    @if ($works->count())
        <h4>{{ $states[4]['name'] }}</h4>
        @foreach ($works as $w)
            <div class="row">
                <div class="col-sm-offset-3 col-xs-7">
                    <div class="cv-row">{!! nl2br(e($w->interested_work_description)) !!}</div>
                </div>
            </div>
            @if ($w->citiesName)
                <div class="row">
                    <div class="col-xs-5">
                        <div class="cv-label">Miestas, kuriame norima dirbti</div>
                    </div>
                    <div class="col-xs-7">
                        <div class="cv-row">{{ $w->citiesName->implode(', ') }}</div>
                    </div>
                </div>
            @endif
            @if ($w->workScopesName)
                <div class="row">
                    <div class="col-xs-5">
                        <div class="cv-label">Dominančios darbo sritys</div>
                    </div>
                    <div class="col-xs-7">
                        <div class="cv-row">{!! $w->workScopesName->implode('<br>') !!}</div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-xs-5">
                    <div class="cv-label">Dominančios pareigos</div>
                </div>
                <div class="col-xs-7">
                    <div class="cv-row">{{$w->interested_work_position}}</div>
                </div>
            </div>
        @endforeach
    @endif

    @if ($experiences->count())
        @foreach ($experiences as $exp)
            <div class="work-experience-item" style="margin-top: 15px">
                <div class="row">
                    <div class="col-xs-5">
                        <div class="cv-label">
                            nuo {{$exp->workFromYear}}-{{$exp->workFromMonth}} - {{$exp->workToName}}
                        </div>
                    </div>
                    <div class="col-xs-7">
                        <div class="cv-company-name cv-row">
                            {{$exp->company_name}}
                        </div>
                    </div>
                </div>
                @if ($exp->work_position)
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="cv-label">Pareigos</div>
                        </div>
                        <div class="col-xs-7">
                            <div>{{$exp->work_position}}</div>
                        </div>
                    </div>
                @endif
                @if ($exp->main_tasks)
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="cv-label">Darbo pobūdis</div>
                        </div>
                        <div class="col-xs-7">
                            <div>{!! nl2br(e($exp->main_tasks)) !!}</div>
                        </div>
                    </div>
                @endif
            </div>
        @endforeach
    @endif

    @if ($languages->count())
        <h4>{{ $states[5]['name'] }}</h4>
        @if ($languages[0]->firstLanguageName)
            <div class="row">
                <div class="col-xs-5">
                    <div class="cv-label">Gimtoji kalba</div>
                </div>
                <div class="col-xs-7">
                    <div class="cv-row">
                        @if ($languages[0]->first_language_value)
                            {{ $languages[0]->first_language_value }}
                        @else
                            {{$languages[0]->firstLanguageName}}
                        @endif
                    </div>
                </div>
            </div>
        @endif
        @if ($languages[0]->foreignLanguageName || $languages[0]->foreign_language_value)
            <div class="row">
                <div class="col-xs-5">
                    <div class="cv-label">Užsienio kalba</div>
                </div>
                <div class="col-xs-7">
                @foreach ($languages as $l)
                    <div class="cv-row pull-left" style="width: 33%">
                        <div class="cv-foreign-language-name">
                            @if ($l->foreign_language_value)
                                {{$l->foreign_language_value}}
                            @else
                                {{$l->foreignLanguageName}}
                            @endif
                        </div>
                        @if (!empty($l->understanding_level))
                            <div class="cv-language-level row">
                                <div class="col-xs-7">Supratimas:</div>
                                <div class="pull-left">{{$l->understanding_level}}</div>
                            </div>
                        @endif
                        @if (!empty($l->speaking_level))
                            <div class="cv-language-level row">
                                <div class="col-xs-7">Kalbėjimas:</div>
                                <div class="pull-left">{{$l->speaking_level}}</div>
                            </div>
                        @endif
                        @if (!empty($l->reading_level))
                            <div class="cv-language-level row">
                                <div class="col-xs-7">Skaitymas:</div>
                                <div class="pull-left">{{$l->reading_level}}</div>
                            </div>
                        @endif
                        @if (!empty($l->writing_level))
                            <div class="cv-language-level row">
                                <div class="col-xs-7">Rašymas:</div>
                                <div class="pull-left">{{$l->writing_level}}</div>
                            </div>
                        @endif
                    </div>
                @endforeach
                </div>
            </div>
        @endif
    @endif

    @if (count($itknowledges))
        <h4>{{ $states[6]['name'] }}</h4>
        @foreach ($itknowledges as $item)
            <div class="row">
                <div class="col-xs-5">
                    <div class="cv-label">{{$item['category']->name}}</div>
                </div>
                <div class="col-xs-7">
                    @foreach ($item['knowledges'] as $knowledge)
                        @if (isset($knowledge->knowledge->name))
                            <div class="cv-knowledge-name">
                                {{$knowledge->knowledge->name}}
                                @if (!empty($knowledge->levelName))
                                    <span class="cv-knowledge-level">({{$knowledge->levelName}})</span>
                                @endif
                            </div>
                        @elseif ($knowledge->knowledge_name)
                            <div class="cv-knowledge-extra">
                                Kita: {{$knowledge->knowledge_name}}
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach
    @endif

    @if ($characteristics->count() || $interests->count() || $socactivities->count())
        <h4>{{ $states[7]['name'] }}</h4>

        @foreach ($characteristics as $c)
            @if (!empty($c->characteristic_name))
                <div class="row">
                    <div class="col-xs-5">
                        <div class="cv-label">Asmeninės savybės</div>
                    </div>
                    <div class="col-xs-7">
                        <div class="cv-row">{!! nl2br(e($c->characteristic_name)) !!}</div>
                    </div>
                </div>
            @endif
        @endforeach

        @foreach ($interests as $c)
            @if (!empty($c->interest_name))
                <div class="row">
                    <div class="col-xs-5">
                        <div class="cv-label">Laisvalaikis ir pomėgiai</div>
                    </div>
                    <div class="col-xs-7">
                        <div class="cv-company-name cv-row">{!! nl2br(e($c->interest_name)) !!}</div>
                    </div>
                </div>
            @endif
        @endforeach

        @foreach ($socactivities as $c)
            @if (!empty($c->socactivity_name))
                <div class="row">
                    <div class="col-xs-5">
                        <div class="cv-label">Visuomeninė veikla</div>
                    </div>
                    <div class="col-xs-7">
                        <div class="cv-company-name cv-row">{!! nl2br(e($c->socactivity_name)) !!}</div>
                    </div>
                </div>
            @endif
        @endforeach
    @endif

    @if ($participations->count())
        <h4>{{ $states[8]['name'] }}</h4>
        @foreach ($participations as $p)
            <div class="row">
                <div class="col-xs-5">
                    <div class="cv-label">{{$p->participation_year}} metai</div>
                </div>
                <div class="col-xs-7">
                    <div class="cv-row">{{$p->typeName}}</div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-5">
                    <div class="cv-label">Įvykio pavadinimas</div>
                </div>
                <div class="col-xs-7">
                    <div class="cv-row">{{ $p->participation_name }}</div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-5">
                    <div class="cv-label">Įvykio rengėjas</div>
                </div>
                <div class="col-xs-7">
                    <div class="cv-row">{{ $p->participation_organizer }}</div>
                </div>
            </div>
            @if (!empty($p->participation_description))
                <div class="row">
                    <div class="col-xs-5">
                        <div class="cv-label">Įvykio turinys/ pobūdis</div>
                    </div>
                    <div class="col-xs-7">
                        <div class="cv-row">{!! nl2br(e($p->participation_description)) !!}</div>
                    </div>
                </div>
            @endif
        @endforeach
    @endif

    @if ($recomendations->count())
        <h4>{{ $states[9]['name'] }}</h4>
        @foreach ($recomendations as $r)
            <div class="row">
                <div class="col-xs-5">
                    <div class="cv-label">{{$r->recomendation_year}} metai</div>
                </div>
                <div class="col-xs-7">
                    <div class="cv-row">{{$r->typeName}}</div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-5">
                    <div class="cv-label">Kas įteikė</div>
                </div>
                <div class="col-xs-7">
                    <div class="cv-row">{!! nl2br(e($r->recomendation_name)) !!}</div>
                </div>
            </div>
            @if (!empty($r->recomendation_description))
                <div class="row">
                    <div class="col-xs-5">
                        <div class="cv-label">Dokumento turinys</div>
                    </div>
                    <div class="col-xs-7">
                        <div class="cv-row">{!! nl2br(e($r->recomendation_description)) !!}</div>
                    </div>
                </div>
            @endif
        @endforeach
    @endif

    @if ($extrainfos->count())
        <h4>{{ $states[10]['name'] }}</h4>
        @foreach ($extrainfos as $item)
            @if ($item->trial_salary)
                <div class="row">
                    <div class="col-xs-5">
                        <div class="cv-label">Atlyginimas bandomuoju laikotarpiu</div>
                    </div>
                    <div class="col-xs-7">
                        <div class="cv-row">{{ $item->trial_salary }} Eur</div>
                    </div>
                </div>
            @endif
            @if ($item->full_salary)
                <div class="row">
                    <div class="col-xs-5">
                        <div class="cv-label">Atlyginimas po bandomuojo laikotarpio</div>
                    </div>
                    <div class="col-xs-7">
                        <div class="cv-row">{{ $item->full_salary }} Eur</div>
                    </div>
                </div>
            @endif
            @if ($item->driving_a || $item->driving_b || $item->driving_c || $item->driving_d)
                <div class="row">
                    <div class="col-xs-5">
                        <div class="cv-label">Vairavimo patirtis</div>
                    </div>
                    <div class="col-xs-7">
                        @foreach ($drivingLicenses as $k => $license)
                            <div>
                                @if ($item->{"driving_{$k}"})
                                    {{ $license }}
                                    @if ($item->{"driving_{$k}_year"})
                                        ({{ $item->{"driving_{$k}_year"} }})
                                    @endif
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            @if ($item->extra_info)
                <div class="row">
                    <div class="col-sm-5">
                        <div class="cv-label">Kita informacija:</div>
                    </div>
                    <div class="col-sm-7">
                        <div class="cv-row">{{ $item->extra_info }}</div>
                    </div>
                </div>
            @endif
        @endforeach
        @if ($documents->count())
            <div class="row">
                <div class="col-xs-5">
                    <div class="cv-label">Dokumentai</div>
                </div>
                <div class="col-xs-7">
                    @foreach ($documents as $d)
                        <div>
                            <span class="glyphicon glyphicon-file"></span>
                            <a href="{{$d->fullpath}}" target="_blank">{{$d->filename}}</a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endif

    @if (isset($type) && $type == 'preview')
        <br>
        <div class="text-center">
            {!! Form::open(['route' => ['cv_edit', $cv->id, 11 ], 'class' => 'form-horizontal']) !!}
                <a href="{{route('cv_create')}}" class="btn btn-primary btn-sm">Redaguoti CV</a>
                {!! Form::submit('Įkelti CV', ['class' => 'btn btn-secondary btn-sm', 'style' => 'width:100px;margin-left: 20px']) !!}
            {!! Form::close() !!}
        </div>
    @endif

    @if (!isset($type))
        <br>
        @if (\Auth::check() && (\Auth::user()->isAdminWorker()))
            <div class="text-center">
                <a href="{{ route("cv_edit", ['id'=>$cv->id, 'state' => 1, '#section1']) }}" class="btn btn-sm btn-secondary">Redaguoti CV</a>
                <a href="{{ route('user_profile', ['id'=>$cv->user_id]) }}" class="btn btn-sm btn-danger">Kandidato profilis</a>
                <a href="{{ route("cv_index") }}" class="btn btn-sm btn-primary">Grįžti į CV sąrašą</a>
            </div>
        @endif
    @endif
</div>

@if (\Auth::check() && (\Auth::user()->isAdminWorker()))
    @section('styles')
        <link href="{{ asset('/css/star-rating.min.css') }}" rel="stylesheet">
    @endsection

    @section('scripts')
        <script src="{{ asset('/js/star-rating.min.js') }}"></script>
        <script>
        $("#cvRating").rating({
            showClear: false,
            showCaption: false,
            step: 1,
            size: 'xs'
        });
        </script>
    @endsection
@endif