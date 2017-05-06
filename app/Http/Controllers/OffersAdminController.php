<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateOfferRequest;
use App\Http\Requests\UpdateOfferRequest;
use App\City;
use App\WorkScope;
use App\Offer;
use App\OfferLogo;

class OffersAdminController extends Controller
{
    public function index()
    {
        Offer::updateOfferToInvalid();

        $filter = Offer::filter();

        $offers = Offer::getOffers($filter);
        $cities = City::getCitiesList(array());
        $scopes = WorkScope::getScopesList(false, true);

        return view('admin.offers.index', [
            'offers' => $offers,
            'cities' => $cities,
            'scopes' => $scopes,
            'filter' => $filter
        ]);
    }

    public function create()
    {
        $offer = new Offer();

        $cities = City::getCitiesList(array());
        $scopes = WorkScope::getScopesList(false);
        $durations = Offer::getDurationsList(array(null=>'Skelbimo trukmė'));

        return view('admin.offers.create', [
            'offer' => $offer,
            'cities' => $cities,
            'scopes' => $scopes,
            'durations' => $durations
        ]);
    }

    public function store(CreateOfferRequest $request)
    {
        $inputs = $request->all();

        $offer = new Offer($inputs);

        \Auth::user()->offers()->save($offer);

        $offer->scopes()->sync($inputs['scope_id']);
        $offer->cities()->sync($inputs['city_id']);

        if ($request->file('logo') && $request->file('logo')->isValid()) {
            $offer->uploadLogo($request->file('logo'));
        }

        return redirect()->action('OffersAdminController@index');
    }

    public function edit($id)
    {
        $offer = Offer::findOrFail($id);
        $cities = City::getCitiesList(array());
        $scopes = WorkScope::getScopesList(false);

        $durations = Offer::getDurationsList(array(null=>'Skelbimo trukmė'));

        return view('admin.offers.edit', [
            'offer' => $offer,
            'cities' => $cities,
            'scopes' => $scopes,
            'durations' => $durations,
        ]);
    }

    public function update($id, UpdateOfferRequest $request)
    {
        $offer = Offer::findOrFail($id);

        $inputs = $request->all();

        if ($request->file('logo') && $request->file('logo')->isValid()) {
            $offer->uploadLogo($request->file('logo'));
        }

        if (!isset($inputs['recruitment'])) {
            $inputs['recruitment'] = null;
        } elseif ($inputs['recruitment'] == 'soon') {
            $inputs['recruitment_days'] = null;
        }

        $offer->update($inputs);

        //$offer->scopes()->detach();
        $offer->scopes()->sync($inputs['scope_id']);
        $offer->cities()->sync($inputs['city_id']);

        return redirect()->action('OffersAdminController@index');
    }

    public function activate($id, Request $request)
    {
        $offer = Offer::findOrFail($id);

        if ($request->isMethod('post')) {
            $offer->offer_valid_from = \Carbon::now()->format('Y-m-d H:m:s');
            $offer->offer_duration = 30;
            $offer->active = 1;
            $offer->save();

            return redirect()->back();
        } else {
            return [
                'html' => view('admin.offers.activate', [
                    'title' => 'Ar tikrai norite aktyvuoti?',
                    'offer' => $offer,
                ])->render()
            ];
        }
    }

    public function deactivate($id, Request $request)
    {
        $offer = Offer::findOrFail($id);

        if ($request->isMethod('post')) {
            $offer->active = 0;
            $offer->save();

            return redirect()->back();
        } else {
            return [
                'html' => view('admin.offers.deactivate', [
                    'title' => 'Ar tikrai norite deaktyvuoti?',
                    'offer' => $offer,
                ])->render()
            ];
        }
    }

    public function archive($id)
    {
        $offer = Offer::findOrFail($id);

        $offer->archived = true;
        $offer->save();

        return redirect()->back();
    }

    public function deleteLogo($logoId)
    {
        $logo = OfferLogo::findOrFail($logoId);

        if ($logo) {
            $logo->delete();
        }

        return redirect()->back()->withInput();
    }

    public function delete($id)
    {
        $offer = Offer::findOrFail($id);

        return [
            'html' => view('admin.offers.delete', [
                'title' => 'Ar tikrai ištrinti?',
                'offer' => $offer,
            ])->render()
        ];
    }

    public function destroy($id)
    {
        $offer = Offer::findOrFail($id);

        $offer->delete();

        return redirect()->back();
    }
}