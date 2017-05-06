@foreach ($extrainfos as $k => $item)
    <div class="sub-items @if($k == 0) first @endif">
        @if ($item->trial_salary)
            <div class="row section-group">
                <div class="col-sm-6 section-label">Atlyginimas bandomuoju laikotarpiu:</div>
                <div class="col-sm-5 section-value">{{ $item->trial_salary }} Eur</div>
            </div>
        @endif
        @if ($item->full_salary)
            <div class="row section-group">
                <div class="col-sm-6 section-label">Atlyginimas po bandomuojo laikotarpio:</div>
                <div class="col-sm-5 section-value">{{ $item->full_salary }} Eur</div>
            </div>
        @endif
        @if ($item->driving_a || $item->driving_b || $item->driving_c || $item->driving_d)
            <div class="row section-group">
                <div class="col-sm-6 section-label">Vairavimo patirtis:</div>
                <div class="col-sm-5 section-value">
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
            <div class="row section-group">
                <div class="col-sm-6 section-label">Kita informacija:</div>
                <div class="col-sm-5 section-value">{{ $item->extra_info }}</div>
            </div>
        @endif
    </div>
@endforeach
@if ($documents->count())
    <div class="row section-group">
        <div class="col-sm-6 section-label">Dokumentai:</div>
        <div class="col-sm-5 section-value">
            @foreach ($documents as $d)
                <div>
                    <span class="glyphicon glyphicon-file"></span>
                    <a href="{{$d->fullpath}}" target="_blank" title="Atsisiųsti dokumentą">{{$d->filename}}</a>
                </div>
            @endforeach
        </div>
    </div>
@endif