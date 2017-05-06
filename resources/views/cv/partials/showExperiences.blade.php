@foreach ($experiences as $k => $item)
    <div class="sub-items @if($k == 0) first @endif">
        <div class="row section-group">
            <div class="col-sm-6 section-label">Darbo laikotarpis:</div>
            <div class="col-sm-5 section-value">nuo {{$item->work_from}} iki {{ strtolower($item->workToName) }}</div>
        </div>
        <div class="row section-group">
            <div class="col-sm-6 section-label">Įmonės pavadinimas:</div>
            <div class="col-sm-5 section-value">{{$item->company_name}}</div>
        </div>

        <div class="row section-group">
            <div class="col-sm-6 section-label">Pareigos:</div>
            <div class="col-sm-5 section-value">{{$item->work_position}}</div>
        </div>
        @if ($item->main_tasks)
            <div class="row section-group">
                <div class="col-sm-6 section-label">Darbo pobūdis:</div>
                <div class="col-sm-5 section-value">{!! nl2br(e($item->main_tasks)) !!}</div>
            </div>
        @endif
        <?php /*
        @if ($e->achievements)
            <div class="row section-group">
                <div class="col-sm-6 section-label">Pasiekimai:</div>
                <div class="col-sm-5 section-value">{!! nl2br(e($e->achievements)) !!}</div>
            </div>
        @endif
        @if ($e->reason_go_out)
            <div class="row section-group">
                <div class="col-sm-6 section-label">Priežastys, dėl kurių išėjote:</div>
                <div class="col-sm-5 section-value">{!! nl2br(e($e->reason_go_out)) !!}</div>
            </div>
        @endif */ ?>
    </div>
@endforeach