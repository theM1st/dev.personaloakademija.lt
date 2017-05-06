@include('errors.list')
<div class="row">
{!! Form::open(['class' => 'form-horizontal', 'files' => true]) !!}
    <div class="form-group">
        {!! Form::label('name', 'Vardas, pavardė', ['class' => 'col-sm-5 control-label']) !!}
        <div class="col-sm-5">
            {!! Form::text('name', $cv->name, ['class' => 'form-control input-sm', 'placeholder' => '']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('birthday', 'Gimimo metai', ['class' => 'col-sm-5 control-label']) !!}
        <div class="col-sm-5">
            {!! Form::text('birthday', $cv->birthday, ['class' => 'form-control input-sm datepicker', 'placeholder' => 'pvz. 1995-10-30']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('gender', 'Lytis', ['class' => 'col-sm-5 control-label']) !!}
        <div class="col-sm-5">
            {!! Form::select('gender', $genders, $cv->gender, ['class' => 'form-control input-sm']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('email', 'El. paštas', ['class' => 'col-sm-5 control-label required']) !!}
        <div class="col-sm-5">
            {!! Form::text('email', $cv->email, ['class' => 'form-control input-sm', 'placeholder' => '...@...']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('telephone', 'Tel. numeris', ['class' => 'col-sm-5 control-label required']) !!}
        <div class="col-sm-5">
            {!! Form::text('telephone', $cv->telephone, ['class' => 'form-control input-sm', 'placeholder' => '+370...']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('job_city_id', 'Miestas, kuriame gyvenate', ['class' => 'col-sm-5 control-label']) !!}
        <div class="col-sm-5">
            {!! Form::select('job_city_id', $cities, $cv->job_city_id, ['class' => 'form-control input-sm cities']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('photo', 'Įkelti savo nuotrauką', ['class' => 'col-sm-5 control-label']) !!}
        <div class="col-sm-5">
            @if ($cv->photos()->getPhoto())
                <div class="row">
                    <div class="col-sm-4">
                        <img src="{{$cv->photos()->getPhoto()}}" alt="">
                    </div>
                    @if ($cv->photo)
                    <div class="col-sm-4">
                        <a href="{{action('CvController@deletePhoto', ['cvId' => $cv->id])}}">
                            <span class="glyphicon glyphicon-remove"></span> Trinti
                        </a>
                    </div>
                    @endif
                </div>
            @endif
            <div class="clearfix" style="margin-top:10px">
                <div class="btn btn-sm btn-default pull-left upload-button" data-name="photo" style="padding: 5px 30px;">Įkelti</div>
                <div id="photo-filename" class="btn btn-sm pull-left" style="cursor: default">Nuotrauka neįkelta</div>
            </div>
            {!! Form::file('photo') !!}
            <p class="help-block">Nuotrauka turi būti PNG, JPG arba GIF formatu (iki 10 MB)</p>
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('cv_status', 'CV statusas', ['class' => 'col-sm-5 control-label']) !!}
        <div class="col-sm-5">
            {!! Form::select('cv_status', $statuses, ($cv->cv_status ? $cv->cv_status : 'active'), ['class' => 'form-control input-sm']) !!}
        </div>
    </div>
    <br>
    <div class="form-group">
        <div class="col-sm-offset-5 col-sm-5">
            <div class="row">
                <div class="col-sm-6">
                    {!! Form::submit('Išsaugoti ir toliau', ['class' => 'btn btn-primary btn-sm']) !!}
                </div>
            </div>
        </div>
    </div>
{!! Form::close() !!}
</div>
@section('scripts')
<script type="text/javascript">
    $().ready(function() {
        $('#birthday').datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "-60:+0",
            defaultDate: "{{(new \Carbon('-20 year'))->format('Y-m-d')}}"
        });
    });
</script>
@endsection