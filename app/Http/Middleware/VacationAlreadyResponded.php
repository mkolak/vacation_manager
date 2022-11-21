<?php

namespace App\Http\Middleware;

use App\Models\VacationRequest;
use Closure;
use Illuminate\Http\Request;

class VacationAlreadyResponded
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $vacationRequest = $request->route('vacationRequest');
        if (auth()->user()->approver_role == "team_leader" && !is_null($vacationRequest->team_leader_status)) {
            return abort(500, 'Vacation request already responded');
        }

        if (auth()->user()->approver_role == "project_leader" && !is_null($vacationRequest->project_leader_status)) {
            return abort(500, 'Vacation request already responded');
        }
        return $next($request);
    }
}
