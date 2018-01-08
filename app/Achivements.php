<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Achivements extends Model
{
    
	

	public function achivements_levels() {
        return $this->hasMany('App\achivements_level', 'achivements_id');
    }

}
