<?php

namespace App\Http\Helpers;

class Helpers
{
    public static function GetFrameSet(string $manifest): array
    {
        $manifestJson = json_decode(file_get_contents('manifests/' . $manifest));
        $radarJson = json_decode(file_get_contents($manifestJson->path));

        $resultSet = [];

        if ($manifestJson->json_node_path == '/') {
            foreach ($radarJson as $frame) {
                $newFrame = [];

                foreach ($frame as $key => $value) {
                    if ($key == $manifestJson->image_node) {
                        if (str_starts_with($value, 'http')) {
                            $newFrame['image'] = $value;
                        } else {
                            $newFrame['image'] = $manifestJson->image_path . '/' . $value;
                        }
                    }
                    if ($key == $manifestJson->time_node) {
                        $newFrame['time'] = $value;
                    }
                }

                $resultSet[] = $newFrame;
            }
        } else {
            $frameSet = $radarJson[$manifestJson->json_node_path];
            foreach ($frameSet as $frame) {
                $newFrame = [];

                foreach ($frame as $key => $value) {
                    if ($key == $manifestJson->image_node) {
                        if (str_starts_with($value, 'http')) {
                            $newFrame['image'] = $value;
                        } else {
                            $newFrame['image'] = $manifestJson->image_path . '/' . $value;
                        }
                    }
                    if ($key == $manifestJson->time_node) {
                        $newFrame['time'] = $value;
                    }
                }

                $resultSet[] = $newFrame;
            }
        }

        return $resultSet;
    }
}
