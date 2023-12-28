<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response; //disable back button

class LoginRegisterController extends Controller
{
    /**
     * Instantiate a new LoginRegisterController instance.
     */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except([
    //         'logout', 'dashboard'
    //     ]);
    // }
    public function __construct()
{
    $this->middleware('auth')->only(['logout', 'dashboard']);
}


    /**
     * Display a registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('auth.register');
    }

    /**
     * Store a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('dashboard')
        ->withSuccess('You have successfully registered & logged in!');
    }

    /**
     * Display a login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Authenticate the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials))
        {
            //$request->session()->regenerate();
            return redirect()->route('dashboard')->withSuccess('You have successfully logged in!');
            //return view('auth.dashboard');
            //return redirect()->to('/employees');
            //return redirect()->action([EmployeeController::class, 'index']);
            //return redirect()->route("employees");
            //return redirect()->action('EmployeeController@index');
            //return redirect()->route('employees.index');

        }

        return back()->withErrors([
            'email' => 'Your provided credentials do not match in our records.',
            ])->onlyInput('email');

    } 
    
    /**
     * Display a dashboard to authenticated users.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        if(Auth::check())
        {
            return view('auth.dashboard');
            //return redirect()->action('EmployeeController@index');
            //return redirect()->to('/employees');
            //return redirect()->route("employees");
        }
        
        return redirect()->route('login')
            ->withErrors([
            'email' => 'Please login to access the dashboard.',
        ])->onlyInput('email');
    } 
    
    /**
     * Log out the user from application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // // Clear browser cache
        // $response = Response::make('Logout', 200);
        // $response->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        // $response->header('Pragma', 'no-cache');
        // $response->header('Expires', 'Thu, 19 Nov 1981 08:52:00 GMT');

        // return $response;
       
        //return redirect('login')->withSuccess('You have logged out successfully!');
        return redirect()->route('login')->withSuccess('You have logged out successfully!');
        //return view('auth.login');
    }    

}