<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuesLoginQuestion extends Model
{
    protected $guarded = [];

    public function input_options()
    {
        return $this->hasMany('App\Models\QuesLoginOption','fieldid','id');
    }
}
