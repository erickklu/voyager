<?php

namespace App\Policies;

use TCG\Voyager\Models\User;

use App\Publicacione;
use Illuminate\Auth\Access\HandlesAuthorization;

class PublicacionePolicy
{
    use HandlesAuthorization;

    public function update(User $user, Publicacione $publicacione)
    {
        return $user->id === $publicacione->author_id;
    }

    public function delete(User $user, Publicacione $publicacione)
    {
        return $user->id === $publicacione->author_id;
    }
}
