<div class="show-offer">
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {!! Session::get('success') !!}
        </div>
    @elseif (Session::has('danger'))
        <div class="alert alert-danger" role="alert">
            {!! Session::get('danger') !!}
        </div>
    @elseif (Session::has('info'))
        <div class="alert alert-info" role="alert">
            {!! Session::get('info') !!}
        </div>
    @endif
    @if ($offer->show_company_info)
        <div class="well clearfix">
            @if ($offer->logo)
                <div class="offer-company-logo">
                    <img src="{{$offer->logo->relativeLogoMd}}" alt="logo">
                </div>
            @elseif (isset($logo))
                <div class="offer-company-logo">
                    <img src="{{$logo}}" alt="logo">
                </div>
            @endif
            <div class="offer-company-name">
                {{$offer->company_name}}
            </div>
            <div class="offer-company-description">
                {!! nl2br(strip_tags($offer->company_description)) !!}
            </div>
        </div>
    @endif
    <div class="offer-name">
        <h1>
            {{$offer->work_position}}
            @if (!empty($cities))
                <span>({{ implode(', ', $cities) }})</span>
            @else
                <span>({{ $offer->cities()->pluck('name_'.Lang::locale())->implode(', ') }})</span>
            @endif
        </h1>
    </div>
    <div class="offer-valid">
        {{ trans('offers.job_ad_is_valid') }}
        {{ trans('offers.since') }} {{$offer->offer_valid_from->format('Y-m-d')}}
        {{ trans('offers.till') }} {{$offer->offer_valid_until->format('Y-m-d')}}
    </div>
    <div class="row">
        <div class="col-sm-12">
            @if ($offer->offer_description)
                <div class="offer-row offer-description">
                    <label>{{ trans('offers.job_content') }}:</label>
                    {!! nl2br(strip_tags($offer->offer_description)) !!}
                </div>
            @endif
            @if ($offer->offer_requirements)
                <div class="offer-row offer-requirements">
                    <label>{{ trans('offers.requirements') }}:</label>
                    {!! nl2br(strip_tags($offer->offer_requirements)) !!}
                </div>
            @endif
            @if ($offer->offer_skills)
                <div class="offer-row offer-skills">
                    <label>{{ trans('offers.useful_skills_knowledge') }}:</label>
                    {!! nl2br(strip_tags($offer->offer_skills)) !!}
                </div>
            @endif
            @if ($offer->company_offers)
                <div class="offer-row company-offers">
                    <label>{{ trans('offers.companys_offer_for_work') }}:</label>
                    {!! nl2br(strip_tags($offer->company_offers)) !!}
                </div>
            @endif
            @if ($offer->recruitment == 'soon')
                <p>
                    {{ trans('offers.start_of_work') }}: <b>{{ trans('offers.asap') }}</b>
                </p>
            @endif
            @if ($offer->recruitment == 'days' && $offer->recruitment_days)
                <p>{{ trans('offers.start_of_work') }}: per <b>{{$offer->recruitment_days}} d.</b></p>
            @endif
            @if ($offer->salary_from || $offer->salary_to)
                <p>
                    Siūlomas atlyginimas nuo EUR (neto) <b>{{$offer->salary_from or 0}}</b> iki <b>{{$offer->salary_to or 0}}</b>
                </p>
            @endif
            @if ($offer->confidentiality)
                <p><b>{{ trans('offers.confidentiality_guaranteed') }}</b></p>
            @endif
        </div>
    </div>
    @if (isset($type) && $type == 'preview')
        <button class="btn btn-grey" aria-label="Close" data-dismiss="modal" type="button">Redaguoti</button>
    @else
        <a href="{{action('CandidatesController@apply', $offer->id)}}" class="btn btn-secondary">
            {{ trans('offers.apply_now') }}
        </a>
    @endif
    <a href="{{ URL::previous() }}" class="btn btn-primary">{{ trans('offers.back_to_job_ads_list') }}</a>

    @if (\Auth::check() && \Auth::user()->isAdminWorker())
        {!! Html::linkAction('OffersAdminController@edit', 'Redaguoti pasiūlymą', ['id' => $offer->id], ['class' => "btn btn-grey"]) !!}
    @endif
</div>