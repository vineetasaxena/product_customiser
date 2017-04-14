<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BuilderItem extends Model
{
	use SoftDeletes;

	/**
	 * @return mixed
	 */
	public function builderItemType()
	{
		return $this->belongsTo('App\BuilderItemType', 'builder_item_type_id');
	}

	/**
	 * @return mixed
	 */
	public function user()
	{
		return $this->belongsTo('App\User', 'user_id');
	}

	/**
	 * @return mixed
	 */
	public function school()
	{
		return $this->belongsTo('App\School', 'school_id');
	}

}
