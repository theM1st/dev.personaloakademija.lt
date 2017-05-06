<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CvComment;
use App\Cv;


class CvCommentsController extends Controller {

    public function index(Request $request)
    {
        $cv = Cv::findOrFail($request->get('cv'));

        $html = view('cvComments.index', ['cv' => $cv])->render();

        return ['html' => $html];
    }

    public function store(Request $request)
    {
        Cv::findOrFail($request->get('cv_id'));

        if ($request->get('comment') || $request->get('rating')) {

            $comment = new CvComment;

            $comment->user_id = \Auth::user()->id;
            $comment->cv_id = $request->get('cv_id');
            $comment->comment = $request->get('comment');
            $comment->rating = $request->get('rating');

            $comment->save();
        }

        return redirect()->route('cv_index');
    }

    public function destroy($id) {
        $comment = CvComment::findOrFail($id);

        $comment->comment = null;
        $comment->save();

        return redirect()->back();
    }
}
