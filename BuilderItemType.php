<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BuilderItemType extends Model
{
	use SoftDeletes;
	
    public function builderItem()
    {
    	return $this->hasMany('App\BuilderItem', 'builder_item_type');
    }
}
