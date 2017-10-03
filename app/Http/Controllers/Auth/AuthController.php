<?php

namespace ProyectoKpi\Http\Controllers\Auth;

use Illuminate\Http\Request;
use ProyectoKpi\Cms\Clases\Conexion_LDAP;
use ProyectoKpi\User;
use Validator;
use Illuminate\Support\Facades\Auth;

use ProyectoKpi\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


use Adldap\Contracts\AdldapInterface;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    // protected $redirectTo = '/home';
    protected $username = 'name';

    /**
     * @var Adldap
     */
    protected $adldap;


    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(AdldapInterface $adldap)
    {
        $this->middleware($this->guestMiddleware(), ['except' => [ 'logout','getLogout']]);
        $this->adldap = $adldap;
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        if (property_exists($this, 'redirectPath')) {
            return $this->redirectPath;
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/';
    }



    public function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->loginUsername() => 'required', 'password' => 'required',
        ]);
    }


//    public function login(Request $request)
//    {
//        $con = new Conexion_LDAP();
//
//        /* obtnemos los parametros del formualario*/
//        $data = [
//            'username' => \Request::input('name'),
//            'password' => \Request::input('password')
//        ];
//
//        $result = $con->login_ldap($data['username'], $data['password']);
//
//        if ($data['username'] !== 'admin')
//        {
//            // todo: corregir esta validacion de login por AD
//            if (is_string($result)) {
//                /* obtnemos los parametros del formualario*/
//                $request->request->set('password', '12345678');
//            } else {
//                $request->request->set('password', 'dfadfjfah!"#43SDF#$');
//            }
//        }
//
//        $this->validateLogin($request);
//
//
//        // If the class is using the ThrottlesLogins trait, we can automatically throttle
//        // the login attempts for this application. We'll key this by the username and
//        // the IP address of the client making these requests into this application.
//        $throttles = $this->isUsingThrottlesLoginsTrait();
//
//        if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
//            $this->fireLockoutEvent($request);
//
//            return $this->sendLockoutResponse($request);
//        }
//
//        $credentials = $this->getCredentials($request);
//
//        if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {
//            return $this->handleUserWasAuthenticated($request, $throttles);
//        }
//
//        // If the login attempt was unsuccessful we will increment the number of attempts
//        // to login and redirect the user back to the login form. Of course, when this
//        // user surpasses their maximum number of attempts they will get locked out.
//        if ($throttles && ! $lockedOut) {
//            $this->incrementLoginAttempts($request);
//        }
//
//        return $this->sendFailedLoginResponse($request);
//    }

}
