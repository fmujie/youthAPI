<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaceRec extends Model
{
    protected $table = 'face_rec';
    protected $guarded = ['id'];
    
    public function oayouthuser() {
        return $this->hasOne('App\Models\OaYouthUser','sdut_id','user_id');
    }
}
