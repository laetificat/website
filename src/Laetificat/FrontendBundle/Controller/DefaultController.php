<?php

namespace Laetificat\FrontendBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template("LaetificatFrontendBundle:Frontend:index.html.twig")
     */
    public function indexAction()
    {
        return array(
            "name" => "bla",
            "menu" => array(
                "Home" => "/",
                "Projects" => "/projects",
                "Admin" => "/admin"
            )
        );
    }
}
