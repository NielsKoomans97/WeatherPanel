<?php

namespace App\Http\Helpers;

class Weerplaza
{
    public static function GetRadarImaging(): array
    {
        $json = json_decode(file_get_contents('https://cluster.api.meteoplaza.com/v3/nowcast/tiles/radarnl-observations'));
        
        return $json;
    }
}
