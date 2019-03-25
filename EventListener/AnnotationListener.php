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

namespace Farmatholin\SegmentIoBundle\EventListener;

use Doctrine\Common\Annotations\Reader;
use Farmatholin\SegmentIoBundle\Configuration\Page;
use Farmatholin\SegmentIoBundle\Configuration\Track;
use Farmatholin\SegmentIoBundle\Util\SegmentIoProvider;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class AnnotationListener
 *
 * @author Vladislav Marin <vladislav.marin92@gmail.com>
 */
class AnnotationListener
{
    /**
     * @var Reader
     */
    protected $reader;

    /**
     * @var SegmentIoProvider
     */
    protected $segmentIoProvider;

    /**
     * @var TokenStorageInterface
     */
    protected $tokenStorage;

    /**
     * @var string
     */
    protected $guestId;

    /**
     * AnnotationListener constructor.
     *
     * @param Reader                $reader
     * @param TokenStorageInterface $tokenStorage
     * @param SegmentIoProvider     $segmentIoProvider
     * @param string                $guestId
     */
    public function __construct(Reader $reader, TokenStorageInterface $tokenStorage, SegmentIoProvider $segmentIoProvider, $guestId)
    {
        $this->reader = $reader;
        $this->segmentIoProvider = $segmentIoProvider;
        $this->tokenStorage = $tokenStorage;
        $this->guestId = $guestId;
    }

    /**
     * @param FilterControllerEvent $event
     *
     * @throws \ReflectionException
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        $controller = $event->getController();

        if (!is_array($controller)) {
            return;
        }

        list($controllerObject, $methodName) = $controller;

        $controllerReflectionObject = new \ReflectionObject($controllerObject);
        $reflectionMethod = $controllerReflectionObject->getMethod($methodName);

        $userId = $this->getUserId();
        foreach ($this->reader->getMethodAnnotations($reflectionMethod) as $configuration) {
            if ($configuration instanceof Page) {
                $message = $configuration->getMessage();
                $message['userId'] = $userId;

                $this->segmentIoProvider->page(
                    $message
                );

                $this->segmentIoProvider->flush();
            }

            if ($configuration instanceof Track) {
                $message = $configuration->getMessage();
                $message['userId'] = $userId;

                $this->segmentIoProvider->track($message);

                $this->segmentIoProvider->flush();
            }
        }
    }


    /**
     * @return string|null
     *
     * @throws \ReflectionException
     */
    private function getUserId()
    {
        if (null === $token = $this->tokenStorage->getToken()) {
            return $this->guestId;
        }

        if (!is_object($user = $token->getUser())) {
            return $this->guestId;
        }

        $reflect = new \ReflectionClass($user);
        if ($reflect->hasMethod('getId')) {
            $userId = $user->getId();
            if (null !== $userId) {
                return $userId;
            }
        }

        return $this->guestId;
    }
}
