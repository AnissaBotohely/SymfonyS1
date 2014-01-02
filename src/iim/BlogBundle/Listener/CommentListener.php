<?php

namespace iim\BlogBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use iim\BlogBundle\Entity\Comment;

class CommentListener {


    protected $container;


    public function __construct($container)
    {
        $this->container = $container;
    }


    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        //agir sur un Comment
        if ($entity instanceof Comment) {
            $user = $this->container->get('security.context')->getToken()->getUser();
            $entity->setAuthor($user);

        }



    }
}