<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $request->headers->set('Cross-Origin-Resource-Policy', 'same-origin');
        $request->headers->set('Cross-Origin-Opener-Policy', 'same-origin');
        $request->headers->set('X-Permitted-Cross-Domain-Policies', 'none');
        $request->headers->set('X-Download-Options', 'noopen');
        $request->headers->set('X-Powered-By', 'WizardCompass');
        $request->headers->set('Server', 'WizardServer');

        return $next($request);
    }
}
