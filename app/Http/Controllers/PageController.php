<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Page;

class PageController extends Controller
{
    public function index()
    {
        $requestForm = $this->requestForm();
        $contactForm = $this->contactForm();

        $page = Page::where('main_page', 1)->first();
		
		if ($page->link) {
			return redirect()->to($page->link);
		}

        return view('pages.show', [
            'page' => $page,
            'requestForm' => $requestForm,
            'contactForm' => $contactForm,
        ]);
    }

    public function show(Page $page)
    {
        $requestForm = $this->requestForm();
        $contactForm = $this->contactForm();

        return view('pages.show', [
            'page' => $page,
            'requestForm' => $requestForm,
            'contactForm' => $contactForm,
        ]);
    }

    public function postRequestForm(Request $request)
    {
        $this->validate($request, [
            'rf_name' => 'required',
            'rf_position' => 'required',
            'rf_company' => 'required',
            'rf_telephone' => 'required',
            'rf_email' => 'required',
            'rf_question_theme' => 'required',
            'rf_question' => 'required',
        ]);

        Mail::send('emails.requestForm', [
            'data' => $request->except('_token'),
        ], function ($message) {

            $message->to(config('mail.from.address'), config('mail.from.name'))
                ->subject('Užklausos forma');

        });

        return redirect()->back()->with('success', true);
    }

    public function postContactForm(Request $request)
    {
        $this->validate($request, [
            'cf_name' => 'required',
            'cf_email' => 'required',
            'cf_question_theme' => 'required',
            'cf_question' => 'required',
        ]);

        Mail::send('emails.contactForm', [
            'data' => $request->except('_token'),
        ], function ($message) {

            $message->to(config('mail.from.address'), config('mail.from.name'))
                ->subject('Kontaktų forma');

        });

        return redirect()->back()->with('success', true);
    }

    protected function requestForm()
    {
        return view('pages.requestForm')->render();
    }

    protected function contactForm()
    {
        return view('pages.contactForm')->render();
    }
}