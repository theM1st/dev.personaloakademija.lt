<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdateUserPassword;
use App\User;
use App\Offer;

class UsersController extends Controller
{
    public function profile($id=null)
    {
        if ($id && \Auth::user()->isAdmin()) {
            $user = User::findOrFail($id);
        } else {
            $user = \Auth::user();
        }

        return view('users.profile', ['user' => $user]);
    }

    public function update($id, UpdateUserRequest $request)
    {
        $user = User::findOrFail($id);

        if (\Auth::user()->isAdmin()) {
            $inputs = $request->all();
        } else {
            $inputs = $request->except('email');
        }

        $success = 1;

        if ($request->get('sendPassword')) {
            $password = str_random(8);
            $inputs['password'] = bcrypt($password);
            $inputs['user_status'] = 1;

            \Mail::send('emails.registration', ['email' => $user->email, 'password' => $password, 'firstname' => $user->firstname], function ($message) use ($user) {
                $message->to($user->email, $user->firstname)->subject('Sveiki atvykę į svetainę');
            });

            $success = 'sentPassword';
        }

        $user->update($inputs);

        return redirect()->back()->with('success', $success);
    }

    public function changePassword($id, UpdateUserPassword $request)
    {
        $user = User::findOrFail($id);

        if (!$user->editable()) {
            abort(404);
        }

        $password = $request->get('password');
        if($password) {
            $user->password = bcrypt($password);
            $user->save();
        }

        return redirect()->back()->with('success', true);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        return [
            'html' => view('users.delete', [
                'title' => 'Ar tikrai ištrinti?',
                'user' => $user,
            ])->render()
        ];
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        Offer::where('user_id', $user->id)->delete();
        User::where('company_id', $user->id)->delete();

        $user->cv()->delete();
        if ($user->cv) {
            $user->cv->studies()->delete();
            $user->cv->practices()->delete();
            $user->cv->works()->delete();
            $user->cv->experiences()->delete();
            $user->cv->languages()->delete();
            $user->cv->characteristics()->delete();
            $user->cv->interests()->delete();
            $user->cv->socactivities()->delete();
            $user->cv->participations()->delete();
            $user->cv->recomendations()->delete();
        }

        if (\Auth::user()->isAdmin()) {
            return redirect()->action('CompaniesController@index');
        } else {
            \Auth::logout();

            return redirect('/');
        }

        \Auth::logout();

        return redirect('/');
    }
}
