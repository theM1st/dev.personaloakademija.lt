<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTopCv;
use App\Http\Requests\UpdateTopCv;
use App\City;
use App\Gender;
use App\TopCvScope;
use App\TopCvScopeCategory;
use App\TopCvLanguage;
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

        //$cvLanguages = TopCvProfile->languages()->get();

        $cvLanguages[0] = new TopCvLanguage;

        return view('admin.topCvs.create', [
            'genders' => $genders,
            'cities' => $cities,
            'scopes' => $scopes,
            'languages' => TopCvLanguage::getLanguages(true),
            'languageLevels' => TopCvLanguage::getLevels(),
            'cvLanguages' => $cvLanguages,
        ]);
    }

    public function store(StoreTopCv $request)
    {
        $cv = new TopCvProfile;
        $cv->fill($request->all());

        $location = route('topCvs.edit', $cv->id);

        if ($request->has('activate')) {
            $cv->active = 1;
            $location = route('topCvs.index');
        }

        $cv->save();

        return [ 'location' => $location ];
    }

    public function edit($id)
    {
        $cv = TopCvProfile::findOrFail($id);

        $genders = Gender::getGendersList(array());
        $cities = City::getCitiesList(array());
        $scopes = TopCvScope::getScopes(true);
        $cvLanguages = $cv->languages()->get();

        return view('admin.topCvs.edit', [
            'cv' => $cv,
            'genders' => $genders,
            'cities' => $cities,
            'scopes' => $scopes,
            'languages' => TopCvLanguage::getLanguages(true),
            'languageLevels' => TopCvLanguage::getLevels(),
            'cvLanguages' => $cvLanguages,
        ]);
    }

    public function update($id, UpdateTopCv $request)
    {
        $cv = TopCvProfile::findOrFail($id);
        $cv->fill($request->all());

        $location = route('topCvs.edit', $cv->id) . '?updated=1';

        if ($request->get('action') == 'activate' || $cv->active) {
            $cv->active = 1;
            $location = route('topCvs.index');
        }

        $cv->save();

        return [ 'location' => $location ];
    }
    
    public function removeLanguage($cvId, $id)
    {
        $cv = TopCvProfile::findOrFail($cvId);

        $cv->languages()->whereId($id)->delete();

        return back();
    }

    public function getScopeCategories()
    {
        $id = request()->get('id');

        $categories = TopCvScopeCategory::whereScopeId($id)->get();

        return $categories->pluck('name', 'id');
    }
}