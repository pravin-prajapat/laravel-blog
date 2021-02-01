<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ['title', 'description', 'tags', 'image', 'createdBy'];

    public function users(){
    	return $this->hasOne('\App\User','id','createdBy');
    }
}
