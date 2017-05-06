<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\UpdateOfferRequest;
use App\City;
use App\WorkScope;
use App\OfferLogo;
use App\Offer;

class OffersController extends Controller
{
    public function index()
    {
        $filter = Offer::filter();

        $offers = Offer::getValidOffers($filter);

        $cities = City::getCitiesList(array());
        $scopes = WorkScope::getScopesList(false, true);

        return view('offers.index', [
            'offers' => $offers,
            'cities' => $cities,
            'scopes' => $scopes,
            'filter' => $filter
        ]);
    }

    public function show($id)
    {
        $offer = Offer::findOrFail($id);

        if ($offer->language == 'en') {
            \App::setLocale('en');
        }

        return view('offers.show', [
            'offer' => $offer,
        ]);
    }

    public function preview(UpdateOfferRequest $request)
    {
        $inputs = $request->all();

        $offer = new Offer($inputs);
        $offer->user = \Auth::user();

        $logo = null;
        if ($request->file('logo') && $request->file('logo')->isValid()) {
            $logo = OfferLogo::getBase64Logo($request->file('logo'));
        }

        $cities = City::getCitiesList(array());
        $_cities = array();
        if (!empty($inputs['city_id'])) {
            foreach ($inputs['city_id'] as $cId) {
                if (isset($cities[$cId])) {
                    $_cities[] = $cities[$cId];
                }
            }
        }

        if ($offer->language == 'en') {
            \App::setLocale('en');
        }

        $html = view('offers.preview', [
            'offer' => $offer,
            'logo' => $logo,
            'cities' => $_cities,
            'inputs' => $inputs,
        ])->render();

        return ['html' => $html];
    }
}