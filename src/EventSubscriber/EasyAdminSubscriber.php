<?php

namespace App\EventSubscriber;

use App\Entity\Excuse;
use DateTime;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    private $security;
    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setDateAndUser'],
        ];
    }
    public function setDateAndUser(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();
        // Ppur chaque excuse, on set la date et le user
        if (($entity instanceof Excuse)) {
            $now = new DateTime('now');
            $entity->setCreatedAt($now);
        }
        return;
    }
}
