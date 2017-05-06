<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<style>
  body { font-family: DejaVu Serif; font-size: 12px; line-height: 16px; }
  h1 { font-size: 20px; font-weight:normal; text-align: center}
  table { border-collapse: collapse; border-spacing:0; margin: 0; width: 100%; }
  table td { border: 0px solid #000000; padding: 0; vertical-align: top;  }
  table td.padding, table tr > td > table tr > td { padding: 2px 8px; }
  table td table td { width: 60%; }
  table tr > td > table tr > td.label {
      text-align: right;
      width: 40%;
  }
  table tr > td > table tr > td > table tr > td { padding:0 }
  table td.title {
      background: #e8e8e8;
      font-size: 14px;
      padding: 2px 6px;
  }
  .colorGrey {
    color: #777777;
  }
</style>
</head>
<body>


<div style="position:relative">
    @if ($cv->cv_name)
        <h1>{{$cv->cv_name}}</h1>
    @endif

    <table>
        <tr>
            <td width="100" align="center" class="padding">
                <img src="{{ substr($cv->photos()->getPhoto(), 1) }}" alt="">
            </td>
            <td class="padding">
                <div>{{$cv->name}}</div>
                <div>{{$cv->genderName}}, {{$cv->age}} m.</div>
                <div>{{$cv->city}}</div>
                <div>{{$cv->telephone}}</div>
                <div>{{$cv->email}}</div>
            </td>
            <td align="right">
                 <img src="assets/img/large-logo.png" alt="logo" width="100">
            </td>
        </tr>
    </table>
    @if ($cv->description)
    <table>
        <tr>
            <td class="title">Trumpas prisistatymas</td>
        </tr>
        <tr>
            <td class="padding">{{$cv->description}}</td>
        </tr>
    </table>
    @endif
    <table>
        @if ($studies->count())
            <tr>
                <td class="title">{{ $states[3]['name'] }}</td>
            </tr>
            <tr>
                <td>
                    @foreach ($studies as $k => $s)
                        <table style="{{ ($k > 0 ? 'margin-top:15px' : '') }}">
                            <tr>
                                <td class="label">{{$s->study_from_year}} - {{$s->study_to_year}} metai</td>
                                <td>
                                    @if ($s->institution_name)
                                        {{ $s->institution_name }}
                                    @endif
                                </td>
                            </tr>
                            @if (isset($s->study_scope))
                                <tr>
                                    <td class="label">Studijų/ mokymosi sritis</td>
                                    <td>{{ $s->study_scope }}</td>
                                </tr>
                            @endif
                            <tr class="cv-study-specialty cv-row">
                                <td class="label">Specialybės pavadinimas</td>
                                <td>{{$s->specialty}}</td>
                            </tr>
                            <tr class="cv-study-grade cv-row">
                                <td class="label">Įgytas laipsnis</td>
                                <td>
                                    {{$s->grade->name}}
                                    @if ($s->courseName)
                                        <span>, {{$s->courseName}}</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    @endforeach
                </td>
            </tr>
        @endif
        @if ($works->count())
            <tr>
                <td class="title">{{ $states[4]['name'] }}</td>
            </tr>
            <tr>
                <td>
                    @foreach ($works as $w)
                        <table>
                            <tr>
                                <td colspan="2">{!! nl2br(e($w->interested_work_description)) !!}</td>
                            </tr>
                            @if ($w->citiesName)
                                <tr>
                                    <td class="label">Miestas, kuriame norima dirbti</td>
                                    <td>{{ $w->citiesName->implode(', ') }}</td>
                                </tr>
                            @endif
                            @if ($w->workScopesName)
                                <tr>
                                    <td class="label">Dominančios darbo sritys</td>
                                    <td>{!! $w->workScopesName->implode('<br>') !!}</td>
                                </tr>
                            @endif
                            <tr>
                                <td class="label">Dominančios pareigos</td>
                                <td>{{$w->interested_work_position}}</td>
                            </tr>
                        </table>
                    @endforeach
                </td>
            </tr>
        @endif
        @if ($experiences->count())
            <tr>
                <td>
                    @foreach ($experiences as $e)
                        <table style="margin-top:15px">
                            <tr>
                                <td class="label">
                                    nuo {{$e->workFromYear}}-{{$e->workFromMonth}} - {{$e->workToName}}
                                </td>
                                <td>
                                    {{$e->company_name}}
                                </td>
                            </tr>
                            @if ($e->work_position)
                                <tr>
                                    <td class="label">Pareigos</td>
                                    <td>{{$e->work_position}}</td>
                                </tr>
                            @endif
                            @if ($e->main_tasks)
                                <tr>
                                    <td class="label">Darbo pobūdis</td>
                                    <td>{!! nl2br(e($e->main_tasks)) !!}</td>
                                </tr>
                            @endif
                        </table>
                    @endforeach
                </td>
            </tr>
        @endif

        @if ($languages->count())
            <tr>
                <td class="title">{{ $states[5]['name'] }}</td>
            </tr>
            <tr>
                <td>
                    <table>
                        <tr>
                            @if ($languages[0]->firstLanguageName)
                                <td class="label"> Gimtoji kalba</td>
                                <td>{{$languages[0]->firstLanguageName}}</td>
                            @endif
                        </tr>
                        <tr>
                            @if ($languages[0]->foreignLanguageName)
                                <td class="label">Užsienio kalba</td>
                                <td>
                                    <table>
                                        <tr>
                                            @foreach ($languages as $k => $l)
                                                @if (($k % 3) == 0 && $k > 0) </tr><tr> @endif
                                                <td>
                                                    <div>{{$l->foreignLanguageName}}</div>
                                                    <table class="colorGrey">
                                                        @if ($l->understanding_level)
                                                            <tr>
                                                                <td>Supratimas:</td>
                                                                <td align="center">{{$l->understanding_level}}</td>
                                                            </tr>
                                                        @endif
                                                        @if ($l->speaking_level)
                                                            <tr>
                                                                <td>Kalbėjimas:</td>
                                                                <td align="center">{{$l->speaking_level}}</td>
                                                            </tr>
                                                        @endif
                                                        @if ($l->reading_level)
                                                            <tr>
                                                                <td>Skaitymas:</td>
                                                                <td align="center">{{$l->reading_level}}</td>
                                                            </tr>
                                                        @endif
                                                        @if ($l->writing_level)
                                                            <tr>
                                                                <td>Rašymas:</td>
                                                                <td align="center">{{$l->writing_level}}</td>
                                                            </tr>
                                                        @endif
                                                    </table>
                                                </td>
                                            @endforeach
                                        </tr>
                                    </table>
                                </td>
                            @endif
                        </tr>
                    </table>
                </td>
            </tr>
        @endif
        @if (count($itknowledges))
            <tr>
                <td class="title">{{ $states[6]['name'] }}</td>
            </tr>
            <tr>
                <td>
                    @foreach ($itknowledges as $item)
                        <table>
                            <tr>
                                <td class="label">{{$item['category']->name}}</td>
                                <td>
                                    @foreach ($item['knowledges'] as $knowledge)
                                        @if (isset($knowledge->knowledge->name))
                                            <div>
                                                {{$knowledge->knowledge->name}} <span class="colorGrey">({{$knowledge->levelName}})</span>
                                            </div>
                                        @elseif ($knowledge->knowledge_name)
                                            <div>
                                                Kita: {{$knowledge->knowledge_name}}
                                            </div>
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                        </table>
                    @endforeach
                </td>
            </tr>
        @endif

        @if ($characteristics->count() || $interests->count() || $socactivities->count())
            <tr>
                <td class="title">{{ $states[7]['name'] }}</td>
            </tr>
            <tr>
                <td>
                    <table>
                        @foreach ($characteristics as $c)
                            @if (!empty($c->characteristic_name))
                                <tr>
                                    <td class="label">Asmeninės savybės</td>
                                    <td>{!! nl2br(e($c->characteristic_name)) !!}</td>
                                </tr>
                            @endif
                        @endforeach

                        @foreach ($interests as $c)
                            @if (!empty($c->interest_name))
                                <tr>
                                    <td class="label">Laisvalaikis ir pomėgiai</td>
                                    <td>{!! nl2br(e($c->interest_name)) !!}</td>
                                </tr>
                            @endif
                        @endforeach

                        @foreach ($socactivities as $c)
                            @if (!empty($c->socactivity_name))
                                <tr>
                                    <td class="label">Visuomeninė veikla</td>
                                    <td>{!! nl2br(e($c->socactivity_name)) !!}</td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                </td>
            </tr>
        @endif

        @if ($participations->count())
            <tr>
                <td class="title">{{ $states[8]['name'] }}</td>
            </tr>
            <tr>
                <td>
                    @foreach ($participations as $p)
                        <table style="margin-bottom:10px">
                            <tr>
                                <td class="label">{{$p->participation_year}} metai</td>
                                <td>{{$p->typeName}}</td>
                            </tr>
                            <tr>
                                <td class="label">Įvykio pavadinimas</td>
                                <td>{!! nl2br(e($p->participation_name)) !!}</td>
                            </tr>
                            <tr>
                                <td>Įvykio rengėjas</td>
                                <td>{{ $p->participation_organizer }}</td>
                            </tr>
                            @if (!empty($p->participation_description))
                                <tr>
                                    <td class="label">Įvykio turinys/ pobūdis</td>
                                    <td>{!! nl2br(e($p->participation_description)) !!}</td>
                                </tr>
                            @endif
                        </table>
                    @endforeach
                </td>
            </tr>
        @endif

        @if ($recomendations->count())
            <tr>
                <td class="title">{{ $states[9]['name'] }}</td>
            </tr>
            <tr>
                <td>
                    @foreach ($recomendations as $r)
                        <table style="margin-bottom:10px">
                            <tr>
                                <td class="label">{{$r->recomendation_year}} metai</td>
                                <td>{{$r->typeName}}</td>
                            </tr>
                            <tr>
                                <td class="label">Kas įteikė</td>
                                <td>{!! nl2br(e($r->recomendation_name)) !!}</td>
                            </tr>
                            @if (!empty($r->recomendation_description))
                                <tr>
                                    <td class="label">Dokumento turinys</td>
                                    <td>{!! nl2br(e($r->recomendation_description)) !!}</td>
                                </tr>
                            @endif
                        </table>
                    @endforeach
                </td>
            </tr>
        @endif
        @if ($extrainfos->count())
            <tr>
                <td class="title">{{ $states[10]['name'] }}</td>
            </tr>
            <tr>
                <td>
                    @foreach ($extrainfos as $item)
                        <table style="margin-bottom:10px">
                            @if ($item->trial_salary)
                                <tr>
                                    <td class="label">Atlyginimas bandomuoju laikotarpiu</td>
                                    <td>{{ $item->trial_salary }} Eur</td>
                                </tr>
                            @endif
                            @if ($item->full_salary)
                                <tr>
                                    <td class="label">Atlyginimas po bandomuojo laikotarpio</td>
                                    <td>{{ $item->full_salary }} Eur</td>
                                </tr>
                            @endif
                            @if ($item->driving_a || $item->driving_b || $item->driving_c || $item->driving_d)
                                <tr>
                                    <td class="label">Vairavimo patirtis</td>
                                    <td>
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
                                    </td>
                                </tr>
                            @endif
                            @if ($item->extra_info)
                                <tr>
                                    <td class="label">Kita informacija</td>
                                    <td>{{ $item->extra_info }}</td>
                                </tr>
                            @endif
                        </table>
                    @endforeach
                </td>
            </tr>
        @endif
    </table>
</div>

</body>
</html>