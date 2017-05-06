@foreach ($participations as $k => $p)
    <div class="sub-items @if($k == 0) first @endif">
        <div class="row section-group">
            <div class="col-sm-6 section-label">Įvykis:</div>
            <div class="col-sm-5 section-value">{{$p->typeName}}</div>
        </div>
        <div class="row section-group">
            <div class="col-sm-6 section-label">Įvykio metai:</div>
            <div class="col-sm-5 section-value">{{$p->participation_year}}</div>
        </div>
        <div class="row section-group">
            <div class="col-sm-6 section-label">Įvykio pavadinimas:</div>
            <div class="col-sm-5 section-value">{{$p->participation_name}}</div>
        </div>
        <div class="row section-group">
            <div class="col-sm-6 section-label">Įvykio rengėjas:</div>
            <div class="col-sm-5 section-value">{!! nl2br(e($p->participation_organizer)) !!}</div>
        </div>
        @if (!empty($p->participation_description))
            <div class="row section-group">
                <div class="col-sm-6 section-label">Įvykio turinys/ pobūdis:</div>
                <div class="col-sm-5 section-value">{!! nl2br(e($p->participation_description)) !!}</div>
            </div>
        @endif
    </div>
@endforeach