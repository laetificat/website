<?php

namespace Laetificat\AdminBundle\Controller;

use Laetificat\CommonBundle\Entity\Menu;
use Laetificat\AdminBundle\Editor\Menu as MenuEditor;
use Laetificat\CommonBundle\Entity\MenuItem;
use Laetificat\CommonBundle\Entity\Project;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManager;
use Laetificat\AdminBundle\Editor;
use Laetificat\CommonBundle\Entity\MenuRepository;

/**
 * Class DefaultController
 * @package Laetificat\AdminBundle\Controller
 *
 * @Route(service="laetificat.admin.controllers.default")
 */
class DefaultController extends Controller
{

    private $menuEditor;

    public function __construct(MenuEditor $menuEditor)
    {
        $this->menuEditor = $menuEditor;
    }

    /**
     * @Route("/admin")
     */
    public function indexAction()
    {
        return new Response("The admin page");
    }

    /**
     * @Route("/admin/menus")
     * @Template("LaetificatAdminBundle:Backend:index.html.twig")
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
            $items = $menu->getMenuItems();
        }

        return $content;
    }

    /**
     * @Route("/admin/menus/edit/{menuId}", requirements={"menuId"})
     */
    public function editMenuAction($menuId)
    {
        $menu =$this->menuEditor->getMenu($menuId);

        var_dump($menu->getName());
        var_dump($menu->getMenuItems()->toArray());

        $form = $this->createFormBuilder($menu)
            ->add("name", "text")
            ->add("save", "submit", array("label" => "Save menu"))
            ->getForm();

        return $this->render("LaetificatAdminBundle:Default:menu_edit.html.twig", array(
            "form" => $form->createView()
        ));
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
}
