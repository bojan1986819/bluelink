<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTeam extends Model
{
    public function users()
    {
        return $this->belongsTo('App\User');
    }
}
