<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2019-03-26
 * Time: 오전 8:37
 */

namespace App\tests\lib;




use App\lib\ConvertData;
use PHPUnit\Framework\TestCase;

class ConvertDataTest extends TestCase
{
    public function testConvertAssociativeArraysFromIndexedArrays(){

        $testArray = ['a','b','c'];
        $convertData = new ConvertData();
        $actual = $convertData->convertAssociativeArraysFromIndexedArrays($testArray);

        $expected = ['a' => 'a','b' => 'b','c' => 'c'];

        $this->assertEquals($expected, $actual);

    }
}