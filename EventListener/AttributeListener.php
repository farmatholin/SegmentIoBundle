<?php

/** @noinspection PhpElementIsNotAvailableInCurrentPhpVersionInspection */

namespace Farmatholin\SegmentIoBundle\EventListener;

use Farmatholin\SegmentIoBundle\Configuration\Page;
use Farmatholin\SegmentIoBundle\Configuration\Track;
use Farmatholin\SegmentIoBundle\Util\SegmentIoProvider;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class AttributeListener
{
    protected SegmentIoProvider $segmentIoProvider;
    protected TokenStorageInterface $tokenStorage;
    protected string $guestId;

    /**
     * AttributeListener constructor.
     *
     * @param TokenStorageInterface $tokenStorage
     * @param SegmentIoProvider     $segmentIoProvider
     * @param string                $guestId
     */
    public function __construct(TokenStorageInterface $tokenStorage, SegmentIoProvider $segmentIoProvider, string $guestId)
    {
        $this->segmentIoProvider = $segmentIoProvider;
        $this->tokenStorage = $tokenStorage;
        $this->guestId = $guestId;
    }

    public function onKernelController(ControllerEvent $event): void
    {
        $controller = $event->getController();

        if (!is_array($controller)) {
            return;
        }

        [$controllerObject, $methodName] = $controller;

        $controllerReflectionObject = new \ReflectionObject($controllerObject);
        $reflectionMethod = $controllerReflectionObject->getMethod($methodName);

        $userId = $this->getUserId();
        foreach ($reflectionMethod->getAttributes(Page::class, \ReflectionAttribute::IS_INSTANCEOF) as $attribute) {
            /** @var Page $page */
            $page = $attribute->newInstance();

            $message = $page->getMessage();
            $message['userId'] = $userId;

            $this->segmentIoProvider->page($message);

            $this->segmentIoProvider->flush();
        }
        foreach ($reflectionMethod->getAttributes(Track::class, \ReflectionAttribute::IS_INSTANCEOF) as $attribute) {
            /** @var Track $track */
            $track = $attribute->newInstance();

            $message = $track->getMessage();
            $message['userId'] = $userId;

            $this->segmentIoProvider->track($message);

            $this->segmentIoProvider->flush();
        }
    }

    /**
     * @return string|null
     *
     * @throws \ReflectionException
     */
    private function getUserId(): ?string
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
