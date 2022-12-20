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

namespace Farmatholin\SegmentIoBundle\Configuration;

/**
 * Perform message for sending
 *
 * Interface AnalyticsInterface
 *
 * @author Vladislav Marin <vladislav.marin92@gmail.com>
 */
interface AnalyticsInterface
{
    /**
     * @return array
     */
    public function getMessage(): array;
}
