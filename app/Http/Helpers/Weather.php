<?php

namespace App\Http\Helpers;

use stdClass;

class Weather
{
    public function __construct() {}

    public static function getBuienradarWarnings(): array
    {
        $json = json_decode(file_get_contents('https://data.buienradar.nl/1.0/announcements/apps'));
        $locations = $json->warnings->locations;

        $activeWarnings = [];
        foreach ($locations as $location) {
            if (!empty($location->alerts)) {
                $activeWarnings[] = $location;
            }
        }

        return $activeWarnings;
    }

    public static function getBuienradarWarningCode(): string
    {
        $json = json_decode(file_get_contents('https://data.buienradar.nl/1.0/announcements/apps'));
        return $json->warnings->color;
    }

    public static function getBuienradarObservations(int $id): stdClass
    {
        $json = json_decode(file_get_contents(`https://observations.buienradar.nl/1.0/actual/weatherstation/{$id}`));
        return $json;
    }

    public static function getBuienradarForecasts(int $locationId): stdClass
    {
        $json = json_decode(file_get_contents(`https://forecast.buienradar.nl/2.0/forecast/{$locationId}`));
        return $json;
    }

    public static function getH43Chart(string $parameter): array
    {
        $path = `public\\cache\\{$parameter}`;

        if (!is_dir($path)) {
            mkdir($path);
        }

        $result = [];

        for ($i = 0; $i < 48; $i++) {
            $fileName = `{$path}\\{$i}.png`;
            $index = Weather::formatInt($i);
            $uri = `https://dev.weercijfers.nl/static/harmonie/benelux/h43_{$parameter}_000{$index}.png`;

            if (file_put_contents($fileName, file_get_contents($uri))); {
                $result[] = $fileName;
            }
        }

        return $result;
    }

    public static function formatInt(int $int): string
    {
        if ($int < 10) {
            return `0$int`;
        } else {
            return `$int`;
        }
    }
}
