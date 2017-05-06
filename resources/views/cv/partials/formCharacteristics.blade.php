@include('errors.list')
{!! Form::open(['class' => 'form-horizontal']) !!}
    <div class="form-group">
        {!! Form::label('characteristic_name', 'Asmeninės savybės', ['class' => 'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
            {!! Form::textarea('characteristic_name', $data['characteristics']->characteristic_name, ['rows' => '3', 'class' => 'form-control input-sm', 'placeholder' => 'Įrašyti (neprivaloma, bet rekomenduojama)']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('interest_name', 'Laisvalaikis ir pomėgiai', ['class' => 'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
            {!! Form::textarea('interest_name', $data['interests']->interest_name, ['rows' => '3', 'class' => 'form-control input-sm', 'placeholder' => 'Įrašyti (neprivaloma, bet rekomenduojama)']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('socactivity_name', 'Visuomeninė veikla', ['class' => 'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
            {!! Form::textarea('socactivity_name', $data['socactivities']->socactivity_name, ['rows' => '3', 'class' => 'form-control input-sm', 'placeholder' => 'Įrašyti (neprivaloma, bet rekomenduojama)']) !!}
        </div>
    </div>
    <br>
    <div class="form-group">
        <div class="col-sm-offset-4 col-sm-5">
            <div class="row">
                <div class="col-sm-6">
                    {!! Form::submit('Išsaugoti ir toliau', ['class' => 'btn btn-primary btn-sm']) !!}
                </div>
                <div class="col-sm-6">
                    {!! Form::button('Praleisti ir toliau', ['class' => 'btn btn-secondary btn-sm', 'onclick'=>"skipState($cv->id, $currentState)"]) !!}
                </div>
            </div>
        </div>
    </div>
    {!! Form::hidden('characteristic_id', $data['characteristics']->id) !!}
    {!! Form::hidden('interest_id', $data['interests']->id) !!}
    {!! Form::hidden('socactivity_id', $data['socactivities']->id) !!}
{!! Form::close() !!}