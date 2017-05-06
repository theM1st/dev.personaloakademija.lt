{!! Form::open(['class' => 'form-horizontal']) !!}
<div class="form-group">
    {!! Form::label('trial_salary', 'Atlyginimas bandomuoju laikotarpiu', ['class' => 'col-sm-4 control-label']) !!}
    <div class="col-sm-5">
        {!! Form::text('trial_salary', $data['trial_salary']->characteristic_name, ['class' => 'form-control input-sm', 'placeholder' => 'Įrašyti']) !!}
    </div>
</div>
<?php /*
@include('cv.partials.showDocuments')
 */ ?>
    <br>
    <div class="form-group">
        <div class="text-center">
            <button type="button" onclick="skipState('{{$cv->id}}', '{{$currentState}}')" class="btn btn-primary" style="margin-right:15px">
                Išsaugoti ir baigti CV pildymą
            </button>
            <button type="button" onclick="skipState('{{$cv->id}}', '{{$currentState}}')" class="btn btn-secondary">
                Praleisti ir baigti CV pildymą
            </button>
        </div>
    </div>
{!! Form::close() !!}