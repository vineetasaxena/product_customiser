<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class ColourCover extends Model
{
    /**
     * @var string
     */
    protected $table = 'resources_colours_covers';

    /**
     * @param  $collection
     * @param  $exclude
     * @param  $as_objects
     * @param  false         $effect
     * @return mixed
     */
    public static function getArrayByStyle($collection, $exclude = '', $as_objects = false, $effect = '')
    {
        // $colours =  ColourCover::where('collection', $collection)->get();

        $key = 'colors_covers::' . $collection . '::' . $exclude . '::' . $effect;

        if (!$as_objects)
        {

            $return = Cache::get($key, array()); // we ccache based on the url

            // echo $key . '<pre>' . print_r($return, true) . '</pre>';

            if (count($return))
            {
                return $return;
            }
        }

        $q = ColourCover::where('collection', $collection);

        if ($exclude != '')
        {
            $q->where('effect', '<>', $exclude);
        }

        if (strlen($effect))
        {
            $q->where('effect', $effect);
        }

        if ($as_objects)
        {
            return $q->get();
        }

        $colours = $q->get();

        $return_array = array();

        foreach ($colours as $colour)
        {
            $return_array[$colour->rgb] = $colour->name;
        }

        Cache::put($key, $return_array, 3000); // 20160229 pjc

        return $return_array;
        // echo '<pre>' . print_r($return_array, true) . '</pre>';exit;
    }

    /**
     * @param  $print_type
     * @param  $layer
     * @return mixed
     */
    public static function getCollections($print_type = '', $layer = '')
    {
        $return = array();

        $return['inks']     = 'Inks';
        $return['foils']    = 'Foils';
        $return['material'] = 'Materials';

        if (substr($layer, 0, 3) == 'art') // @TODO make into a real rule
        {
            $return          = array();
            $return['inks']  = 'Inks';
            $return['foils'] = 'Foils';
        }

        if ($print_type == 'Litho') // @TODO make into a real rule
        {
            $return         = array();
            $return['inks'] = 'Inks';
        }

        return $return;
    }

    /**
     * @return mixed
     */
    public static function getBurnishColors()
    {
        $burn_colours = array();

        return $burn_colours;
    }

    public function isBurnishColour()
    {
        // $uv_colours = ColourCover::getBurnishColors();

        if ($this->effect == 'Natural')
        {
            return true;
        }
        return false;
    }

    /**
     * @return mixed
     */
    /**
     * @return mixed
     */
    public static function getUvColours()
    {
        $uv_colours   = array();
        $uv_colours[] = '480 Matte Black';
        $uv_colours[] = '481 Matte Red';
        $uv_colours[] = '504 Blue Sage';
        $uv_colours[] = '511 Matte Blue';
        $uv_colours[] = '515 Mediterranean';
        $uv_colours[] = '449 Midnite';
        $uv_colours[] = '450 Charcoal';
        $uv_colours[] = '452 Cloud';
        $uv_colours[] = '453 Terra';
        $uv_colours[] = '490 Maroon';
        $uv_colours[] = '491 Smoke';
        $uv_colours[] = '492 Forest';
        $uv_colours[] = '493 Blue Shadow';
        $uv_colours[] = '495 Saddle';
        $uv_colours[] = '497 Firebrand';
        $uv_colours[] = '498 Laredo';
        $uv_colours[] = '499 Nighthawk';
        $uv_colours[] = '542 Soft Ivory';
        $uv_colours[] = '543 Indigo';
        $uv_colours[] = '544 Knockout Red';
        $uv_colours[] = '545 Mountain Pine';
        $uv_colours[] = '546 Ebony';
        $uv_colours[] = '446 Euphoria';
        $uv_colours[] = '447 Peacock';
        $uv_colours[] = '445 Eloquence';
        $uv_colours[] = '456 Aglow';
        $uv_colours[] = '470 Sunburst';
        $uv_colours[] = '472 Winsome';
        $uv_colours[] = '483 Mirth';
        $uv_colours[] = '486 Allure';
        $uv_colours[] = '856 Mello';
        $uv_colours[] = '857 Moonstone';
        $uv_colours[] = '858 Tumbleweed';
        $uv_colours[] = '859 Fern';
        $uv_colours[] = '860 Shadow';
        $uv_colours[] = '861 Wildflower';
        $uv_colours[] = '862 Firefly';

        return $uv_colours;
    }

    public static function getReducedOpacityColours()
    {
        $ret = array();

        $ret[] = '482 Spring Green';
        $ret[] = '487 Lime';
        $ret[] = '527 Yellow Gold';
        $ret[] = '534 White';
        $ret[] = '513 Gray';
        $ret[] = '528 Pearl';
        $ret[] = '537 Sage';
        $ret[] = '536 Light Blue';
        $ret[] = '504 Blue Sage';

        $ret[] = '491 Smoke';

        return $ret;
    }

    public function isUvColour()
    {
        $uv_colours = ColourCover::getUvColours();

        if (in_array($this->name, $uv_colours))
        {
            return true;
        }
        return false;
    }

    /**
     * @return mixed
     */
    public function getStrippedEffect()
    {

        $result = strtolower($this->effect);

        // strip all non word chars
        $result = preg_replace('/\W/', ' ', $result);

        // replace all white space sections with a dash
        $result = preg_replace('/\s+/', '_', $result);

        // trim dashes
        $result = preg_replace('/\-$/', '', $result);
        $result = preg_replace('/^\-/', '', $result);

        $result = preg_replace('/\_$/', '', $result);
        $result = preg_replace('/^\_/', '', $result);

        return $result; // alas we want to make it shorter
    }
}
