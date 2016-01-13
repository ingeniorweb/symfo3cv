<?php

namespace ResumeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller {

    /**
     * @Route("/index")
     */
    public function indexAction() {
        return $this->render('ResumeBundle:Default:index.html.twig');
    }

    /**
     * @Route("/test")
     */
    public function testAction() {
        return $this->render('default/test.html.twig');
    }

    /**
     * @Route("/")
     */
    public function homeAction() {
        return $this->render('default/home.html.twig');
    }

}
