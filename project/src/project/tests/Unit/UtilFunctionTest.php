<?php

namespace Tests\Unit;

use App\Util\Name;
use PHPUnit\Framework\TestCase;

class UtilFunctionTest extends TestCase
{
    public function testOneWordNameTest()
    {
        $src = "here";
        $dest = "Here";
        $result = Name::kebabToPascal($src);
        $this->assertSame($dest, $result);
    }

    public function testTwoWordNameTest()
    {
        $src = "here-are";
        $dest = "HereAre";
        $result = Name::kebabToPascal($src);
        $this->assertSame($dest, $result);
    }

    public function testThreeWordNameTest()
    {
        $src = "here-are-you";
        $dest = "HereAreYou";
        $result = Name::kebabToPascal($src);
        $this->assertSame($dest, $result);
    }
}
