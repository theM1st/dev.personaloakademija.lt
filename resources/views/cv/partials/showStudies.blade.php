@foreach ($studies as $k => $item)
    <div class="sub-items @if($k == 0) first @endif">
        <div class="row section-group">
            <div class="col-sm-6 section-label">Studijų/ mokymosi laikotarpis:</div>
            <div class="col-sm-5 section-value">{{ $item->study_from_year }} - {{ $item->study_to_year }}</div>
        </div>
        @if ($item->institution_name)
            <div class="row section-group">
                <div class="col-sm-6 section-label">Švietimo įstaigos pavadinimas:</div>
                <div class="col-sm-5 section-value">{{ $item->institution_name }}</div>
            </div>
        @endif
        @if ($item->study_scope)
            <div class="row section-group">
                <div class="col-sm-6 section-label">Studijų/ mokymosi sritis:</div>
                <div class="col-sm-5 section-value">{{ $item->study_scope }}</div>
            </div>
        @endif
        <?php /*
        @if (isset($s->scope->name))
            <div class="row section-group">
                <div class="col-sm-6 section-label">Profesijos sritis:</div>
                <div class="col-sm-5 section-value">{{$s->scope->name}}</div>
            </div>
        @endif
        */ ?>
        <div class="row section-group">
            <div class="col-sm-6 section-label">Specialybės pavadinimas:</div>
            <div class="col-sm-5 section-value">{{ $item->specialty }}</div>
        </div>
        <div class="row section-group">
            <div class="col-sm-6 section-label">Įgytas laipsnis:</div>
            <div class="col-sm-5 section-value">
                {{ $item->grade->name }}
                @if ($item->courseName)
                    <span class="cv-study-course">, {{ $item->courseName }}</span>
                @endif
            </div>
        </div>

    </div>
@endforeach