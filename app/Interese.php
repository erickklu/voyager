<?php

namespace App;
use TCG\Voyager\Models\User;
use Illuminate\Database\Eloquent\Model;


class Interese extends Model
{
    protected $fillable = [
        'user_id', 'publicacion_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function publicacion()
    {
        return $this->belongsTo(Publicacione::class);
    }
}
