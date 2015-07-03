<?php

namespace Laetificat\CommonBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Page
 * @package Laetificat\CommonBundle\Entity
 * @ORM\Entity(repositoryClass="Laetificat\CommonBundle\Entity\PageRepository")
 */
class Page
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity="Laetificat\CommonBundle\Entity\Menu", inversedBy="pages")
     */
    private $menus;

    /**
     * @ORM\Column(type="string")
     */
    private $content;

    public function __construct()
    {
        $this->menus = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getMenus()
    {
        return $this->menus;
    }

    public function addPage(Menu $menu)
    {
        if (!$this->menus->contains($menu)) {
            $this->menus->add($menu);
        }

        return $this;
    }

    public function removePage(Menu $menu)
    {
        if ($this->menus->contains($menu)) {
            $this->menus->remove($menu);
        }

        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

}