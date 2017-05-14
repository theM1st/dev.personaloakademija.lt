<?php

namespace App\Providers;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\User;
use App\Offer;
use App\Candidate;
use App\Banner;
use App\Page;
use App\TopCvProfile;
use App\TopCvLanguage;
use App\TopCvStudy;
use App\TopCvWork;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
        ],
    ];

	/**
	 * Register any events for your application.
	 *
	 * @return void
	 */
	public function boot()
	{
		parent::boot();

        User::creating(function($user) {
        });

        User::created(function($user) {
        });

        Candidate::created(function($candidate) {
            $admins = User::workersadmins()->get();

            foreach ($admins as $a) {
                \Mail::send('emails.candidate', ['user' => \Auth::user(), 'offer' => $candidate->offer], function ($message) use ($a) {
                    $message->to($a->email)->subject('cv.personaloakademija.lt gautas naujo kandidato CV.');
                });
            }
        });

        Offer::updating(function($offer) {
            
        });

        Banner::updated(function($banner) {
            \Cache::forget('leftBanners');
            \Cache::forget('rightBanners');
        });

        Banner::created(function($banner) {
            \Cache::forget('leftBanners');
            \Cache::forget('rightBanners');
        });

        Banner::deleted(function($banner) {
            \Cache::forget('leftBanners');
            \Cache::forget('rightBanners');
        });

        Page::saving(function($page) {
            $page->slug_lt = str_slug($page->title_lt);
            $page->slug_en = str_slug($page->title_en);
            $page->slug_ru = str_slug($page->title_ru);
        });

        TopCvProfile::saved(function($cv) {
            $cv->languages()->delete();
            $cv->studies()->delete();
            $cv->works()->delete();

            $foreignLanguages = request()->get('foreign_language_id');

            if (request()->get('first_language_id')) {
                $language = new TopCvLanguage;
                $language->first_language_id = request()->get('first_language_id');
                if (isset($foreignLanguages[0])) {
                    $language->foreign_language_id = $foreignLanguages[0];
                    $language->speaking_level = request()->get('speaking_level')[0];
                    $language->writing_level = request()->get('writing_level')[0];
                    unset($foreignLanguages[0]);
                }
                $cv->languages()->save($language);
            }

            if (count($foreignLanguages)) {
                foreach ($foreignLanguages as $k => $id) {
                    $language = new TopCvLanguage;
                    $language->foreign_language_id = $id;
                    $language->speaking_level = request()->get('speaking_level')[$k];
                    $language->writing_level = request()->get('writing_level')[$k];
                    $cv->languages()->save($language);
                }
            }

            if ($institutions = request()->get('institution')) {
                foreach ($institutions as $k => $name) {
                    if ($name) {
                        $study = new TopCvStudy;
                        $study->institution = $name;
                        $study->study_date = request()->get('study_date')[$k];
                        $study->specialty = request()->get('specialty')[$k];
                        $cv->studies()->save($study);
                    }
                }
            }

            if ($workplaces = request()->get('workplace')) {
                foreach ($workplaces as $k => $name) {
                    if ($name) {
                        $work = new TopCvWork;
                        $work->workplace = $name;
                        $work->work_date = request()->get('work_date')[$k];
                        $work->work_position = request()->get('work_position')[$k];
                        $work->work_task = request()->get('work_task')[$k];
                        $cv->works()->save($work);
                    }
                }
            }
        });
	}

}
