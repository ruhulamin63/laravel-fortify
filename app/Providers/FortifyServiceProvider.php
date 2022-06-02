<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Fortify\Http\Responses\LoginResponse;
use Laravel\Fortify\Http\Responses\LogoutResponse;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //=========new write============
//        $this->app->instance(LoginResponse::class, new class implements \Laravel\Fortify\Contracts\LoginResponse {
//            public function toResponse($request)
//            {
//                if (Auth::check() && Auth::user()->active==1 && Auth::user()->role_id==1){
//                    return view('freelancer.dashboard',compact('request'));
//                }
//            }
//        });

        $this->app->instance(RegisterResponse::class,new class implements RegisterResponse {
            public function toResponse( $request ) {
                dd($request);
            }
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //==========new write===============
//        Fortify::authenticateUsing(function (Request $request) {
//
//            $user = User::where('user_name', $request->user_name)->first();
//            if ($user && Hash::check($request->password, $user->password)) {
//
//                if ($user->active){
//                    if ($user->role_id==1){
//                        Session::put('user_role', 'freelancer');
//                        return $user;
//                    }
//                }
//            }
//        });
        //======================end write=====================

        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        //===============New Write==========
        Fortify::loginView(function () {
            Artisan::call('cache:clear');
            return view('auth.login');
        });

        Fortify::registerView(function () {
            return view('auth.register');
        });

        Fortify::requestPasswordResetLinkView(function () {
            return view('auth.forgot-password');
        });

        Fortify::resetPasswordView(function ($request) {
            return view('auth.reset-password', ['request' => $request]);
        });

        Fortify::verifyEmailView(function () {
            return view('auth.verify-email');
        });

        Fortify::confirmPasswordView(function (){
            return view('auth.password-confirm');
        });

        Fortify::twoFactorChallengeView(function (){
            return view('auth.two-factor-challenge');
        });


//        $this->app->instance(LogoutResponse::class, new class extends LogoutResponse {
//            public function toResponse($request)
//            {
//                return redirect('/login');
//            }
//        });

        //added by Mehrab. Custom logout after registration.
        $this->app->singleton(
            RegisterResponse::class,
            \App\Http\Responses\RegisterResponse::class,
        );

    }
}
