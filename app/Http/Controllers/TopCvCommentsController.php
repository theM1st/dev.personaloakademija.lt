<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TopCvProfile;
use App\TopCvComment;

class TopCvCommentsController extends Controller
{
    public function store($cvId, Request $request)
    {
        $cv = TopCvProfile::findOrFail($cvId);

        $cv->comments()->delete();

        $comment = new TopCvComment;

        $comment->user_id = auth()->user()->id;
        $comment->comment = $request->get('comment');

        $cv->comments()->save($comment);

        return back();
    }
}