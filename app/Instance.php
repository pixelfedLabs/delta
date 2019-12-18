<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instance extends Model
{
	protected $fillable = ['name','domain'];

    public $timestamps = ['approved_at'];

   	protected $hidden = [
   		'created_at',
   		'updated_at',
   		'team_id',
   		'user_id'
   	];

    public function getNodeinfoAttribute($val) {
    	return json_decode($val, true);
    }
}
