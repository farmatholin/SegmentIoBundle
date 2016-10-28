<?php
/**
 * Created by PhpStorm.
 * User: Vladislav
 * Date: 11.11.2015
 * Time: 12:10
 */

namespace Farmatholin\SegmentIoBundle\Util;

use Segment as Analytics;

/**
 * Class SegmentIoProvider
 *
 * @package Farmatholin\SegmentIoBundle\Util
 * @author Vladislav Marin <vladislav.marin92@gmail.com>
 */
class SegmentIoProvider
{
    const SEGMENT_IO_PROVIDER__ENV_PROD = 'prod';
    const SEGMENT_IO_PROVIDER__ENV_DEV = 'dev';

    /**
     * @var string
     * environment
     */
    private $environment;

    /**
     * SegmentIoProvider constructor.
     *
     * @param $key
     * @param $environment
     * @param array $options
     */
    public function __construct($key, $environment, array $options)
    {
        $this->environment = $environment;
        if ($this->environment == self::SEGMENT_IO_PROVIDER__ENV_PROD) {
            Analytics::init($key, $options);
        }
    }


    private function process($name, array $params)
    {
        if ($this->environment == self::SEGMENT_IO_PROVIDER__ENV_PROD) {
            return Analytics::$name($params);
        }
        return true;
    }

    /**
     * @param array $message
     * @return bool
     */
    public function track(array $message)
    {
        return $this->process('track',$message);
    }

    /**
     * @param array $message
     * @return bool
     */
    public function identify(array $message)
    {
        return $this->process(__FUNCTION__,$message);
    }

    /**
     * @param array $message
     * @return bool
     */
    public function page(array $message)
    {
        return $this->process(__FUNCTION__,$message);
    }

    /**
     * @param array $message
     * @return bool
     */
    public function alias(array $message)
    {
        return $this->process(__FUNCTION__,$message);
    }

    /**
     * @param array $message
     * @return bool
     */
    public function group(array $message)
    {
        return $this->process(__FUNCTION__,$message);
    }

    /**
     * @return mixed
     */
    public function flush()
    {
        if ($this->environment == self::SEGMENT_IO_PROVIDER__ENV_PROD) {
            return Analytics::flush();
        }
        return true;
    }

    /**
     * @param array $msg
     * @param $string
     * @return bool
     */
    public function validate(array $msg, $string)
    {
        try {
            Analytics::validate($msg, $string);
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }
}
