<?php

namespace Laetificat\CommonBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Menu
 * @package Laetificat\CommonBundle\Entity
 * @ORM\Entity(repositoryClass="Laetificat\CommonBundle\Entity\MenuRepository")
 */
class Menu
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    private $name;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Laetificat\CommonBundle\Entity\MenuItem", inversedBy="menus")
     */
    private $menuItems;

    /**
     * @ORM\ManyToMany(targetEntity="Laetificat\CommonBundle\Entity\Page", inversedBy="menus")
     */
    private $pages;

    public function __construct()
    {
        $this->menuItems = new ArrayCollection();
        $this->pages = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getMenuItems()
    {
        return $this->menuItems;
    }

    public function addMenuItem(MenuItem $menuItem)
    {
        if (!$this->menuItems->contains($menuItem)) {
            $this->menuItems->add($menuItem);
        }

        return $this;
    }

    public function removeMenuItem(MenuItem $menuItem)
    {
        if ($this->menuItems->contains($menuItem)) {
            $this->menuItems->remove($menuItem);
        }

        return $this;
    }

    public function getPages()
    {
        return $this->pages;
    }

    public function addPage(Page $page)
    {
        if (!$this->pages->contains($page)) {
            $this->pages->add($page);
        }

        return $this;
    }

    public function removePage(Page $page)
    {
        if ($this->pages->contains($page)) {
            $this->pages->remove($page);
        }

        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}