<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RealState extends Model
{
    //
    protected $table = 'real_state';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
