<?php

namespace Laetificat\AdminBundle\Editor;

use Doctrine\Common\Persistence\ObjectManager;
use Laetificat\CommonBundle\Entity\MenuRepository;

/**
 * Class Menu
 * @package Laetificat\AdminBundle\Editor
 */
class Menu
{

    private $objectManager;

    private $menuRepository;

    public function __construct(ObjectManager $objectManager, MenuRepository $menuRepository)
    {
        $this->objectManager = $objectManager;
        $this->menuRepository = $menuRepository;
    }

    public function getMenu($menuId)
    {
        $menu = $this->menuRepository->find($menuId);

        return $menu;
    }

    public function getMenus()
    {
        $menus = $this->menuRepository->findAll();

        return $menus;
    }

}