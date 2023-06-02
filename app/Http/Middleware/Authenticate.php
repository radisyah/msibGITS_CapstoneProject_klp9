<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Session;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if ($request->is('login') && !$request->is('logout')) {
                // Periksa apakah ada URL sebelumnya dalam session
                $previousUrl = Session::get('previous_url');
                if ($previousUrl) {
                    // Hapus session yang menyimpan URL sebelumnya
                    Session::forget('previous_url');

                    return redirect()->intended($previousUrl);
                }
            }
            return route('login');
        }
    }
}
