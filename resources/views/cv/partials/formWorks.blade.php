<div id="workForms">
    @include('errors.list')
    @foreach ($works as $k => $item)
        <div class="form @if($k == 0)first @endif" @if ($k == 0) id="work-clone-area"@endif>
            {!! Form::open(['class' => 'form-horizontal']) !!}
                <div class="form-group row">
                    <div class="col-sm-offset-1 col-sm-10">
                        {!! Form::label('interested_work_description', '', ['class' => 'sr-only']) !!}
                        {!! Form::textarea('interested_work_description', $item->interested_work_description, ['rows' => '2', 'class' => 'form-control input-sm', 'placeholder' => 'Trumpai parašyti apie dominančią darbo sritį, pareigas ir darbo pobūdį (neprivaloma, bet rekomenduojama)']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('interested_work_city_id', 'Miestas, kuriame noritе dirbti', ['class' => 'col-sm-5 control-label']) !!}
                    <div class="col-sm-5">
                        {!! Form::select("interested_work_city_id[]", $cities, $item->cities->pluck('id')->toArray(), ['class' => 'form-control input-sm multiselect', 'multiple'=>'multiple']) !!}
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-info-sign" title="Rinkitės iki 3 miestų."></span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('work_scope_id', 'Dominančios darbo sritys', ['class' => 'col-sm-5 control-label']) !!}
                    <div class="col-sm-5">
                        {!! Form::select('work_scope_id[]', $scopes, $item->workScopes->pluck('id')->toArray(), ['class' => 'form-control input-sm multiselect', 'multiple'=>'multiple']) !!}
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-info-sign" title="Rinkitės iki 3 sričių."></span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('interested_work_position', 'Dominančios pareigos', ['class' => 'col-sm-5 control-label']) !!}
                    <div class="col-sm-5">
                        {!! Form::text('interested_work_position', $item->interested_work_position, ['class' => 'form-control input-sm', 'placeholder' => 'Įrašyti']) !!}
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-info-sign" title="Įrašykite iki 3 pareigų."></span>
                    </div>
                </div>
                {!! Form::hidden('id', $item->id) !!}
                {!! Form::hidden('form_type', 'works') !!}
            {!! Form::close() !!}
        </div>
    @endforeach
</div>
<div id="experienceForms">
    <h4>Darbo patirtis</h4>
    @foreach ($experiences as $k => $item)
        <div class="form @if($k == 0)first @endif" @if ($k == 0) id="experience-clone-area"@endif>
            {!! Form::open(['class' => 'form-horizontal']) !!}
            <span class="hide">{!! Form::text('form_type', 'experiences', ['data-ignore' => 1]) !!}</span>
            <div class="form-group">
                {!! Form::label('', 'Darbo laikotarpis', ['class' => 'col-sm-5 control-label']) !!}
                <div class="col-sm-7">
                    <div class="row">
                        <div class="col-sm-10">
                            <div class="pull-left" style="width: 50%">
                                {!! Form::select('work_from_year', $workYearsFrom, $item->work_from_year, ['class' => 'form-control input-sm', 'style'=>'width:48%; display:inline-block']) !!}
                                {!! Form::select('work_from_month', $months, $item->work_from_month, ['class' => 'form-control input-sm', 'style'=>'width:50%; display:inline-block']) !!}
                            </div>
                            <div class="pull-left" style="width: 50%">
                                &nbsp;-&nbsp;
                                {!! Form::select('work_to_year', $workYearsTo, $item->work_to_year, ['class' => 'form-control input-sm', 'style'=>'width:40%; display:inline-block']) !!}
                                {!! Form::select('work_to_month', $months, $item->work_to_month, ['class' => 'form-control input-sm', 'style'=>'width:50%; display:inline-block']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                @if ($item->id)
                    <a href="{{Request::url()}}?removeExperience={{$item->id}}" class="remove-multiple-item" title="Ištrinti"><span class="glyphicon glyphicon-minus-sign"></span></a>
                @endif
            </div>
            <div class="form-group">
                {!! Form::label('company_name', 'Įmonės pavadinimas', ['class' => 'col-sm-5 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::text('company_name', $item->company_name, ['class' => 'form-control input-sm', 'placeholder' => 'Įrašyti']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('work_position1', 'Pareigos', ['class' => 'col-sm-5 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::text('work_position', $item->work_position, ['class' => 'form-control input-sm', 'placeholder' => 'Įrašyti']) !!}
                </div>
            </div>

                <div class="form-group">
                    {!! Form::label('main_tasks', 'Darbo pobūdis', ['class' => 'col-sm-5 control-label']) !!}
                    <div class="col-sm-5">
                        {!! Form::textarea('main_tasks', $item->main_tasks, ['rows' => '2', 'class' => 'form-control input-sm', 'placeholder' => 'Įrašyti (neprivaloma, bet rekomenduojama)']) !!}
                    </div>
                </div>
                {!! Form::hidden('id', $item->id) !!}
            {!! Form::close() !!}
        </div>
    @endforeach
    <div id="experience-clone-area-container"></div>
    <div class="row">
        <div class="col-sm-offset-5 col-sm-5">
            <button type="button" class="btn btn-link clone-button" style="color: #008534" data-clone-type="block" data-clone-area="experience-clone-area">
                <span class="glyphicon glyphicon-plus-sign"></span> Pridėti dar įrašų
            </button>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-offset-5 col-sm-5">
            <div class="row">
                <div class="col-sm-6">
                    {!! Form::button('Išsaugoti ir toliau', ['class' => 'btn btn-primary btn-sm', 'onclick'=>"st = ajaxForms('workForms'); st2 = ajaxForms('experienceForms'); $('button').attr('disabled', false); if(st && st2) location.href = st"]) !!}
                </div>
                <div class="col-sm-6">
                    {!! Form::button('Praleisti ir toliau', ['class' => 'btn btn-secondary btn-sm', 'onclick'=>"skipState($cv->id, $currentState)"]) !!}
                </div>
            </div>
        </div>
    </div>
</div>