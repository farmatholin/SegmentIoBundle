<?php

namespace Farmatholin\SegmentIoBundle\Configuration;

/**
 * Perform message for sending
 *
 * Interface AnalyticsInterface
 *
 * @author Vladislav Marin <vladislav.marin92@gmail.com>
 *
 * @package Farmatholin\SegmentIoBundle\Configuration
 */
interface AnalyticsInterface
{
    /**
     * @return array
     */
    public function getMessage();
}
