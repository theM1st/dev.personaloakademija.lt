@foreach ($recomendations as $k => $r)
    <div class="sub-items @if($k == 0) first @endif">
        <div class="row section-group">
            <div class="col-sm-6 section-label">Kas įteikta/ gauta:</div>
            <div class="col-sm-5 section-value">{{$r->typeName}}</div>
        </div>
        <div class="row section-group">
            <div class="col-sm-6 section-label">Kada įteikta/ gauta:</div>
            <div class="col-sm-5 section-value">{{$r->recomendation_year}}</div>
        </div>
        <div class="row section-group">
            <div class="col-sm-6 section-label">Kas įteikė:</div>
            <div class="col-sm-5 section-value">{!! nl2br(e($r->recomendation_name)) !!}</div>
        </div>
        @if (!empty($r->recomendation_description))
            <div class="row section-group">
                <div class="col-sm-6 section-label">Dokumento turinys:</div>
                <div class="col-sm-5 section-value">{!! nl2br(e($r->recomendation_description)) !!}</div>
            </div>
        @endif
    </div>
@endforeach