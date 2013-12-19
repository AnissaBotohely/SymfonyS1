<?php
/**
 * Created by PhpStorm.
 * User: anissabotohely
 * Date: 19/12/13
 * Time: 22:53
 */

// src/Acme/UserBundle/Entity/User.php

namespace iim\BlogBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}