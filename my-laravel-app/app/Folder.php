<?php

//モデルファイル

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
	public function tasks()
	{
		//hasMany
		return $this->hasMany('App\Task');
	}
}
