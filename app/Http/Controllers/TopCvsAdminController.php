<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTopCv;
use App\Http\Requests\UpdateTopCv;
use App\City;
use App\Gender;
use App\TopCvScope;
use App\TopCvScopeCategory;
use App\TopCvLanguage;
use App\TopCvStudy;
use App\TopCvWork;
use App\TopCvProfile;

class TopCvsAdminController extends Controller
{
    public function index()
    {
    }

    public function create()
    {
        $genders = Gender::getGendersList(array());
        $cities = City::getCitiesList(array());
        $scopes = TopCvScope::getScopes(true);

        $cvLanguages[0] = new TopCvLanguage;
        $cvStudies[0] = new TopCvStudy;
        $cvWorks[0] = new TopCvWork;

        return view('admin.topCvs.create', [
            'genders' => $genders,
            'cities' => array_slice($cities, 0, 5, true),
            'scopes' => $scopes,
            'languages' => TopCvLanguage::getLanguages(true),
            'languageLevels' => TopCvLanguage::getLevels(),
            'cvLanguages' => $cvLanguages,
            'cvStudies' => $cvStudies,
            'cvWorks' => $cvWorks,
        ]);
    }

    public function store(StoreTopCv $request)
    {
        $cv = new TopCvProfile;
        $cv->fill($request->all());



        if ($request->has('activate')) {
            $cv->active = 1;
        }

        $cv->save();

        $location = ($cv->active) ?
            $location = route('topCv.index') :
            $location = route('topCv.show', $cv->id);

        return [ 'location' => $location ];
    }

    public function edit($id)
    {
        $cv = TopCvProfile::findOrFail($id);

        $genders = Gender::getGendersList(array());
        $cities = City::getCitiesList(array());
        $scopes = TopCvScope::getScopes(true);
        $cvLanguages = $cv->languages()->get();
        $cvStudies = $cv->studies()->get();
        $cvWorks = $cv->works()->get();

        return view('admin.topCvs.edit', [
            'cv' => $cv,
            'genders' => $genders,
            'cities' => array_slice($cities, 0, 5, true),
            'scopes' => $scopes,
            'languages' => TopCvLanguage::getLanguages(true),
            'languageLevels' => TopCvLanguage::getLevels(),
            'cvLanguages' => $cvLanguages,
            'cvStudies' => ($cvStudies->count() ? $cvStudies : [ new TopCvStudy ]),
            'cvWorks' => ($cvWorks->count() ? $cvWorks : [ new TopCvWork ]),
        ]);
    }

    public function update($id, UpdateTopCv $request)
    {
        $cv = TopCvProfile::findOrFail($id);
        $cv->fill($request->all());

        $location = route('topCv.show', $cv->id) . '?updated=1';

        if ($request->get('action') == 'activate' || $cv->active) {
            $cv->active = 1;
            $location = route('topCv.index');
        }

        $cv->save();

        return [ 'location' => $location ];
    }

    public function removeStudy($cvId, $id)
    {
        $cv = TopCvProfile::findOrFail($cvId);

        $cv->studies()->whereId($id)->delete();

        return back();
    }

    public function removeLanguage($cvId, $id)
    {
        $cv = TopCvProfile::findOrFail($cvId);

        $cv->languages()->whereId($id)->delete();

        return back();
    }

    public function removeWork($cvId, $id)
    {
        $cv = TopCvProfile::findOrFail($cvId);

        $cv->works()->whereId($id)->delete();

        return back();
    }

    public function getScopeCategories()
    {
        $id = request()->get('id');

        $categories = TopCvScopeCategory::whereScopeId($id)->get();

        return $categories->pluck('name', 'id');
    }
}