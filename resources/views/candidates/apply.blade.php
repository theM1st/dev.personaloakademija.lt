@extends('app')

@section('title', "Kandidatuoti $offer->work_position -")

@section('content')
    <div class="show-offer">
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

        <div class="row">
            <div class="col-sm-6 text-right">
                {!! Form::open(['action' => ['CandidatesController@postApply', $offer->id], 'files' => true]) !!}
                    <h3 style="font-size:20px">Greitas kandidatavimas</h3>
                    <div style="height:110px">
                        <p>Įkelkite savo turimą CV ir spauskite Kandidatuoti
                            (registracija nereikalinga)
                        </p>
                        <div class="btn btn-sm btn-default upload-button" data-name="cvFile" style="width: 150px">Įkelti mano CV</div>
                        <div id="cvFile-filename" class="btn btn-sm" style="display:block;cursor: default;text-align:right"></div>
                        {!! Form::file('cvFile') !!}
                    </div>
                    <div>
                        <button class="btn btn-primary" style="width: 150px">{{ trans('offers.apply_now') }}</button>
                    </div>
                {!! Form::close() !!}
            </div>
            <div class="col-sm-6 text-left">
                <h3 style="font-size:20px">Kandidatavimas</h3>
                <div style="height:110px">
                    Rekomenduojama registruoti savo CV (trunka apie 5&nbsp;min.)
                    arba prisijungti su savo vartotojo duomenimis.
                </div>
                <div>
                    @if (\Auth::check())
                        <a href="{{action('CandidatesController@store', $offer->id)}}" class="btn btn-secondary" style="width: 150px">
                            {{ trans('offers.apply_now') }}
                        </a>
                    @else
                        <a href="{{action('CandidatesController@store', $offer->id)}}" class="btn btn-secondary" data-size="modal-md" style="width: 150px">
                            {{ trans('offers.apply_now') }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection