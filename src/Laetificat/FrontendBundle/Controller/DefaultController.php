<?php

namespace Laetificat\FrontendBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", defaults={"page" = "/"})
     * @Template("LaetificatFrontendBundle:Frontend:index.html.twig")
     */
    public function indexAction($page)
    {
        var_dump($page);

        return array(
            "menu" => array(
                "Home" => "/",
                "Projects" => "/projects",
                "Admin" => "/admin"
            )
        );
    }
}
