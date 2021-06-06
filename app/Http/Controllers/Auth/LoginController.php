<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\RecoverPasswordRequest;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application form login.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('login');
    }

    /**
     * Show the application form reset.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginFormReset()
    {
        return view('reset');
    }

    /**
     * Show the application form recover.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginFormRecover()
    {
        return view('recover');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function login(Request $request)
    {

        $user = User::where('Usuario', $request->user)->where('Pass', $request->password)->first();
        if ($user) {
            $user = Auth::login($user);
            return response()->json(['success' => true, 'message' => 'Iniciando la sesión, redireccionando...', 'url' => 'dashboard'], 200);
        }else {
            return response()->json(['error' => true,  'message' => 'Accceso no autorizado, Credenciales no existen.'], 401);
        }
    }

    /**
     * Handle an destroy authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function logout()
    {
        Auth::logout();
        return response()->json(['success' => true, 'message' => 'Sesión cerrada correctamente, redireccionando...', 'url' => 'login'], 200);
    }

    /**
     *the application send code mail reset password.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function resetPassword(Request $request)
    {
        $credentials = $request->only('email');
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if ($user->status) {
                if ($user->role=='administer') {
                    $user->code = rand(1111, 9999);
                    $user->save();
                    $send = Mail::send('mails.mail-reset', ['user' => $user], function ($message) use ($user) {
                        $message->to($user->email)->subject("Cambio de clave");
                    });
                    return response()->json(['success' => true, 'message' => 'le hemos enviado un código de 4 digitos a su correo, para recuperar su clave de usuario'], 200);
                }else {
                    return response()->json(['error' => true,  'message' => 'Accceso no autorizado, el email ingresado no esta disponible.'], 401);
                }
            }else {
                return response()->json(['error' => true,  'message' => 'El Usuario se encuentra inactivo.'], 401);
            }
        }else {
            return response()->json(['error' => true,  'message' => 'El email no existe.'], 401);
        }
    }

    /**
     *the application recover password updated.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function recoverPassword(RecoverPasswordRequest $request)
    {
        if ($request->input('code')=="0") {
            return response()->json(['success' => false,  'message' => 'El código ingresado es incorrecto, por favor verifique.'], 200);
        } else {
            $user = User::where('email', $request->input('email'))->where('code', $request->input('code'))->first();
            if (!$user) {
                return response()->json(['success' => false,  'message' => 'El código o email ingresado es incorrecto, por favor verifique.'], 200);
            } else {
                $user->password = bcrypt($request->input('password'));
                $user->code = 0;
                $user->save();
                Auth::login($user);
                return response()->json(['success' => true, 'message' => 'Clave de usuario actualizada correctamente. Redireccionando...', 'url' => 'dashboard'], 200);
            }
        }
    }
}
