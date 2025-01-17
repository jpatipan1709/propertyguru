<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Projects;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(Request $request)
    {
        $field = filter_var($request->get($this->username()), FILTER_VALIDATE_EMAIL)
            ? $this->username()
            : 'email';

        return [
            $field => $request->get($this->username()),
            'password' => $request->password,
        ];
    }

    public function showLoginForm()
    {
        $projects = Projects::all();
        $data = array(
            'projects' => $projects,
        );
        return view('backoffice.index',$data);
    }

    // protected function formlogin(Request $request){
    //     $projects = Projects::all();
    //     $data = array(
    //         'projects' => $projects,
    //     );
    //     return view('backoffice.index',$data);
    // }
}
