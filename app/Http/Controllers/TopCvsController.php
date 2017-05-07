<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 2017-05-06
 * Time: 17:21
 */

namespace App\Http\Controllers;

use App\Cv;
use App\TopCvProfile;
use App\City;

class TopCvsController extends Controller
{
    public function index()
    {
        $filter = Cv::filter();

        $cities = City::getCitiesList(array());

        $cvs = TopCvProfile::active();

        if (!empty($filter['cities'][0])) {
            $cvs->ofCities($filter['cities']);
        }

        $cvs = $cvs->latest()
            ->paginate(20);

        return view('topCvs.index', [
            'cvs' => $cvs,
            'filter' => $filter,
            'cities' => array_slice($cities, 0, 5, true),
        ]);
    }

    public function show($id)
    {
        $cv = TopCvProfile::findOrFail($id);

        return view('topCvs.show', [
            'cv' => $cv
        ]);
    }
}