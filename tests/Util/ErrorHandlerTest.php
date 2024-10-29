<?php

declare(strict_types=1);

namespace Farmatholin\SegmentIoBundle\tests\Util;

use Farmatholin\SegmentIoBundle\Util\ErrorHandler;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;

class ErrorHandlerTest extends TestCase
{
    public function test__invoke(): void
    {
        $errorHandler = new ErrorHandler(new NullLogger());

        $errorHandler->__invoke(0, 'test');

        self::expectNotToPerformAssertions();
    }
}
