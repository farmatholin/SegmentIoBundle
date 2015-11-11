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
 * @package Farmatholin\SegmentIoBundle\Util
 */
class SegmentIoProvider
{
    public function __construct($key, array $options)
    {
        Analytics::init($key, $options);
    }

    /**
     * @param array $message
     * @return bool
     */
    public function track(array $message){
        return Analytics::track($message);
    }

    /**
     * @param array $message
     * @return bool
     */
    public function identify(array $message){
        return Analytics::identify($message);
    }

    /**
     * @param array $message
     * @return bool
     */
    public function page(array $message){
        return Analytics::page($message);
    }

    /**
     * @param array $message
     * @return bool
     */
    public function alias(array $message){
        return Analytics::alias($message);
    }

    /**
     * @param array $message
     * @return bool
     */
    public function group(array $message){
        return Analytics::group($message);
    }

    /**
     * @return mixed
     */
    public function flush(){
        return Analytics::flush();
    }

    /**
     * @param array $msg
     * @param $string
     * @return bool
     */
    public function validate(array $msg, $string){
        try{
            Analytics::validate($msg, $string);
        }catch (\Exception $e){
            return false;
        }
        return true;
    }
}