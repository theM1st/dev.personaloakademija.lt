<br>
<div class="alert alert-info" role="alert">
    Jūsų CV sėkmingai užpildytas. Paspauskite mygtuką <strong>Įkelti mano CV</strong>, kad galutinai patalpinti CV sistemoje.
</div>
{!! Form::open(['class' => 'form-horizontal']) !!}

    <p class="text-center">
        {!! Form::submit('Įkelti mano CV', ['class' => 'btn btn-primary btn-sm', 'style' => 'width:auto;margin-right: 20px']) !!}

        <a href="{{action('CvController@preview', ['id' => $cv->id])}}" class="btn btn-secondary btn-sm action-modal" data-method="get" style="width: auto">
            Peržiūrėti CV
        </a>
    </p>

{!! Form::close() !!}