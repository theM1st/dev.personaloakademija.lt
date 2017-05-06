@if (isset($languages[0]))
    <div class="row section-group">
        <div class="col-sm-6 section-label">Gimtoji kalba:</div>
        <div class="col-sm-5 section-value">
            @if ($languages[0]->first_language_value)
                {{ $languages[0]->first_language_value }}
            @else
                {{$languages[0]->firstLanguageName}}
             @endif
        </div>
    </div>
    @if ($languages[0]->foreignLanguageName || $languages[0]->foreign_language_value)
        @foreach ($languages as $k => $l)
            <div class="row section-group">
                <div class="col-sm-6 section-label">@if ($k == 0)Užsienio kalba (-os):@endif</div>
                <div class="col-sm-6 section-value">
                    @if ($l->foreign_language_value)
                        {{ $l->foreign_language_value }}
                    @else
                        {{$l->foreignLanguageName}}
                    @endif
                    <div class="row">
                        @if (!empty($l->understanding_level))
                            <div class="col-sm-3 language-level-block">
                                <span class="language-level-name">Supratimas</span>
                                <span class="language-level">{{$l->understanding_level}}</span>
                            </div>
                        @endif
                        @if (!empty($l->speaking_level))
                            <div class="col-sm-3 language-level-block">
                                <span class="language-level-name">Kalbėjimas</span>
                                <span class="language-level">{{$l->speaking_level}}</span>
                            </div>
                        @endif
                        @if (!empty($l->reading_level))
                            <div class="col-sm-3 language-level-block">
                                <span class="language-level-name">Skaitymas</span>
                                <span class="language-level">{{$l->reading_level}}</span>
                            </div>
                        @endif
                        @if (!empty($l->writing_level))
                            <div class="col-sm-3 language-level-block">
                                <span class="language-level-name">Rašymas</span>
                                <span class="language-level">{{$l->writing_level}}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    @endif
@endif