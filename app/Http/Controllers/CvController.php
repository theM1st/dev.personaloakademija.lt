<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateCvRequest;
use App\Http\Requests\UpdateCvRequest;
use App\Http\Requests\CreateCvFileRequest;
use App\Gender;
use App\City;
use App\Cv;
use App\CvPhoto;
use App\CvDocument;
use App\CvItKnowledge;
use App\WorkScope;
use App\CvStudy;
use App\InstitutionCategory;
use App\CvExtraInfo;

class CvController extends Controller
{
    public function index()
    {
        $filter = Cv::filter();
        $cvs = Cv::getValidCvs($filter);

        $cities = City::getCitiesList(array());
        $scopes = WorkScope::getScopesList(false);
        $institutions = InstitutionCategory::getGroupedList(array());
        $courses = CvStudy::getFilterCourses();

        return view('cv.index', ['cvs' => $cvs,
            'total' => Cv::valid()->count(),
            'cities' => $cities,
            'scopes' => $scopes,
            'institutions' => $institutions,
            'courses' => $courses,
            'filter' => $filter]);
    }

    public function create()
    {
        $cv = \Auth::user()->cv()->first();

        if ($cv) {
            return redirect()->route('cv_edit', [$cv->id]);
        }

        $genders = Gender::getGendersList();
        $cities = City::getCitiesList();
        $statuses = Cv::getStatusesList();

        $cv = new Cv;
        $cv->name = \Auth::user()->name;
        $cv->email = \Auth::user()->email;
        $cv->telephone = \Auth::user()->telephone;

        return view('cv.create', [
            'cv' => $cv,
            'genders' => $genders,
            'cities' => $cities,
            'statuses' => $statuses,
            'state' => 1,
            'states' => CV::$cvStates
        ]);
    }

    public function store(CreateCvRequest $request)
    {
        $cv = new Cv();

        \Auth::user()->cv()->save($cv);

        $cv->saveCv($cv, $request);

        return redirect()->route('cv_edit', [$cv->id, 2]);
    }

    public function edit($id)
    {
        $cv = Cv::getUserCv($id);

        $html = $cv->stateHandle();

        return view('cv.edit', [
            'html' => $html,
            'cv' => $cv,
            'states' => $cv->getStates(),
            'currentState' => $cv->currentState(),
        ]);
    }

    public function update(UpdateCvRequest $request, $id, $state=1)
    {
        $cv = Cv::getUserCv($id);

        if (!$cv) {
            abort(404);
        }

        $status = $cv->updateCv($request);

        if ($request->get('state')) {
            $nextState = $request->get('state');
        } else {
            $nextState = $cv->nextState();
        }

        if ($request->ajax())  {
            if ($cv->state == 0)
                return ['id' => $status, 'url' => route('cv_show', [$cv->id, '#section'.$state])];
            else
                return ['id' => $status, 'url' => route('cv_edit', [$cv->id, $nextState])];
        }

        if ($cv->state == 0)
            return redirect()->route('cv_show', [$cv->id, 'updated']);
        else
            return redirect()->route('cv_edit', [$cv->id, $nextState, '#section'.$nextState]);
    }

    public function show($id)
    {
        $cv = Cv::getUserCv($id, 0);

        $studies = $cv->studies()->get();
        $practices = $cv->practices()->get();
        $works = $cv->works()->get();
        $experiences = $cv->experiences()->get();
        $languages = $cv->languages()->get();
        $itknowledges = CvItKnowledge::groupedItems($cv);
        $characteristics = $cv->characteristics()->get();
        $interests = $cv->interests()->get();
        $socactivities = $cv->socactivities()->get();
        $participations = $cv->participations()->get();
        $recomendations = $cv->recomendations()->get();
        $extrainfos = $cv->extrainfos()->get();
        $documents = $cv->documents;

        return view('cv.show', [
            'cv' => $cv,
            'states' => Cv::$cvStates,
            'studies' => $studies,
            'practices' => $practices,
            'works' => $works,
            'experiences' => $experiences,
            'languages' => $languages,
            'itknowledges' => $itknowledges,
            'characteristics' => $characteristics,
            'interests' => $interests,
            'socactivities' => $socactivities,
            'participations' => $participations,
            'recomendations' => $recomendations,
            'extrainfos' => $extrainfos,
            'drivingLicenses' => CvExtraInfo::getDrivingLicenses(),
            'documents' => $documents,
            'updated' => request()->get('updated'),
        ]);
    }

    public function preview($id)
    {
        if (!\Request::ajax()) {
            $cv = CV::where('state', 0)->findOrFail($id);
        } else {
            $cv = Cv::getUserCv($id);
        }

        $studies = $cv->studies()->get();
        $practices = $cv->practices()->get();
        $works = $cv->works()->get();
        $experiences = $cv->experiences()->get();
        $languages = $cv->languages()->get();
        $itknowledges = CvItKnowledge::groupedItems($cv);
        $characteristics = $cv->characteristics()->notEmpty()->get();
        $interests = $cv->interests()->notEmpty()->get();
        $socactivities = $cv->socactivities()->notEmpty()->get();
        $participations = $cv->participations()->get();
        $recomendations = $cv->recomendations()->get();
        $extrainfos = $cv->extrainfos()->get();
        $documents = $cv->documents;

        $viewData = [
            'cv' => $cv,
            'states' => Cv::$cvStates,
            'studies' => $studies,
            'practices' => $practices,
            'works' => $works,
            'experiences' => $experiences,
            'languages' => $languages,
            'itknowledges' => $itknowledges,
            'characteristics' => $characteristics,
            'interests' => $interests,
            'socactivities' => $socactivities,
            'participations' => $participations,
            'recomendations' => $recomendations,
            'extrainfos' => $extrainfos,
            'drivingLicenses' => CvExtraInfo::getDrivingLicenses(),
            'documents' => $documents,
        ];

        if (!\Request::ajax()) {
            if (request()->get('format') == 'pdf') {
                return \PDF::loadView('cv.partials.pdf', $viewData)->download('cv'.$cv->id.'.pdf');
            }

            return view('cv.cv', $viewData);
        }

        return ['html' => view('cv.preview', $viewData)->render()];
    }

    public function skipState($cvId, $currentState)
    {
        $cv = Cv::findOrFail($cvId);

        $nextState = $cv->nextState();

        if ($cv->state != 0) {
            $cv->state = ($nextState - 1);
            $cv->save();

            return ['url' => route('cv_edit', [$cv->id, $nextState, '#section'.$nextState])];
        }

        return ['url' => route('cv_edit', [$cv->id, $nextState, '#section'.$nextState])];
    }

    public function deletePhoto($cvId)
    {
        $cv = Cv::getUserCv($cvId);

        $photo = new CvPhoto($cv);
        $photo->delete();

        $cv->photo = '';
        $cv->save();

        return redirect()->back();
    }

    public function sendMail(Request $request, $cvId)
    {
        $cv = Cv::findOrFail($cvId);

		$error = $success = null;
		
        if ($request->message !== null) {
			if (trim($request->message) == "") {
				$error = 'Parašykite žinutę';
			} else {
				\Mail::send('emails.cvSendMail', ['msg' => $request->message], function($message) use ($cv)
				{
					$message->to($cv->email)->subject('Pranešimas iš svetainės "Okaycv.lt"');
				});
				
				$success = 'Žinutė sėkmingai išsiųsta!';
			}
        }

        $html = view('cv.sendMail', ['cv' => $cv])->render();

        return ['html' => $html, 'error' => $error, 'success' => $success];
    }

    public function saveDocument(CreateCvFileRequest $request, $cvId)
    {
        $cv = Cv::findOrFail($cvId);

        $document = new CvDocument($cv);
        $document->upload($request->file('cv_document'));

        return redirect(\URL::previous() . '#section10')->withInput();
    }

    public function deleteDocument($id)
    {
        $document = CvDocument::findOrFail($id);
        $document->delete();

        return redirect(\URL::previous() . '#section10')->withInput();
    }

    public function activate($id, $token)
    {
        $cv = Cv::findOrFail($id);

        if ($cv->token === $token) {
            $cv->active = 1;
            $cv->save();
        }

        return redirect()->action('AdminController@items', ['cv' => 1]);
    }

    public function saveComment($id, Request $request)
    {
        $cv = Cv::findOrFail($id);

        $cv->cv_comment = $request->get('cv_comment');
        $cv->cv_comment_date = date('Y-m-d');
        $cv->cv_rating = $request->get('cv_rating');
        $cv->save();

        return redirect()->route('company_index');
    }

    public function delete($id)
    {
        $cv = Cv::getUserCv($id);

        return [
            'html' => view('cv.delete', [
                'title' => 'Ar tikrai ištrinti?',
                'cv' => $cv,
            ])->render()
        ];
    }

    public function destroy($id)
    {
        $cv = Cv::getUserCv($id);

        $cv->delete();

        return redirect('/');
    }
}
