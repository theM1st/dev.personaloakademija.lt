@include('errors.list')
<div class="form-group">
    {!! Form::label('banner_name', 'Pavadinimas', ['class' => 'col-sm-3 control-label required']) !!}
    <div class="col-sm-5">
        {!! Form::text('banner_name', $banner->banner_name, ['class' => 'form-control input-sm']) !!}
    </div>
</div>
@if (!$banner->id)
    <div class="form-group">
        {!! Form::label('banner_image', 'Baneris (gif, jpg, png)', ['class' => 'col-sm-3 control-label required']) !!}
        <div class="col-sm-5">
            <div class="clearfix">
                <div class="btn btn-sm btn-default pull-left upload-button" data-name="banner_image" style="padding: 5px 30px;">Įkelti</div>
                <div id="banner_image-filename" class="btn btn-sm pull-left" style="cursor: default">Baneris neįkeltas</div>
            </div>
            {!! Form::file('banner_image') !!}
        </div>
    </div>
@endif
<div class="form-group">
    {!! Form::label('banner_link', 'Banerio nuoroda', ['class' => 'col-sm-3 control-label required']) !!}
    <div class="col-sm-5">
        {!! Form::text('banner_link', $banner->banner_link, ['class' => 'form-control input-sm', 'placeholder' => 'pvz. http://www.personaloakademija.lt']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('banner_zone', 'Banerio zona', ['class' => 'col-sm-3 control-label required']) !!}
    <div class="col-sm-5">
        <div class="radio">
            <label>
                {!! Form::radio('banner_zone', 'left', ($banner->banner_zone == 'left' || !$banner->banner_zone)) !!}
                Baneris kairėje
             </label>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-3 col-sm-5">
        <div class="radio">
            <label>
                {!! Form::radio('banner_zone', 'right', ($banner->banner_zone == 'right')) !!}
                Baneris dešinėje
             </label>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-3 col-sm-5">
        {!! Form::submit('Išsaugoti', ['class' => 'btn btn-primary']) !!}
    </div>
</div>