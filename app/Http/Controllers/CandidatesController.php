<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Candidate;
use App\Offer;
use Illuminate\Support\Str;

class CandidatesController extends Controller
{
    public function index($offerId)
    {
        $offer = Offer::findOrFail($offerId);

        return view('candidates.index', ['offer' => $offer]);
    }

    public function apply($offerId)
    {
        $offer = Offer::findOrFail($offerId);

        return view('candidates.apply', ['offer' => $offer]);
    }

    public function postApply($offerId, Request $request)
    {
        $offer = Offer::findOrFail($offerId);

        if ($request->hasFile('cvFile')) {

            $file = $request->file('cvFile');

            \Mail::send('emails.applyCandidate', ['offer' => $offer], function ($message) use ($offer, $file) {
                $message->to(config('mail.from.address'))
                    ->subject('Naujas kandidatas į „' . $offer->work_position . '“ darbo pasiūlymo skelbimą')
                    ->attachData(file_get_contents($file->path()), $file->getClientOriginalName(), [
                        'mime' => $file->getMimeType(),
                    ]);
            });

            return redirect()->route('offers_show', $offerId)->with('success', 'CV sėkmingai išsiųstas darbdaviui!');
        }

        return redirect()->back();
    }

    public function store($offerId, Request $request)
    {
        $offer = Offer::findOrFail($offerId);

        $viewParams = array();

        if (!\Auth::user()->cv || \Auth::user()->cv->state != 0) {
            $viewParams['noCv'] = true;
            return redirect()->route('offers_show', $offerId)->with('info', '<strong>Dėmesio!</strong> Sukurkite arba užpildykite savo CV iki galo.');
        } else {
            $candidate = Candidate::firstOrNew(array('offer_id' => $offer->id, 'cv_id' => \Auth::user()->cv->id));

            if ($candidate->id == null || $candidate->updated_at->diffInDays() > 30) {
                $candidate->save();
                return redirect()->route('offers_show', $offerId)->with('success', 'CV sėkmingai išsiųstas darbdaviui.');
            } else {
                return redirect()->route('offers_show', $offerId)->with('danger', 'Jūs jau kandidatavote į šitą poziciją.');
            }
        }
    }

    public function destroy($id, $token)
    {
        if ($token !== md5('candidate'.$id)) {
            abort(404);
        }

        $candidate = Candidate::findOrFail($id);

        if (\Auth::user()->id == $candidate->offer->user_id) {
            $candidate->delete();
        }

        return redirect()->back();
    }

    public function destroyAll(Request $request)
    {
        if (is_array($request->candidate)) {
            Candidate::destroy($request->candidate);

            return redirect()->back();
        }
    }

    public function setRating($id, $rating=0)
    {
        $candidate = Candidate::findOrFail($id);

        if (\Auth::user()->id == $candidate->offer->user_id) {
            $candidate->rating = $rating;
            $candidate->save();
        }
    }

    public function setComment($id, $comment='')
    {
        $comment = trim($comment);
        $candidate = Candidate::findOrFail($id);

        if (\Auth::user()->id == $candidate->offer->user_id) {
            $candidate->comment = $comment;
            $candidate->save();

            return ['comment' => Str::limit($comment, 100)];
        }
    }
}