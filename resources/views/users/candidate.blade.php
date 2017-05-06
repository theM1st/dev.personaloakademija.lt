<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Kandidatuoti</h4>
</div>
<div class="modal-body">
    @if (!\Auth::user() || \Auth::user()->user_type == 'company')
        <div class="alert alert-info">
            <strong>Dėmesio!</strong> Kandidatuoti gali tik prisijungę <u>studentai</u> arba <u>absolventai</u>.<br>
            Prašom prisijungti naudojant savo prisijungimo duomenis arba užsiregistruoti kaip studentas arba absolventas.<br>
        </div>
    @elseif (\Auth::user()->cv->state != 0)
        <div class="alert alert-info">
            <strong>Dėmesio!</strong> Užpildykite savo cv iki galo.
        </div>
    @else
        <div class="alert alert-info">CV sėkmingai išsiųstas darbdaviui.</div>
    @endif
</div>