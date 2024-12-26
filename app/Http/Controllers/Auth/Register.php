<?php

namespace App\Http\Controllers\Auth;

use App\Abstracts\Http\Controller;
use App\Http\Requests\Auth\Register as Request;
use App\Jobs\Auth\DeleteInvitation;
use App\Models\Auth\UserInvitation;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;

class Register extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the registration form for a given token.
     *
     * @param string $token
     * @return \Illuminate\View\View|\Illuminate\Http\Response
     */
    public function create($token)
    {
        $invitation = UserInvitation::token($token)->first();

        if ($invitation) {
            return view('auth.register.create', ['token' => $token]);
        }

        abort(403);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param \App\Http\Requests\Auth\Register $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Ensure the registration logic is correctly implemented
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        event(new Registered($user));

        $this->guard()->login($user);

        return redirect($this->redirectPath());
    }

    /**
     * The user has been registered.
     *
     * @param \Illuminate\Http\Request $request
     * @param mixed $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        $user->forceFill([
            'password' => $request->password,
            'remember_token' => Str::random(60),
        ])->save();

        $this->guard()->login($user);

        $message = trans('messages.success.connected', ['type' => trans_choice('general.users', 1)]);

        flash($message)->success();

        return response()->json([
            'redirect' => url($this->redirectPath()),
        ]);
    }
}