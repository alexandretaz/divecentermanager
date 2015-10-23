<?php

namespace Hypersites\StockBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Hypersites\StockBundle\Entity\ProductAttribute as Attribute;

/**
 * Product
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Hypersites\StockBundle\Entity\ProductRepository")
 */
class Product
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
     * @ORM\ManyToMany(targetEntity="Supplier", mappedBy="products")
     **/
    private $suppliers;

    /**
     * @ORM\ManyToOne(targetEntity="Brand", inversedBy="products")
     * @ORM\JoinColumn(name="brand_id", referencedColumnName="id")
     *
     */
    private $brand;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="min_cost", type="decimal")
     */
    private $minCost;

    /**
     * @var string
     *
     * @ORM\Column(name="max_cost", type="decimal")
     */
    private $maxCost;

    /**
     * @var string
     *
     * @ORM\Column(name="supplier_ean", type="string", length=255, nullable=true)
     */
    private $supplierEan;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var array
     *
     * @ORM\Column(name="contents", type="json_array", nullable=true)
     */
    private $contents;
    
    /**
     *
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="ProductAttribute", mappedBy="product") 
     */
    private $attributes;
    
    /**
     * @ORM\OneToMany(targetEntity="ProductVariation", mappedBy="product")
     */
    private $variations;
    
    public function __construct( ) {
        $this->suppliers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->attributes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->variations = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set suppliers
     *
     * @param array $suppliers
     *
     * @return Product
     */
    public function setSuppliers($suppliers)
    {
        $this->suppliers = $suppliers;

        return $this;
    }

    /**
     * Get suppliers
     *
     * @return array
     */
    public function getSuppliers()
    {
        return $this->suppliers;
    }

    /**
     * Set brand
     *
     * @param \stdClass $brand
     *
     * @return Product
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \stdClass
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Product
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
     * Set minCost
     *
     * @param string $minCost
     *
     * @return Product
     */
    public function setMinCost($minCost)
    {
        $this->minCost = $minCost;

        return $this;
    }

    /**
     * Get minCost
     *
     * @return string
     */
    public function getMinCost()
    {
        return $this->minCost;
    }

    /**
     * Set maxCost
     *
     * @param string $maxCost
     *
     * @return Product
     */
    public function setMaxCost($maxCost)
    {
        $this->maxCost = $maxCost;

        return $this;
    }

    /**
     * Get maxCost
     *
     * @return string
     */
    public function getMaxCost()
    {
        return $this->maxCost;
    }

    /**
     * Set supplierEan
     *
     * @param string $supplierEan
     *
     * @return Product
     */
    public function setSupplierEan($supplierEan)
    {
        $this->supplierEan = $supplierEan;

        return $this;
    }

    /**
     * Get supplierEan
     *
     * @return string
     */
    public function getSupplierEan()
    {
        return $this->supplierEan;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set contents
     *
     * @param array $contents
     *
     * @return Product
     */
    public function setContents($contents)
    {
        $this->contents = $contents;

        return $this;
    }

    /**
     * Get contents
     *
     * @return array
     */
    public function getContents()
    {
        return $this->contents;
    }
    
    /**
     * 
     * @return ArrayCollection
     */
    public function getAttributes() {
        return $this->attributes;
    }

    /**
     * 
     * @param \Doctrine\Common\Collections\ArrayCollection $attributes
     * @return \Hypersites\StockBundle\Entity\Product
     */
    public function setAttributes(\Doctrine\Common\Collections\ArrayCollection $attributes) {
        $this->attributes = $attributes;
        return $this;
    }
    /**
     * 
     * @param Attribute $attributes
     * @return \Hypersites\StockBundle\Entity\Product
     */
    public function addAttributes(Attribute $attributes) {
        $this->attributes->add( $attributes );
        return $this;
    }
    
    public function getVariations() {
        return $this->variations;
    }

}

