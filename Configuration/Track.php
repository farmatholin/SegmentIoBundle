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

use Doctrine\Common\Annotations\Annotation;
use Doctrine\Common\Annotations\Annotation\Required;

/**
 * Annotation Track
 *
 * @author Vladislav Marin <vladislav.marin92@gmail.com>
 *
 * @Annotation
 * @Target("METHOD")
 */
class Track implements AnalyticsInterface
{
    /**
     * @Required
     *
     * @var string
     */
    public $event;

    /**
     * @var array
     */
    public $properties = [];

    /**
     * @var array
     */
    public $context = [];

    /**
     * @var bool
     */
    public $useTimestamp = false;

    /**
     * @return string
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param string $event
     */
    public function setEvent($event)
    {
        $this->event = $event;
    }

    /**
     * @return array
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * @param array $properties
     */
    public function setProperties($properties)
    {
        $this->properties = $properties;
    }

    /**
     * @return array
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @param array $context
     */
    public function setContext($context)
    {
        $this->context = $context;
    }

    /**
     * @return bool
     */
    public function isUseTimestamp()
    {
        return $this->useTimestamp;
    }

    /**
     * @param bool $useTimestamp
     */
    public function setUseTimestamp($useTimestamp)
    {
        $this->useTimestamp = $useTimestamp;
    }

    /** @noinspection PhpDocMissingThrowsInspection */
    /**
     * @return array
     */
    public function getMessage()
    {
        $result = [
            'event' => $this->event,
            'properties' => $this->properties,
            'context' => $this->context,
        ];

        if ($this->isUseTimestamp()) {
            /** @noinspection PhpUnhandledExceptionInspection */
            $result['timestamp'] = (new \DateTime())->getTimestamp();
        }

        return $result;
    }
}
