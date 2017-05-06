<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Siųsti laišką</h4>
</div>
<div class="modal-body">
    {!! Form::open(['action'=>['CvController@sendMail', $cv->id], 'class'=>'ajax-form']) !!}
        <div class="form-group">
            {!! Form::label('message', 'Žinutė', ['class' => '']) !!}
            {!! Form::textarea('message', null, ['class' => 'form-control', 'rows' => 5]) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Siųsti laišką', ['class' => 'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}
</div>