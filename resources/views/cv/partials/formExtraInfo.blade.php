<div class="extra-info-form">
    @include('errors.list')
    <div class="extra-info">
        {!! Form::open(['action' => ['CvController@update', $cv->id, $currentState, '#section'.$currentState], 'class' => 'form-horizontal', 'files' => true]) !!}

        <div class="form-group">
            {!! Form::label('trial_salary', 'Atlyginimas bandomuoju laikotarpiu', ['class' => 'col-sm-4 control-label']) !!}
            <div class="col-sm-5">
                {!! Form::text('trial_salary', old('trial_salary', $extrainfo->trial_salary), ['class' => 'form-control input-sm', 'style' => 'width:100px;display:inline-block', 'placeholder' => 'Įrašyti']) !!} Eur
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('full_salary', 'Atlyginimas po bandomuojo laikotarpio', ['class' => 'col-sm-4 control-label']) !!}
            <div class="col-sm-5">
                {!! Form::text('full_salary', old('trial_salary', $extrainfo->full_salary), ['class' => 'form-control input-sm', 'style' => 'width:100px;display:inline-block', 'placeholder' => 'Įrašyti']) !!} Eur
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('driving_a', 'Vairavimo patirtis', ['class' => 'col-sm-4 control-label']) !!}
            <div class="col-sm-5">
                @foreach ($drivingLicenses as $k => $license)
                    <div class="driving-license">
                        <div class="checkbox">
                            <label>
                                <input name="driving_{{ $k }}" value="1" type="checkbox"{{ (old("driving_{$k}", $extrainfo->{"driving_{$k}"}) ? 'checked' : '') }}> {{ $license }}
                            </label>
                        </div>
                        <div class="control-input">
                            {!! Form::text("driving_{$k}_year", old("driving_{$k}_year",$extrainfo->{"driving_{$k}_year"}), ['class' => 'form-control input-sm', 'placeholder' => 'YYYY']) !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('extra_info', 'Kita informacija', ['class' => 'col-sm-4 control-label']) !!}
            <div class="col-sm-7">
                {!! Form::text('extra_info', old('extra_info', $extrainfo->extra_info), ['class' => 'form-control input-sm', 'placeholder' => 'Įrašyti']) !!}
            </div>
        </div>

        <hr>

        <div class="row form-group">
            <div class="col-sm-8 text-right">

                <button type="button" style="margin-right:20px" class="btn btn-sm btn-default upload-button" data-name="cv_document" title="Sertifikatai, pažymėjimai, atestatai, pagyrimai ir pan. (Word, PDF,  JPG, PNG)">
                    Prisegti susijusius dokumentus
                </button>
                <span id="cv_document-filename">Dokumentas nepasirinktas</span>
            </div>
            <div class="col-sm-3">
                {!! Form::button('Prisegti dokumentą',
                [
                    'class' => 'btn btn-tertiary btn-sm attach-document-btn',
                    'data-action' => action('CvController@saveDocument', [$cv->id, '#section'.$currentState])
                ]) !!}
            </div>
        </div>

        @if ($documents->count())
            <div class="form-group">
                {!! Form::label('cv_document', 'Dokumentai', ['class' => 'col-sm-4 control-label']) !!}
                <div class="col-sm-7">
                    @foreach ($documents as $d)
                        <div>
                            <span class="glyphicon glyphicon-file"></span>&nbsp
                            <a href="{{$d->fullpath}}" target="_blank" title="Atsisiųsti dokumentą">{{$d->filename}}</a>
                            <button type="button" class="btn btn-link btn-sm delete-cvdocument" onclick="$('#delete-document-{{ $d->id }}').submit()">
                                Trinti
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        <br>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-7">
                <div class="row">
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-primary btn-sm">
                            Išsaugoti ir baigti CV pildymą
                        </button>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" onclick="skipState('{{$cv->id}}', '{{$currentState}}')" class="btn btn-secondary btn-sm">
                            Praleisti ir baigti CV pildymą
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @if ($extrainfo->id)
            {!! Form::hidden('id', $extrainfo->id) !!}
        @endif
        <span class="hide">{!! Form::file('cv_document') !!}</span>
        {!! Form::close() !!}
    </div>
</div>
@if ($documents->count())
    @foreach ($documents as $d)
        {!! Form::open(['action' => ['CvController@deleteDocument', $d->id], 'method' => 'delete', 'id' => "delete-document-{$d->id}", 'onsubmit' => 'return confirm("Ar tikrai ištrinti?")']) !!}
        {!! Form::close() !!}
    @endforeach
@endif