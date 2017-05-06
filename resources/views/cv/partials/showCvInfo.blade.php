@if ($cv->cv_name)
<div class="row section-group">
    <div class="col-sm-6 section-label">Jūsų CV pavadinimas/ antraštė:</div>
    <div class="col-sm-5 section-value">{{$cv->cv_name}}</div>
</div>
@endif
@if ($cv->description)
<div class="row section-group">
    <div class="col-sm-6 section-label">Trumpas prisistatymas:</div>
    <div class="col-sm-6 section-value">{!! nl2br(e($cv->description)) !!}</div>
</div>
@endif