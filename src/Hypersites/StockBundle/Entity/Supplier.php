<?php

namespace Hypersites\StockBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Supplier
 *
 * @ORM\Table(name="supplier")
 * @ORM\Entity(repositoryClass="Hypersites\StockBundle\Entity\SupplierRepository")
 */
class Supplier
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
     * @ORM\Column(name="alias", type="string", length=255)
     */
    private $alias;

    /**
     * @var string
     *
     * @ORM\Column(name="fiscal_document", type="string", length=25)
     */
    private $fiscalDocument;

    /**
     * @var string
     *
     * @ORM\Column(name="order_email", type="string", length=255, nullable=true)
     */
    private $orderEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;
    
    /**
     * @ORM\ManyToMany(targetEntity="Brand", inversedBy="suppliers")
     * @ORM\JoinTable(name="suppliers_brands")
     **/
    private $brands;
    
    /**
     * @ORM\ManyToMany(targetEntity="Product", inversedBy="suppliers")
     * @ORM\JoinTable(name="products_suppliers")
     **/
    private $products;
    
    public function __construct( ) {
        
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
        $this->brands = new \Doctrine\Common\Collections\ArrayCollection();
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
        $this->createdAt = new DateTime();
        
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
     * @return Supplier
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
     * Set alias
     *
     * @param string $alias
     *
     * @return Supplier
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set fiscalDocument
     *
     * @param string $fiscalDocument
     *
     * @return Supplier
     */
    public function setFiscalDocument($fiscalDocument)
    {
        $this->fiscalDocument = $fiscalDocument;

        return $this;
    }

    /**
     * Get fiscalDocument
     *
     * @return string
     */
    public function getFiscalDocument()
    {
        return $this->fiscalDocument;
    }

    /**
     * Set orderEmail
     *
     * @param string $orderEmail
     *
     * @return Supplier
     */
    public function setOrderEmail($orderEmail)
    {
        $this->orderEmail = $orderEmail;

        return $this;
    }

    /**
     * Get orderEmail
     *
     * @return string
     */
    public function getOrderEmail()
    {
        return $this->orderEmail;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Supplier
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Supplier
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Supplier
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
     * 
     * @return Doctrine\Common\Collections\ArrayCollection
     */
    public function getBrands() {
        return $this->brands;
    }
    
    /**
     * 
     * @param array $brands
     * @return \Hypersites\StockBundle\Entity\Supplier
     */
    public function setBrands( array $brands) {
        $this->brands = $brands;
        return $this;
    }
    
    /**
     * 
     * @param \Hypersites\StockBundle\Entity\Brand $brand
     * @return \Hypersites\StockBundle\Entity\Supplier
     */
    public function addBrand(Brand $brand) {
        $this->brands->add($brand);
        return $this;
    }
    
    /**
     * 
     * @return ArrayCollection
     */
    public function getProducts() {
        return $this->products;
    }
    
    /**
     * 
     * @param \Hypersites\StockBundle\Entity\Product $product
     * @return \Hypersites\StockBundle\Entity\Supplier
     */
    public function addProduct(Product $product) {
        $this->products->add($product) ;
        return $this;
    }
    
    /**
     * 
     * @param array $products
     * @return \Hypersites\StockBundle\Entity\Supplier
     */
    public function setProducts(array $products) {
        $this->products = $products;
        return $this;
    }
}

