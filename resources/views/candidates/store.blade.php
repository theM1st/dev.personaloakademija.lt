<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Kandidatuoti</h4>
</div>
<div class="modal-body">
    @if (!empty($candidated))
        <div class="alert alert-danger">Jūs jau kandidatavote į šitą poziciją.</div>
    @elseif (!empty($errorScope))
        <div class="alert alert-info">
            <strong>Dėmesio!</strong> Kandidatuoti gali tik prisijungę vartotojai.<br>
            Prašom prisijungti naudojant savo prisijungimo duomenis arba užsiregistruoti kaip studentas arba absolventas.<br>
        </div>
    @elseif (!empty($noCv))
        <div class="alert alert-info">
            <strong>Dėmesio!</strong> Sukurkite arba užpildykite savo CV iki galo.
        </div>
    @else
        <div class="alert alert-info">CV sėkmingai išsiųstas darbdaviui.</div>
    @endif
</div>