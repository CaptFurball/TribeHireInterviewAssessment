<?php

namespace App\Helpers;

class ArrayHelper
{
    /**
     * Helper for grouping associative array
     * 
     * @var array $array The array
     * @var string $attrName The name of the attribute key to group with
     * 
     * @return array Returns an array with attribute value as the key
     * 
     * Example output: 
     * 
     * [
     *      "volvo" => [
     *          [
     *              "name": "edward"
     *              "car": "volvo"
     *          ]
     *      ]
     * ]
     */
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

    /**
     * Helper for sorting associative array by attribute value in descending manner
     * 
     * @var array $array The array
     * @var string $attrName The name of the attribute key to sort with
     * 
     * @return array Returns a sorted array
     */
    public static function sortDescByAttr ($array, $attrName)
    {
        usort($array, function ($a, $b) use ($attrName) {
            return $a[$attrName] < $b[$attrName]? 1: -1;
        });

        return $array;
    }

    /**
     * Helper for sorting associative array by attribute value in ascending manner
     * 
     * @var array $array The array
     * @var string $attrName The name of the attribute key to sort with
     * 
     * @return array Returns a sorted array
     */
    public static function sortAscByAttr ($array, $attrName)
    {
        usort($array, function ($a, $b) use ($attrName) {
            return $a[$attrName] > $b[$attrName]? 1: -1;
        });

        return $array;
    }

    /**
     * Performs strict search. Will only give result 
     * if all attributes in an associative array
     * are matched with the filter's key value pair.
     * Will return all if filters are empty.
     * 
     * @var array $array The array
     * @var string $filters The array of key value pair as filter
     * 
     * @return array Returns array of item which matches all the filters
     */
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

    /**
     * Performs strict REGEX search. Will only give result 
     * if all attributes in an associative array
     * are matched with the filter's key value pair.
     * Will return all if filters are empty.
     * 
     * @var array $array The array
     * @var string $filters The array of key value pair as filter
     * 
     * @return array Returns array of item which matches all the filters
     */
    public static function strictRegexSearch ($array, $filters)
    {
        return array_filter($array, function ($item) use ($filters) {
            $isMatched = true;
            foreach ($filters as $key => $value) {
                if (empty($value)) continue;
                
                if (empty($item[$key]) || !preg_match("/$value/i", $item[$key]) ) {
                    $isMatched = false;
                    break;
                }
            }

            return $isMatched;
        });
    }
}