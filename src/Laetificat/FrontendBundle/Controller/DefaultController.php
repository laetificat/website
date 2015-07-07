<?php

namespace Laetificat\FrontendBundle\Controller;

use Doctrine\Common\Persistence\ObjectManager;
use Laetificat\CommonBundle\Entity\MenuRepository;
use Laetificat\CommonBundle\Entity\PageRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DefaultController
 * @package Laetificat\FrontendBundle\Controller
 *
 * @Route(service="laetificat.frontend.controllers.default")
 */
class DefaultController extends Controller
{
    private $objectManager;
    private $pageRepository;
    private $menuRepository;

    public function __construct(ObjectManager $objectManager, PageRepository $pageRepository, MenuRepository $menuRepository)
    {
        $this->pageRepository = $pageRepository;
        $this->menuRepository = $menuRepository;
        $this->objectManager = $objectManager;
    }

    /**
     * @Route("{page}", defaults={"page" = "/"}, requirements={"page" = ".+"})
     * @Template("LaetificatFrontendBundle:Frontend:index.html.twig")
     */
    public function indexAction($page)
    {
        $page = $this->pageRepository->findOneBy(array("slug" => $page));

        if ($page == null) {
            return new Response("This page could not be found", 404);
        }

        $content = [];

        $content["content"] = $page->getContent();

        $content["menus"] = $page->getMenus()->toArray();

        return $content;
    }
}
