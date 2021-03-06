<?php

namespace iim\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="image")
     * @Template()
     */
    public function indexAction()
    {
        return $this->redirect($this->generateUrl('homepage'));
    }
}
