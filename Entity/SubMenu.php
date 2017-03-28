<?php

namespace Tucompu\CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SubMenu
 *
 * @ORM\Table(name="WEB_sub_menu")
 * @ORM\Entity(repositoryClass="Tucompu\CmsBundle\Repository\SubMenuRepository")
 */
class SubMenu
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Menu", inversedBy="menus")
     */
    private $menu;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Article")
     */
    private $article;

    /**
     * @var bool
     *
     * @ORM\Column(name="isActive", type="boolean")
     */
    private $isActive;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return SubMenu
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return SubMenu
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return bool
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set menu
     *
     * @param \Tucompu\CmsBundle\Entity\Menu $menu
     *
     * @return SubMenu
     */
    public function setMenu(\Tucompu\CmsBundle\Entity\Menu $menu = null)
    {
        $this->menu = $menu;

        return $this;
    }

    /**
     * Get menu
     *
     * @return \Tucompu\CmsBundle\Entity\Menu
     */
    public function getMenu()
    {
        return $this->menu;
    }

    public function __toString()
    {
        return $this->getMenu()."-".$this->getName();
    }

    /**
     * Set article
     *
     * @param \Tucompu\CmsBundle\Entity\Article $article
     *
     * @return SubMenu
     */
    public function setArticle(\Tucompu\CmsBundle\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \Tucompu\CmsBundle\Entity\Article
     */
    public function getArticle()
    {
        return $this->article;
    }
}
