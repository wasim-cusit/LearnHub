<?php

namespace App\Policies;

use App\Models\LearningTask;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LearningTaskPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, LearningTask $learningTask): bool
    {
        return $user->id === $learningTask->user_id || $user->isTeacher();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, LearningTask $learningTask): bool
    {
        return $user->id === $learningTask->user_id || $user->isTeacher();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, LearningTask $learningTask): bool
    {
        return $user->id === $learningTask->user_id || $user->isTeacher();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, LearningTask $learningTask): bool
    {
        return $user->id === $learningTask->user_id || $user->isTeacher();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, LearningTask $learningTask): bool
    {
        return $user->id === $learningTask->user_id || $user->isTeacher();
    }
}
