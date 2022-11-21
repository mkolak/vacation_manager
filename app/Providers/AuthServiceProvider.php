<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\VacationRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('vacation_cancel', function (User $user) {
            return $user->role === "employee";
        });
        Gate::define('vacation_respond', function (User $user, VacationRequest $vacation) {

            if ($user->role !== "approver") {
                return false;
            }

            if ($vacation->status !== "pending") {
                return false;
            }

            if ($user->approver_role == "team_leader" && !is_null($vacation->team_leader_status)) {
                return false;
            }

            if ($user->approver_role == "project_leader" && !is_null($vacation->project_leader_status)) {
                return false;
            }

            return true;
        });
        //
    }
}
