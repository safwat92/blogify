<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\UploadFileTrait;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    use UploadFileTrait;
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'profile' => ['image' ,'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'gender' => ['required', 'in:male,female,other'],
            'birth_date' => ['required', 'date', 'before:today'],
        ]);

       $path = $this->uploadFile($request, 'profile' , 'users');

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'full_name' => $request->first_name . " " . $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_image' => $path ?? null,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('blog', absolute: false));
    }
}
