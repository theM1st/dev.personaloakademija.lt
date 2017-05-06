<div id="experienceForms">
    @include('errors.list')
    @foreach ($data as $k => $e)
        <div class="form @if($k == 0)first @endif" @if ($k == 0) id="experience-clone-area"@endif>
            {!! Form::open(['class' => 'form-horizontal']) !!}
                <div class="form-group">
                    {!! Form::label('', 'Darbo laikotarpis', ['class' => 'col-sm-4 control-label']) !!}
                    <div class="col-sm-7">
                        <div class="row">
                            <div class="col-sm-10">
                                <div class="pull-left" style="width: 50%">
                                    {!! Form::select('work_from_year', $workYearsFrom, $e->work_from_year, ['class' => 'form-control input-sm', 'style'=>'width:48%; display:inline-block']) !!}
                                    {!! Form::select('work_from_month', $months, $e->work_from_month, ['class' => 'form-control input-sm', 'style'=>'width:50%; display:inline-block']) !!}
                                </div>
                                <div class="pull-left" style="width: 50%">
                                    &nbsp;-&nbsp;
                                    {!! Form::select('work_to_year', $workYearsTo, $e->work_to_year, ['class' => 'form-control input-sm', 'style'=>'width:40%; display:inline-block']) !!}
                                    {!! Form::select('work_to_month', $months, $e->work_to_month, ['class' => 'form-control input-sm', 'style'=>'width:50%; display:inline-block']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($e->id)
                        <a href="{{Request::url()}}?removeExperience={{$e->id}}" class="remove-multiple-item" title="Ištrinti"><span class="glyphicon glyphicon-minus-sign"></span></a>
                    @endif
                </div>
                <div class="form-group">
                    {!! Form::label('company_name', 'Įmonės pavadinimas', ['class' => 'col-sm-4 control-label']) !!}
                    <div class="col-sm-7">
                        {!! Form::text('company_name', $e->company_name, ['class' => 'form-control input-sm', 'placeholder' => 'Įrašyti']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('work_position', 'Pareigos', ['class' => 'col-sm-4 control-label']) !!}
                    <div class="col-sm-7">
                        {!! Form::text('work_position', $e->work_position, ['class' => 'form-control input-sm', 'placeholder' => 'Įrašyti']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('main_tasks', 'Darbo pobūdis', ['class' => 'col-sm-4 control-label']) !!}
                    <div class="col-sm-7">
                        {!! Form::textarea('main_tasks', $e->main_tasks, ['rows' => '2', 'class' => 'form-control input-sm', 'placeholder' => 'Įrašyti (neprivaloma, bet rekomenduojama)']) !!}
                    </div>
                </div>
<?php /*
                <div class="form-group">
                    {!! Form::label('achievements', 'Pasiekimai', ['class' => 'col-sm-4 control-label']) !!}
                    <div class="col-sm-7">
                        {!! Form::textarea('achievements', $e->achievements, ['rows' => '2', 'class' => 'form-control input-sm', 'placeholder' => 'Įrašyti (neprivaloma, bet rekomenduojama)']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('reason_go_out', 'Priežastys, dėl kurių išėjote', ['class' => 'col-sm-4 control-label']) !!}
                    <div class="col-sm-7">
                        {!! Form::textarea('reason_go_out', $e->reason_go_out, ['rows' => '2', 'class' => 'form-control input-sm', 'placeholder' => 'Įrašyti (neprivaloma, bet rekomenduojama)']) !!}
                    </div>
                </div>
 */ ?>
                {!! Form::hidden('id', $e->id) !!}
            {!! Form::close() !!}
        </div>
    @endforeach
    <div id="experience-clone-area-container"></div>
    <div class="row">
        <div class="col-sm-offset-4 col-sm-5">
            <button type="button" class="btn btn-link clone-button" style="color: #008534" data-clone-type="block" data-clone-area="experience-clone-area">
                <span class="glyphicon glyphicon-plus-sign"></span> Pridėti dar įrašų
            </button>
        </div>
    </div>
    <br>
    <div class="form-group row">
        <div class="col-sm-offset-4 col-sm-5">
            <div class="row">
                <div class="col-sm-6">
                    {!! Form::button('Išsaugoti ir toliau', ['class' => 'btn btn-primary', 'onclick'=>'ajaxForms(\'experienceForms\')']) !!}
                </div>
                <div class="col-sm-6">
                    {!! Form::button('Praleisti ir toliau', ['class' => 'btn btn-secondary', 'onclick'=>"skipState($cv->id, $currentState)"]) !!}
                </div>
            </div>
        </div>
    </div>
</div>


