<?php

namespace App\EventSubscriber;

use DateTime;
use App\EventSubscriber\EasyAdminSubscriber;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\String\Slugger\SluggerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;


class EasyAdminSubscriber implements EventSubscriberInterface
{
    private $slugger;
    private $security;
    

    public function __construct(SluggerInterface $slugger, Security $security)
    {
        $this->slugger = $slugger;
        $this->security = $security;
    }

    public static function getSubsribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setDateAndUser'],
        ];
    }

    public function setDateAndUser(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (($entity instanceof Blogpost)) {
            $now = new DateTime('now');
            $entity->setCreatedAt($now);

            $user = $this->security->getUser();
            $entity->setUser($user);
        }

        if (($entity instanceof Produit)) {
            $now = new DateTime('now');
            $entity->setCreatedAt($now);

            $user = $this->security->getUser();
            $entity->setUser($user);
        }
    
        return;
    }
}
