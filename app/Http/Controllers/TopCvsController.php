<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 2017-05-06
 * Time: 17:21
 */

namespace App\Http\Controllers;

use App\Http\Requests\OrderTopCv;
use App\Cv;
use App\TopCvProfile;
use App\City;
use App\Gender;
use App\TopCvScope;

class TopCvsController extends Controller
{
    public function index()
    {
        $filter = Cv::filter();

        $genders = Gender::getGendersList([]);
        $cities = City::getCitiesList([]);
        $scopes = TopCvScope::with('categories')->get();

        $cvs = TopCvProfile::active();

        if (!empty($filter['cities'][0])) {
            $cvs->ofCities($filter['cities']);
        }

        if (!empty($filter['ageFrom']) || !empty($filter['ageTo'])) {
            $cvs->ofAge($filter['ageFrom'], $filter['ageTo']);
        }

        if (!empty($filter['scopes'][0])) {
            $cvs->ofScopes($filter['scopes']);
        }

        if (!empty($filter['tags'])) {
            $cvs->ofTag($filter['tags']);
        }

        $cvs = $cvs->latest()
            ->paginate(20);

        return view('topCvs.index', [
            'cvs' => $cvs,
            'filter' => $filter,
            'genders' => $genders,
            'scopes' => $scopes,
            'cities' => array_slice($cities, 0, 5, true),
        ]);
    }

    public function show($id)
    {
        $cv = TopCvProfile::active()->findOrFail($id);

        return view('topCvs.show', [
            'cv' => $cv
        ]);
    }

    public function addBookmark(TopCvProfile $cv)
    {
        if (!auth()->user()->bookmarks->contains($cv->id)) {
            auth()->user()->bookmarks()->attach([$cv->id]);
        } else {
            auth()->user()->bookmarks()->detach([$cv->id]);
        }


        return back();
    }

    public function order(OrderTopCv $request)
    {
        \Mail::send('emails.topCvOrderForm', [
            'data' => $request->all(),
        ], function ($message) {

            $message->to(config('mail.from.address'), config('mail.from.name'))
                ->subject('Tinkamų kandidatų užklausos forma');

        });

        return ['success' => 'Žinutė sėkmingai išsiųsta!'];
    }
}