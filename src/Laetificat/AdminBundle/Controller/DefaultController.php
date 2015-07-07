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
        return new Response("Dashboard");
    }

    /**
     * @Route("/admin/menus")
     * @Template("LaetificatAdminBundle:Backend:menuOverview.html.twig")
     */
    public function listMenuAction()
    {
        $menus = $this->menuEditor->getMenus();

        $content = [];

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
     * @Template("LaetificatAdminBundle:Default:menu_edit.html.twig")
     */
    public function editMenuAction($menuId)
    {
        $menu =$this->menuRepository->findOneBy(array("id" => $menuId));

        $content = [];

        $form = $this->createFormBuilder($menu)
            ->add("name", "text")
            ->add("save", "submit", array("label" => "Save menu"))
            ->getForm();

        $content["form"] = $form->createView();

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
        $page = $this->pageRepository->find($pageId);

        $content["pageContent"] = array (
            "id" => $page->getId(),
            "name" => $page->getName(),
            "slug" => $page->getSlug(),
            "menus" => $page->getMenus(),
            "content" => $page->getContent()
        );

        if ($request->isMethod('POST')) {
            $content = $request->getContent();
            var_dump($content);
        }

        return $content;
    }
}
