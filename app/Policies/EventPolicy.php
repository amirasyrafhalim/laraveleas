<?php

namespace App\Policies;

use App\User;
use App\Event;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any jobs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(?User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the job.
     *
     * @param  \App\User  $user
     * @param  \App\Job  $job
     * @return mixed
     */
    public function view(?User $user, ?Event $event)
    {
        return true;
    }

    /**
     * Determine whether the user can create jobs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(?User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the job.
     *
     * @param  \App\User  $user
     * @param  \App\Job  $job
     * @return mixed
     */
    public function update(User $user, Event $event)
    {
        if($event->user_id != $user->id) {
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can delete the job.
     *
     * @param  \App\User  $user
     * @param  \App\Job  $job
     * @return mixed
     */
    public function delete(User $user, Event $event)
    {
        if($event->user_id != $user->id) {
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can restore the job.
     *
     * @param  \App\User  $user
     * @param  \App\Job  $job
     * @return mixed
     */
    public function restore(User $user, Event $event)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the job.
     *
     * @param  \App\User  $user
     * @param  \App\Job  $job
     * @return mixed
     */
    public function forceDelete(User $user, Event $event)
    {
        return false;
    }
}
