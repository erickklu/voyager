<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Traits\Resizable;
use TCG\Voyager\Traits\Translatable;
use Carbon\Carbon;
use TCG\Voyager\Models\User;
use TCG\Voyager\Models\Category;

class Publicacione extends Model
{
    use Translatable;
    use Resizable;

    protected $translatable = ['titulo', 'descripcion', 'categoria_id'];

    public function save(array $options = [])
    {
        // If no author has been assigned, assign the current user's id as the author of the publication
        if (!$this->author_id && Auth::user()) {
            $this->author_id = Auth::user()->getKey();
        }

        return parent::save();
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function usuariosInteresados()
    {
        return $this->belongsToMany(User::class, 'intereses', 'publicacion_id', 'user_id');
    }

    public function getFormattedDateAttribute()
    {
        $updatedAt = Carbon::parse($this->updated_at);
        $now = Carbon::now();
        $diffInDays = $updatedAt->diffInDays($now);

        if ($diffInDays > 7) {
            return $updatedAt->locale('es')->isoFormat('[Actualizado el] D [de] MMMM [de] YYYY');
        } else {
            return $updatedAt->locale('es')->diffForHumans();
        }
    }
    public function categoria()
    {
        return $this->belongsTo(Category::class);
    }

}
