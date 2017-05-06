@include('errors.list')
<div class="row">
    <div class="col-sm-offset-1 col-sm-10">
    {!! Form::open(['class' => 'form-horizontal']) !!}
        <div class="form-group">
            {!! Form::label('cv_name', 'Jūsų CV pavadinimas/ antraštė', ['class' => '']) !!}
            {!! Form::text('cv_name', $cv->cv_name, ['class' => 'form-control input-sm', 'placeholder' => 'Parašykite pavadinimą, į kurį darbdavys tikrai atkreips dėmesį']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('description', 'Trumpas prisistatymas', ['class' => '']) !!}
            {!! Form::textarea('description', $cv->description, ['rows' => '3', 'class' => 'form-control input-sm', 'placeholder' => 'Personalo akademija rekomenduoja Jums parašyti 2-3 sakinius apie save, savo  tikslus ir lūkesčius']) !!}
        </div>
        <?php /*
        <div class="form-group">
            {!! Form::label('cv_tag', '2-3 žodžiai, susiję su jūsų profesiją, kompetencijomis, tikslais, pomėgiais', ['class' => '']) !!}
            {!! Form::text('cv_tag', $cv->cv_tag, ['class' => 'form-control input-sm', 'placeholder' => 'Rinkodara, reklama, vokiečių kalba (įrašyti savo)']) !!}
        </div>
        */ ?>
        <br>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
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
    {!! Form::close() !!}
    </div>
</div>