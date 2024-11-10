<?php

namespace App\Http\Helpers;

class Estofex
{

    public static function GetWarningDetails(string $url): array
    {
        $content = file_get_contents($url);
        $datas = [];
        preg_match_all('/<P CLASS="bulletin".*?<\/P>/s', $content, $datas);

        return $datas;
    }

    public static function GetWarnings(bool $onlyValid): array
    {
        $url = 'https://www.estofex.org/cgi-bin/polygon/showforecast.cgi?list=yes';

        if ($onlyValid) {
            $url = 'https://www.estofex.org/cgi-bin/polygon/showforecast.cgi?listvalid=yes';
        } 

        $estofex = file_get_contents($url);
        $forecasts = [];

        preg_match_all('/<TR.*?<\/TR>/s', $estofex, $forecasts);

        $result = [];
        $forecastList = $forecasts[0];

        for ($i = 1; $i < count($forecastList); $i++) {
            if (str_contains($forecastList[$i], 'issued')) {
                $result[] = Estofex::ParseWarning($forecastList[$i], $onlyValid);
            }
        }

        return $result;
    }

    private static function ParseWarning($tableRow, bool $isValidOnly)
    {
        $tableDatas = [];
        preg_match_all('/<TD.*?<\/TD>/s', $tableRow, $tableDatas);

        $warning = [];

        if ($isValidOnly) {
            $warning = Estofex::ParseTableData2($tableDatas[0]);
        } else {
            $warning = Estofex::ParseTableData($tableDatas[0]);
        }

        return $warning;
    }

    private static function ParseWarningUrl($tableData)
    {
        $href = [];
        preg_match('/HREF="(.*)"/', $tableData, $href);

        return $href[1];
    }

    private static function ParseTableData($tableData)
    {
        $data = [];
        preg_match('/<P (.*?)>(.*?)<BR>issued:(.*?)<\/P>/s', $tableData[0], $data);

        $title = $data[2];
        $date = $data[3];

        return [
            'title' => $title,
            'issued' => $date,
            'url' => 'https://www.estofex.org' . Estofex::ParseWarningUrl($tableData[0]),
            'level' => 'https://www.estofex.org' . Estofex::ParseWarningLevel($tableData[1]),
            'valid' => Estofex::ParseWarningValidTime($tableData[2]),
            'issuer' => Estofex::ParseWarningIssuer($tableData[3]),
            'map' => 'https://www.estofex.org/forecasts/tempmap/' . substr(Estofex::ParseWarningUrl($tableData[0]), strpos(Estofex::ParseWarningUrl($tableData[0]), 'fcstfile=') + 9) . '.png',
        ];
    }

    private static function ParseTableData2($tableData)
    {
        $data = [];
        preg_match('/<P (.*?)>(.*?)<BR>issued:(.*?)<\/P>/s', $tableData[0], $data);

        $title = $data[2];
        $date = $data[3];

        return [
            'title' => $title,
            'issued' => $date,
            'url' => 'https://www.estofex.org' . Estofex::ParseWarningUrl($tableData[0]),
            'level' => 'https://www.estofex.org' . Estofex::ParseWarningLevel($tableData[2]),
            'valid' => Estofex::ParseWarningValidTime($tableData[3]),
            'issuer' => Estofex::ParseWarningIssuer($tableData[4]),
            'map' => 'https://www.estofex.org/forecasts/tempmap/' . substr(Estofex::ParseWarningUrl($tableData[0]), strpos(Estofex::ParseWarningUrl($tableData[0]), 'fcstfile=') + 9) . '.png',
        ];
    }


    private static function ParseWarningLevel($tableData)
    {
        $src = [];
        preg_match('/SRC="(.*)"/s', $tableData, $src);

        return $src[1];
    }

    private static function ParseWarningValidTime($tableData)
    {
        $time = [];
        preg_match('/<P (.*?)>(.*?)\-<BR>(.*?)UTC<\/P>/s', $tableData, $time);

        return [
            'from' => $time[2],
            'to' => $time[3],
        ];
    }

    private static function ParseWarningIssuer($tableData)
    {
        $issuer = [];
        preg_match('/<P (.*?)>(.*?)<\/P>/s', $tableData, $issuer);

        return $issuer[2];
    }
}
