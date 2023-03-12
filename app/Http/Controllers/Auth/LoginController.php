<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Throttle;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Cache\Repository as Cache;


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

    protected $cache;
    protected $maxAttempts = 1;
    protected $decayMinutes = 6;

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
    public function __construct(Request $request,Cache $cache)
    {   
        $this->cache = $cache;
        $this->middleware('guest')->except('logout');
        
    }

    protected function authenticated(Request $request, $user)
    {
        $this->cache->forget('decaySecondsKey');
    }


    public function decayMinutes()
    {   
        $value = $this->cache->get('decaySecondsKey');

        Log::error('Da cekas '. $value);
        if(!is_null($value)){
            return $value;
        }
        else{
            return $this->decayMinutes;
        }
    }

    protected function hasTooManyLoginAttempts(Request $request)
    {   
        
        if($this->limiter()->tooManyAttempts($this->throttleKey($request), $this->maxAttempts())){
            
            $value = $this->cache->get('decaySecondsKey');

            if ($value === null) {
                $this->cache->forever('decaySecondsKey', $this->decayMinutes);
            }else{
                $value = $this->cache->get('decaySecondsKey') + 2;
                $this->cache->put('decaySecondsKey', $value);
            }

            return true;

        }else{
            
            return false;
        }
    }
}