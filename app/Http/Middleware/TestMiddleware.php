<?php


namespace App\Http\Middleware;


use Closure;

class TestMiddleware
{
    public function handle ($request, Closure $next)
    {
        if ($request->age <= 16 or !$request->age) {
            return redirect('/');

        }


        $response = $next ($request);
        return $response;
    }
}
