<?php

namespace App\Policies;

use App\User;
use App\Piece;
use Illuminate\Auth\Access\HandlesAuthorization;

class PiecePolicy
{
    use HandlesAuthorization;

    public function before($user)
    {
        if($user->hasRole('Admin'))
        {
           return true;
        }      
    }

    /**
     * Determine whether the user can view the piece.
     *
     * @param  \App\User  $user
     * @param  \App\Piece  $piece
     * @return mixed
     */
    public function view(User $user, Piece $piece)
    {
        return $user->id === $piece->user_id || $user->hasPermissionTo('View pieces');
    }

    /**
     * Determine whether the user can create pieces.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('Create pieces');
    }

    /**
     * Determine whether the user can update the piece.
     *
     * @param  \App\User  $user
     * @param  \App\Piece  $piece
     * @return mixed
     */
    public function update(User $user, Piece $piece)
    {
        return $user->id === $piece->user_id || $user->hasPermissionTo('Update pieces');
    }

    /**
     * Determine whether the user can delete the piece.
     *
     * @param  \App\User  $user
     * @param  \App\Piece  $piece
     * @return mixed
     */
    public function delete(User $user, Piece $piece)
    {
        return $user->id === $piece->user_id || $user->hasPermissionTo('Delete pieces');
    }

    /**
     * Determine whether the user can restore the piece.
     *
     * @param  \App\User  $user
     * @param  \App\Piece  $piece
     * @return mixed
     */
    public function restore(User $user, Piece $piece)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the piece.
     *
     * @param  \App\User  $user
     * @param  \App\Piece  $piece
     * @return mixed
     */
    public function forceDelete(User $user, Piece $piece)
    {
        //
    }
}
