<?php

namespace Tests\Unit;

use App\Util\ExceptionMessage;
use PHPUnit\Framework\TestCase;

class ExceptionMessageTest extends TestCase
{
    public function testMakeExceptionMessageTest()
    {
        $srcErrors = ["here" => "there"];
        $srcMessage = "here are there";
        $dest = [
            "errors" => $srcErrors,
            "message" => $srcMessage
        ];
        $result = new ExceptionMessage($srcErrors, $srcMessage);
        $this->assertSame($dest["message"], $result->getMessage());
        $this->assertSame($dest["errors"], $result->getErrors());
    }

}
