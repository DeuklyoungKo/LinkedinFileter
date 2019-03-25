<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2019-03-19
 * Time: 오후 4:25
 */
namespace App\Tests\Util;

use App\lib\Calculator;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CalculatorTest extends TestCase
{
    public function testAdd()
    {
        $calculator = new Calculator();
        $result = $calculator->add(30,12);

        $this->assertEquals(42,$result);
    }
}