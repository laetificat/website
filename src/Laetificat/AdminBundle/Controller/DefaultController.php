<?php

namespace Laetificat\AdminBundle\Controller;

use Laetificat\CommonBundle\Entity\Menu;
use Laetificat\AdminBundle\Editor\Menu as MenuEditor;
use Laetificat\CommonBundle\Entity\MenuItem;
use Laetificat\CommonBundle\Entity\PageRepository;
use Laetificat\CommonBundle\Entity\Project;
use MyProject\Proxies\__CG__\stdClass;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManager;
use Laetificat\AdminBundle\Editor;
use Laetificat\CommonBundle\Entity\MenuRepository;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class DefaultController
 * @package Laetificat\AdminBundle\Controller
 *
 * @Route(service="laetificat.admin.controllers.default")
 */
class DefaultController extends Controller
{

    private $menuEditor;
    private $objectManager;
    private $pageRepository;
    private $menuRepository;

    public function __construct(
            MenuEditor $menuEditor,
            ObjectManager $objectManager,
            PageRepository $pageRepository,
            MenuRepository $menuRepository
        )
    {
        $this->menuEditor = $menuEditor;
        $this->objectManager = $objectManager;
        $this->pageRepository = $pageRepository;
        $this->menuRepository = $menuRepository;
    }

    /**
     * @Route("/admin")
     * @Template("LaetificatAdminBundle:Backend:index.html.twig")
     */
    public function indexAction()
    {
        $content = [];

        $content["content"] = "Dashboard";

        $page = $this->pageRepository->findOneBy(array("slug" => "/admin"));

        if ($page == null) {
            return new Response("Page not found.", Response::HTTP_NOT_FOUND);
        }

        $content["menus"] = $page->getMenus()->toArray();

        return $content;
    }

    /**
     * @Route("/admin/menus")
     * @Template("LaetificatAdminBundle:Backend:menuOverview.html.twig")
     */
    public function listMenuAction()
    {
        $menus = $this->menuEditor->getMenus();

        $content = [];

        $page = $this->pageRepository->findOneBy(array("slug" => "/admin"));

        if ($page == null) {
            return new Response("Page not found.", Response::HTTP_NOT_FOUND);
        }

        $content["menus"] = $page->getMenus()->toArray();

        foreach ($menus as $menu) {
            $content["menusArray"][] = array (
                "id" => $menu->getId(),
                "name" => $menu->getName(),
                "items" => $menu->getMenuItems()
            );
        }

        return $content;
    }

    /**
     * @Route("/admin/menus/edit/{menuId}", requirements={"menuId"})
     * @Template("LaetificatAdminBundle:Backend:menuEdit.html.twig")
     */
    public function editMenuAction($menuId)
    {
        $menu =$this->menuRepository->findOneBy(array("id" => $menuId));

        $content = [];

        $page = $this->pageRepository->findOneBy(array("slug" => "/admin"));

        if ($page == null) {
            return new Response("Page not found.", Response::HTTP_NOT_FOUND);
        }

        $content["menus"] = $page->getMenus()->toArray();

        $content["menuContent"] = array (
            "id" => $menu->getId(),
            "name" => $menu->getName(),
            "menuItems" => $menu->getMenuItems()
        );

        return $content;

    }

    /**
     * @Route("/admin/projects/edit")
     */
    public function editProjectAction()
    {

    }

    /**
     * @Route("/admin/projects/add")
     */
    public function addProjectAction()
    {
        $project = new Project();
        $project->setName("Testing Project");
        return new Response("bla");
    }

    /**
     * @Route("/admin/projects")
     */
    public function listProjectsAction()
    {
        return new Response();
    }

    /**
     * @Route("/admin/pages")
     * @Template("LaetificatAdminBundle:Backend:pagesOverview.html.twig")
     */
    public function listPagesAction()
    {
        $pages = $this->pageRepository->findAll();

        $content = [];

        $page = $this->pageRepository->findOneBy(array("slug" => "/admin"));

        if ($page == null) {
            return new Response("Page not found.", Response::HTTP_NOT_FOUND);
        }

        $content["menus"] = $page->getMenus()->toArray();

        $content["menusArray"][] = array (
            "id" => 1,
            "name" => "pages",
            "slug" => "pages",
            "menus" => array("main_menu")
        );

        foreach ($pages as $page) {
            $content["pagesArray"][] = array (
                "id" => $page->getId(),
                "name" => $page->getName(),
                "slug" => $page->getSlug(),
                "menus" => $page->getMenus()
            );
        }

        return $content;
    }

    /**
     * @Route("/admin/pages/edit/{pageId}", requirements={"pageId"})
     * @Template("LaetificatAdminBundle:Backend:pageEdit.html.twig")
     */
    public function editPageAction(Request $request, $pageId)
    {
        $editPage = $this->pageRepository->find($pageId);

        $page = $this->pageRepository->findOneBy(array("slug" => "/admin"));

        if ($page == null) {
            return new Response("Page not found.", Response::HTTP_NOT_FOUND);
        }

        $content["menus"] = $page->getMenus()->toArray();

        $content["pageContent"] = array (
            "id" => $editPage->getId(),
            "name" => $editPage->getName(),
            "slug" => $editPage->getSlug(),
            "menus" => $editPage->getMenus(),
            "content" => $editPage->getContent()
        );

        if ($request->isMethod('POST')) {
            $content = $request->getContent();
            var_dump($content);
        }

        return $content;
    }
}
