<?php

namespace Laetificat\CommonBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class MenuItem
 * @package Laetificat\CommonBundle\Entity
 * @ORM\Entity(repositoryClass="Laetificat\CommonBundle\Entity\MenuItemRepository")
 */
class MenuItem
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
     * @ORM\Column(type="string")
     */
    private $url;

    /**
     * @ORM\Column(type="boolean")
     */
    private $adminOnly;

    /**
     * @ORM\ManyToMany(targetEntity="Laetificat\CommonBundle\Entity\Menu", mappedBy="menuItems")
     */
    private $menus;

    public function __construct()
    {
        $this->menus = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getAdminOnly()
    {
        return $this->adminOnly;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function setUrl($url)
    {
        $this->url = $url;

        return $url;
    }

    public function setAdminOnly($adminOnly)
    {
        $this->adminOnly = $adminOnly;

        return $this;
    }
}