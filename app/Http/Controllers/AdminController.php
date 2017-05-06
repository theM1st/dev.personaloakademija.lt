<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offer;
use App\Cv;
use App\User;
use App\Http\Requests\CreateWorkerRequest;
use App\Http\Requests\UpdateWorkerRequest;


class AdminController extends Controller
{
    public function index() {
        return view('admin.index', []);
    }

    public function workers(Request $request)
    {

        return view('admin.workers', ['workers' => User::workers()->get()]);
    }

    public function workerEdit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.workers', ['worker' => $user, 'workers' => User::workers()->get()]);
    }

    public function workerStore(CreateWorkerRequest $request)
    {
        $user = new User;

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->user_role = 'worker';
        $user->password = bcrypt($request->get('password'));

        $user->save();

        return redirect()->back();
    }

    public function workerUpdate($id, UpdateWorkerRequest $request)
    {
        $user = User::findOrFail($id);

        $user->name = $request->get('name');
        $user->email = $request->get('email');

        if ($request->get('password')) {
            $user->password = bcrypt($request->get('password'));
        }

        $user->save();

        return redirect()->action('AdminController@workers');
    }

    public function workerDestroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->action('AdminController@workers');
    }

    public function companies(Request $request)
    {
        //\DB::connection()->enableQueryLog();
        $companies = User::companies()->orderBy('users.company_name')->paginate();


        //$query = \DB::getQueryLog();
        //dd($query);

        return view('admin.companies', ['companies' => $companies, 'request' => $request]);
    }

    public function waitingCompanies(Request $request)
    {
        $companies = User::companies()->where('u.user_status', 0)->orderBy('users.company_name')->paginate();

        return view('admin.waitingCompanies', ['companies' => $companies, 'request' => $request]);
    }
}
