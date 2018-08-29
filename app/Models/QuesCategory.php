<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuesCategory extends Model
{
    protected $table = 'ques_categorys';
    //
    protected  $guarded = [];
    public function login_questions()
    {
        return $this->hasMany('App\Models\QuesLoginQuestion','catid','id');
    }
    public function invest_questions()
    {
        return $this->hasMany('App\Models\QuesInvestQuestion','catid','id');
    }
    public function user(){
        return $this->belongsTo('App\Models\QuesAdmin','author','id');
    }
}
