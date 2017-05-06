@include('errors.list')
<div class="row form-group">
    <label for="language" class="col-sm-2 control-label" style="margin-top:6px">Pasiūlymo kalba</label>
    <div class="col-sm-4">
        {!! Form::select('language', \App\Offer::$languages, $offer->language, ['id' => 'language', 'class' => 'form-control input-sm']) !!}
    </div>
</div>
<div class="row form-group">
    <div class="col-sm-3">
        @if (old('city_id'))
            {!! Form::select(null, $cities, old('city_id'), ['id' => 'city_id', 'class' => 'form-control input-sm multiselect select-cities', 'multiple'=>'multiple']) !!}
        @else
            {!! Form::select(null, $cities, $offer->cities()->pluck('id')->toArray(), ['id' => 'city_id', 'class' => 'form-control input-sm multiselect select-cities', 'multiple'=>'multiple']) !!}
        @endif
    </div>
    <div class="col-sm-6">
        @if (old('scope_id'))
            {!! Form::select(null, $scopes, old('scope_id'), ['id' => 'scope_id', 'class' => 'form-control input-sm multiselect select-scopes', 'multiple'=>'multiple']) !!}
        @else
            {!! Form::select(null, $scopes, $offer->scopes()->pluck('id')->toArray(), ['id' => 'scope_id', 'class' => 'form-control input-sm multiselect select-scopes', 'multiple'=>'multiple']) !!}
        @endif
    </div>
    <div class="col-sm-3">
        @if (isset($durations))
            {!! Form::select('offer_duration', $durations, $offer->offer_duration, ['class' => 'form-control input-sm']) !!}
        @endif
    </div>
</div>
<div class="row form-group">
    <div class="col-sm-12">
        {!! Form::text('work_position', $offer->work_position, ['class' => 'form-control input-sm', 'placeholder' => 'Pareigų pavadinimas (įrašyti)']) !!}
    </div>

</div>
<div class="row form-group">
    <div class="col-sm-8">
        {!! Form::label('company_name', 'Įmonės pavadinimas', ['class' => '']) !!}
        {!! Form::text('company_name', $offer->company_name, ['class' => 'form-control input-sm']) !!}
    </div>
    <div class="col-sm-4">
        <div class="checkbox" style="margin-top:20px">
            <label>
                {!! Form::hidden('show_company_info', 0) !!}
                {!! Form::checkbox('show_company_info', 1, ($offer->show_company_info || is_null($offer->show_company_info))) !!}
                Rodyti įmonės informaciją
            </label>
        </div>
    </div>
</div>
<div class="row form-group">
    <div class="col-sm-8">
        {!! Form::label('company_description', 'Įmonės veiklos aprašymas', ['class' => '']) !!}
        {!! Form::textarea('company_description', $offer->company_description, ['class' => 'form-control input-sm', 'rows' => 3]) !!}
    </div>
    <div class="col-sm-4">
        {!! Form::label('logo', 'Logotipas (gif, jpg, png)', ['class' => 'control-label']) !!}
        @if ($offer->logo)
            <div class="row">
                <div class="col-sm-5">
                    <img src="{{$offer->logo->relativeLogoSm}}" alt="logo">
                </div>
                <div class="col-sm-5 text-center">
                    <a href="{{action('OffersAdminController@deleteLogo', ['logoId' => $offer->logo->id])}}" onclick="return confirm('Ar tikrai trinti logotipą?');" style="color:#c20606;font-weight: bold">
                        Trinti logotipą
                    </a>
                </div>
            </div>
            {!! Form::hidden('logo_id', $offer->logo->id) !!}
        @else
            <div class="clearfix">
                <div class="btn btn-sm btn-default pull-left upload-button" data-name="logo" style="padding: 5px 30px;">Įkelti</div>
                <div id="logo-filename" class="btn btn-sm pull-left" style="cursor: default">Logotipas neįkeltas</div>
            </div>
            {!! Form::file('logo') !!}
        @endif
    </div>
</div>
<div class="row form-group">
    <div class="col-sm-6">
    <label for="offer_description">{{ trans('offers.job_content') }}</label>
    {!! Form::textarea('offer_description', $offer->offer_description, ['class' => 'form-control input-sm', 'rows' => 3]) !!}
    </div>
    <div class="col-sm-6">
        <label for="offer_requirements">{{ trans('offers.requirements') }}</label>
        {!! Form::textarea('offer_requirements', $offer->offer_requirements, ['class' => 'form-control input-sm', 'rows' => 3]) !!}
    </div>
</div>
<div class="row form-group">
    <div class="col-sm-6">
    {!! Form::label('offer_skills', trans('offers.useful_skills_knowledge'), ['class' => '']) !!}
    {!! Form::textarea('offer_skills', $offer->offer_skills, ['class' => 'form-control input-sm', 'rows' => 3]) !!}
    </div>
    <div class="col-sm-6">
    {!! Form::label('company_offers', trans('offers.companys_offer_for_work'), ['class' => '']) !!}
    {!! Form::textarea('company_offers', $offer->company_offers, ['class' => 'form-control input-sm', 'rows' => 3]) !!}
    </div>
</div>

<div class="row form-group">
    <div class="col-sm-3">
        {{ trans('offers.start_of_work') }}:
    </div>
    <div class="col-sm-2 text-nowrap">
        <label title="Bus priskirta prie Karštų darbo pasiūlymų" style="margin:0">
            <img src="{{asset('assets/img/hot.png')}}" style="margin: -5px 2px 0 0;">
            {!! Form::radio('recruitment', 'soon', ($offer->recruitment == 'soon')) !!}
            {{ trans('offers.asap') }}
        </label>
    </div>
    <div class="col-sm-2 text-right">
        <label style="margin:0">
            {!! Form::radio('recruitment', '', (!$offer->recruitment && $offer->recruitment_days)) !!}
            per {!! Form::text('recruitment_days', $offer->recruitment_days, ['class' => 'form-control input-xs', 'style' => 'width:35%;display:inline', 'maxlength'=>2, 'placeholder' => '__']) !!} d.
        </label>
    </div>
    <div class="col-sm-5">
        Siūlomas atlyginimas EUR: nuo
        {!! Form::text('salary_from', $offer->salary_from, ['class' => 'form-control input-xs', 'style' => 'width:16%;display:inline', 'placeholder' => '____']) !!}
        iki
        {!! Form::text('salary_to', $offer->salary_to, ['class' => 'form-control input-xs', 'style' => 'width:16%;display:inline', 'placeholder' => '____']) !!}
    </div>
</div>
<div class="row form-group">
    <div class="col-sm-4">
        <label>
            {!! Form::checkbox('confidentiality', 1, ($offer->confidentiality || is_null($offer->confidentiality))) !!}
            {{ trans('offers.confidentiality_guaranteed') }}
        </label>
    </div>
</div>
<div class="row form-group">
    <div class="col-sm-3">
        <a href="{{action('OffersController@preview')}}" class="btn btn-primary action-modal" data-form="#offer-form">
            Peržiūrėti pasiūlymą
        </a>
    </div>
    <div class="col-sm-3">
        {!! Form::submit('Išsaugoti', ['class' => 'btn btn-secondary']) !!}
    </div>
    <div class="col-sm-4">
        <a href="{{action('OffersAdminController@index')}}" class="btn btn-link">
            {{ trans('offers.back_to_job_ads_list') }}
        </a>
    </div>
</div>
@if ($offer->id)
    {!! Form::hidden('id', $offer->id) !!}
@endif

@section('scripts')
<script src="{{ asset('/js/jquery.elastic.source.js') }}"></script>
<script type="text/javascript">
    $().ready(function() {
        var radioButtons = $("input[type='radio'][name='recruitment']");
        var radioStates = {};
        $.each(radioButtons, function(index, rd) {
            radioStates[rd.value] = $(rd).is(':checked');
        });

        radioButtons.click(function() {

            var val = $(this).val();
            $(this).attr('checked', (radioStates[val] = !radioStates[val]));

            $.each(radioButtons, function(index, rd) {
                if(rd.value !== val) {
                    radioStates[rd.value] = false;
                }
            });
        });

        $('textarea').elastic();

        $('.select-cities').multiselect('setOptions', {
            nSelectedText: ' miestai pažymėti',
            nonSelectedText: 'Pasirenkami miestai',
            checkboxName: 'city_id[]',
            onChange: msOnChange
        });

        $('.select-cities').multiselect('rebuild');

        $('.select-scopes').multiselect('setOptions', {
            nSelectedText: ' sritys pažymėtos',
            nonSelectedText: 'Profesijų sritys',
            checkboxName: 'scope_id[]',
            onChange: msOnChange

        });
        $('.select-scopes').multiselect('rebuild');
    });
</script>

@endsection