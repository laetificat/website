<?php

namespace Laetificat\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Project
 * @package Laetificat\CommonBundle\Entity
 *
 * @ORM\Entity(repositoryClass="Laetificat\CommonBundle\Entity\ProjectRepository")
 * @ORM\Table(name="projects")
 */
class Project
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     */
    private $name;

    public function __construct()
    {

    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}