<?php

namespace App\EventSubscriber;

use App\Service\Provider\CenturiaProvider;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Twig\Environment;

class TwigEventSubscriber implements EventSubscriberInterface
{
    private $twig;
    private $centuriaProvider;

    public function __construct(Environment $twig, CenturiaProvider $centuriaProvider)
    {
        $this->twig = $twig;
        $this->centuriaProvider = $centuriaProvider;
    }

    public function onKernelController(ControllerEvent $event): void
    {
        $this->twig->addGlobal('centurias', $this->centuriaProvider->getCenturias());

    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }
}
