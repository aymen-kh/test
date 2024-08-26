<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SanitizeInput
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
     //   dd('SanitizeInput middleware running');
        $sanitizedData = $request->all();

        // Sanitize all string inputs
        foreach ($sanitizedData as $key => $value) {
            if (is_string($value)) {
                // Example sanitization: Convert special characters to HTML entities
                $sanitizedData[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
            }
        }

        $request->merge($sanitizedData);

        return $next($request);
    }
}
