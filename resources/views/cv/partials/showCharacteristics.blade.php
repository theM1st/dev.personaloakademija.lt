@if ($characteristics->count() > 0 && !empty($characteristics[0]->characteristic_name))
    <div class="row section-group">
        <div class="col-sm-6 section-label">Asmeninės savybės:</div>
        <div class="col-sm-5 section-value">{!! nl2br(e($characteristics[0]->characteristic_name)) !!}</div>
    </div>
@endif
@if ($interests->count() > 0 && !empty($interests[0]->interest_name))
    <div class="row section-group">
        <div class="col-sm-6 section-label">Laisvalaikis ir pomėgiai:</div>
        <div class="col-sm-5 section-value">{!! nl2br(e($interests[0]->interest_name)) !!}</div>
    </div>
@endif
@if ($socactivities->count() > 0 && !empty($socactivities[0]->socactivity_name))
    <div class="row section-group">
        <div class="col-sm-6 section-label">Visuomeninė veikla:</div>
        <div class="col-sm-5 section-value">{!! nl2br(e($socactivities[0]->socactivity_name)) !!}</div>
    </div>
@endif