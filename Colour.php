<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Colour extends Model
{
	//
	//
	//
	/**
	 * @var string
	 */
	protected $table = 'resources_colours';

	public function yeha()
	{
		return "yehaha";
	}

	/**
	 * @param  $collection
	 * @return mixed
	 */
	public static function getArrayByStyle($collection)
	{

		$key = 'colors::' . $collection;

		$return = Cache::get($key, array()); // we ccache based on the url

		if (count($return))
		{
			return $return;
		}

		$colours = Colour::where('collection', $collection)->get();

		$return_array = array();

		foreach ($colours as $colour)
		{
			$return_array[$colour->rgb] = $colour->name;
		}

		Cache::put($key, $return_array, 3000);

		return $return_array;
		// echo '<pre>' . print_r($return_array, true) . '</pre>';exit;
	}

	/**
	 * @param $collection
	 * @param $rgb
	 */
	public static function getColourName($collection, $rgb)
	{
		return Colour::where('collection', $collection)->where('rgb', strtoupper($rgb))->first();
	}
}
