<?php

namespace App\Http\Middleware;

use App\Models\School;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureSchoolIsSet
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return $next($request);
        }

        if ($user->hasRole('admin')) {
            return $next($request);
        }

        if ($user->school_id) {
            return $next($request);
        }

        $school = School::where('user_id', $user->id)->first();

        if ($school) {
            $user->forceFill(['school_id' => $school->id])->save();
            return $next($request);
        }

        return redirect()->route('user.school.setup')
            ->with('warning', 'Tafadhali kamilisha usajili: jaza taarifa za shule yako kabla ya kuendelea kutumia dashboard.');
    }
}
