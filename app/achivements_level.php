<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class achivements_level extends Model
{
    public $timestamps = false;
	protected $table = 'achivements_level';

	public function achivements() {	

		return $this->belongsTo('App\Achivements');
	}


}
