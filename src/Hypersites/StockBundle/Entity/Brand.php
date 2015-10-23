<?php

namespace Hypersites\StockBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Brand
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Hypersites\StockBundle\Entity\BrandRepository")
 */
class Brand
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255, nullable=true)
     */
    private $logo;

    /**
     * @var string
     *
     * @ORM\Column(name="site", type="string", length=255, nullable=true)
     */
    private $site;
    
    /**
     * @ORM\ManyToMany(targetEntity="Supplier", mappedBy="brands")
     **/
    private $suppliers;
    /**
     *
     * @ORM\OneToMany(targetEntity="Product", mappedBy="brand")
     */
    private $products;
    
    public function __construct( ) {
        $this->suppliers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer
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
     * @return Brand
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
     * Set logo
     *
     * @param string $logo
     *
     * @return Brand
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set site
     *
     * @param string $site
     *
     * @return Brand
     */
    public function setSite($site)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * Get site
     *
     * @return string
     */
    public function getSite()
    {
        return $this->site;
    }
    
    /**
     * 
     * @return ArrayCollection
     */
    public function getSuppliers() {
        return $this->suppliers;
    }
    
    /**
     * 
     * @param array $suppliers
     * @return \Hypersites\StockBundle\Entity\Brand
     */
    public function setSuppliers( array $suppliers) {
        $this->suppliers = $suppliers;
        return $this;
    }
    
    /**
     * 
     * @return ArrayCollection
     */
    public function getProducts() {
        return $this->products();
    }


}

