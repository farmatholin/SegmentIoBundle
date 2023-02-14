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

use Segment\Segment as Analytics;

/**
 * Class SegmentIoProvider
 *
 * @author Vladislav Marin <vladislav.marin92@gmail.com>
 */
class SegmentIoProvider
{
    const SEGMENT_IO_PROVIDER__ENV_PROD = 'prod';
    const SEGMENT_IO_PROVIDER__ENV_DEV = 'dev';

    /**
     * @var bool isEnabled
     */
    private bool $isEnabled;

    /**
     * SegmentIoProvider constructor.
     *
     * @param string       $key
     * @param string       $environment
     * @param array        $options
     * @param Callable     $logger
     */
    public function __construct(string $key, string $environment, array $options, callable $logger)
    {
        $this->isEnabled = $environment === self::SEGMENT_IO_PROVIDER__ENV_PROD && $key;
        $options['error_handler'] = $logger;
        if ($this->isEnabled) {
            Analytics::init($key, $options);
        }
    }

    /**
     * @param array $message
     *
     * @return bool
     */
    public function track(array $message): bool
    {
        return $this->process('track', $message);
    }

    /**
     * @param array $message
     *
     * @return bool
     */
    public function identify(array $message): bool
    {
        return $this->process(__FUNCTION__, $message);
    }

    /**
     * @param array $message
     *
     * @return bool
     */
    public function page(array $message): bool
    {
        return $this->process(__FUNCTION__, $message);
    }

    /**
     * @param array $message
     *
     * @return bool
     */
    public function alias(array $message): bool
    {
        return $this->process(__FUNCTION__, $message);
    }

    /**
     * @param array $message
     *
     * @return bool
     */
    public function group(array $message): bool
    {
        return $this->process(__FUNCTION__, $message);
    }

    /**
     * @return mixed
     */
    public function flush(): bool
    {
        if ($this->isEnabled) {
            return Analytics::flush();
        }

        return true;
    }

    /**
     * @param array  $msg
     * @param string $string
     *
     * @return bool
     */
    public function validate(array $msg, string $string): bool
    {
        try {
            Analytics::validate($msg, $string);
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

    /**
     * @param string $name
     * @param array  $params
     *
     * @return bool
     */
    private function process(string $name, array $params): bool
    {
        if ($this->isEnabled) {
            return Analytics::$name($params);
        }

        return true;
    }
}
