<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAccountType
{
    public function handle(Request $request, Closure $next, string $accountType): Response
    {
        if (Auth::check() && auth()->user()->account_type?->value === $accountType) {
            return $next($request);
        }

        return redirect()->route('home');
    }
}
