<div class="row section-group">
    <div class="col-sm-6 section-label">Vardas, pavardė:</div>
    <div class="col-sm-5 section-value">{{$cv->name}}</div>
</div>
<div class="row section-group">
    <div class="col-sm-6 section-label">Gimimo metai:</div>
    <div class="col-sm-5 section-value">{{$cv->birthday}}</div>
</div>
<div class="row section-group">
    <div class="col-sm-6 section-label">Lytis:</div>
    <div class="col-sm-5 section-value">{{$cv->genderName}}</div>
</div>
<div class="row section-group">
    <div class="col-sm-6 section-label">El. paštas:</div>
    <div class="col-sm-5 section-value">{{$cv->email}}</div>
</div>
<div class="row section-group">
    <div class="col-sm-6 section-label">Tel. numeris:</div>
    <div class="col-sm-5 section-value">{{$cv->telephone}}</div>
</div>
<div class="row section-group">
    <div class="col-sm-6 section-label">Miestas, kuriame gyvenate:</div>
    <div class="col-sm-5 section-value">{{$cv->jobCity}}</div>
</div>
@if ($cv->photos()->getPhoto())
    <div class="row section-group">
        <div class="col-sm-6 section-label">Nuotrauka:</div>
        <div class="col-sm-5 section-value"><img src="{{$cv->photos()->getPhoto()}}" alt=""></div>
    </div>
@endif
<div class="row section-group">
    <div class="col-sm-6 section-label">CV statusas:</div>
    <div class="col-sm-5 section-value">{{$cv->statusName}}</div>
</div>