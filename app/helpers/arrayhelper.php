<?php

namespace App\Helpers;

class ArrayHelper
{
    public static function groupByAttr ($array, $attrName)
    {
        $group = [];

        foreach ($array as $item) {
            if (empty($group[$item[$attrName]])) {
                $group[$item[$attrName]] = [];
            }

            array_push($group[$item[$attrName]], $item);
        }
        
        return $group;
    }

    public static function sortDescByAttr ($array, $attrName)
    {
        usort($array, function ($a, $b) use ($attrName) {
            return $a[$attrName] < $b[$attrName]? 1: -1;
        });

        return $array;
    }

    public static function sortAscByAttr ($array, $attrName)
    {
        usort($array, function ($a, $b) use ($attrName) {
            return $a[$attrName] > $b[$attrName]? 1: -1;
        });

        return $array;
    }

    public static function strictSearch ($array, $filters)
    {
        return array_filter($array, function ($item) use ($filters) {
            $isMatched = true;
            foreach ($filters as $key => $value) {
                if (empty($value)) continue;
                
                if (empty($item[$key]) || $item[$key] != $value) {
                    $isMatched = false;
                    break;
                }
            }

            return $isMatched;
        });
    }
}