<?php

namespace iim\BlogBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use iim\BlogBundle\Entity\Image;

class ImageListener {


    protected $container;


    public function __construct($container)
    {
        $this->container = $container;
    }


    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        //agir sur une Image
        if ($entity instanceof Image) {
            $user = $this->container->get('security.context')->getToken()->getUser();
            $entity->setAuthor($user);
        }

    }
}