<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2019-03-26
 * Time: 오전 8:46
 */

namespace App\lib;


class ConvertData
{


    public function convertAssociativeArraysFromIndexedArrays(array $indexedArray)
    {
        $resultArray = [];

        foreach ($indexedArray as $item) {
            $resultArray[$item] =  $item;
        }

        return $resultArray;
    }
}