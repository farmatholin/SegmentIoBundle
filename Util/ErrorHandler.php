<?php

/**
 * This file is part of the SegmentIoBundle project.
 *
 * (c) Vladislav Marin <vladislav.marin92@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT
 */

namespace Farmatholin\SegmentIoBundle\Util;

use Psr\Log\LoggerInterface;

/**
 * Class ErrorHandler
 */
class ErrorHandler
{
    protected LoggerInterface $logger;

    /**
     * ErrorHandler constructor.
     *
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param string|int $code
     * @param string     $msg
     */
    public function __invoke($code, string $msg)
    {
        $this->logger->error(sprintf('SegmentIO error %s : %s', $code, $msg));
    }
}
