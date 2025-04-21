<?php

namespace App\Policies;

use App\Models\Job;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class JobPolicy // related to elequent model
{
    /**
     * Edit a new policy instance.
     */
    public function edit(User $user, Job $job): bool
    {   // REmove gate logic from appServiceProvider.php and paste here and edit routes with edit-job gate which is deleted now

        return $job->employer->user->is($user); // check even if you are not logged in 

    }
}
