<?php

namespace Laetificat\AdminBundle\Controller;

use Laetificat\CommonBundle\Entity\Menu;
use Laetificat\CommonBundle\Entity\MenuItem;
use Laetificat\CommonBundle\Entity\Project;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManager;

class DefaultController extends Controller
{
    /**
     * @Route("/admin")
     */
    public function indexAction()
    {
        return new Response("The admin page");
    }

    /**
     * @Route("/admin/menus/edit")
     */
    public function editMenuAction()
    {
        $menu = new Menu();
        $menuItem = new MenuItem();
        $menuItem->setName("Home");
        $menuItem->setUrl("/");

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
