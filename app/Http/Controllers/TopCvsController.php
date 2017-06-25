<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 2017-05-06
 * Time: 17:21
 */

namespace App\Http\Controllers;

use App\Http\Requests\OrderTopCv;
use App\Http\Requests\SentTopCv;
use App\Cv;
use App\TopCvProfile;
use App\City;
use App\Gender;
use App\TopCvScope;
use App\TopCvLanguage;
use App\TopCvStudy;
use App\TopCvWork;

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

        if (!empty($filter['bases'][0])) {
            $cvs->ofBases($filter['bases']);
        }

        if (auth()->guest() || !auth()->user()->isAdminWorker()) {
            $scopes->pop();
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

    public function show(TopCvProfile $cv)
    {

        return view('topCvs.show', [
            'cv' => $cv,
            'withContacts' => (auth()->check() ? auth()->user()->isAdminWorker() : false)
        ]);
    }

    public function pdf(TopCvProfile $cv)
    {
        $genders = Gender::getGendersList(array());
        $cities = City::getCitiesList(array());
        $scopes = TopCvScope::getScopes(true);
        $cvLanguages = $cv->languages()->get();
        $cvStudies = $cv->studies()->get();
        $cvWorks = $cv->works()->get();

        return \PDF::loadView('topCvs.pdf', [
            'withContacts' => false,
            'cv' => $cv,
            'genders' => $genders,
            'cities' => array_slice($cities, 0, 5, true),
            'scopes' => $scopes,
            'languages' => TopCvLanguage::getLanguages(true),
            'languageLevels' => TopCvLanguage::getLevels(),
            'cvLanguages' => $cvLanguages,
            'cvStudies' => ($cvStudies->count() ? $cvStudies : [ new TopCvStudy ]),
            'cvWorks' => ($cvWorks->count() ? $cvWorks : [ new TopCvWork ]),
        ])->download('top_cv_'.$cv->id.'.pdf');
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

        return ['success' => 'Žinutė sėkmingai išsiųsta. Su Jumis netrukus susisieks <strong>Personalo akademijos</strong> atstovas.'];
    }

    public function sent()
    {
        return view('topCvs.sent');
    }

    public function postSent(SentTopCv $request)
    {
        $file = $request->file('cv_file');

        \Mail::send('emails.topCvs.send', [], function ($message) use ($file) {

            $message->to(config('mail.from.address'), config('mail.from.name'))
                ->subject('Top CV gavimas')
                ->attach($file, [
                    'as' => $file->getClientOriginalName()
                ]);

        });

        return redirect()->back()->with('success', true);
    }
}