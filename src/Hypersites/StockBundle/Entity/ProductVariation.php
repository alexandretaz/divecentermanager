<?php

namespace Hypersites\StockBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Hypersites\StockBundle\Entity\Product;

/**
 * ProductVariation
 *
 * @ORM\Table(name="product_variation")
 * @ORM\Entity(repositoryClass="Hypersites\StockBundle\Entity\ProductVariationRepository")
 */
class ProductVariation
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
     * @var Product
     *
      @ORM\ManyToOne(targetEntity="Product", inversedBy="variations")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;

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
     * @var integer
     *
     * @ORM\Column(name="qtyStock", type="integer")
     */
    private $qtyStock;
    
    /**
     * @ORM\ManyToMany(targetEntity="VariationAttributes", inversedBy="productVariations")
     * @ORM\JoinTable(name="product_variation_has_variation_attributes")
     **/
    private $variationAttributes;
    
    /**
     *
     * @ORM\OneToMany(targetEntity="Item", mappedBy="productVariation") 
     */
    private $items;
    
    
    public function __construct() {
        $this->variationAttributes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set product
     *
     * @param \stdClass $product
     *
     * @return ProductVariation
     */
    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \stdClass
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set minCost
     *
     * @param string $minCost
     *
     * @return ProductVariation
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
     * @return ProductVariation
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
     * Set qtyStock
     *
     * @param integer $qtyStock
     *
     * @return ProductVariation
     */
    public function setQtyStock($qtyStock)
    {
        $this->qtyStock = $qtyStock;

        return $this;
    }

    /**
     * Get qtyStock
     *
     * @return integer
     */
    public function getQtyStock()
    {
        return $this->qtyStock;
    }
    
    public function getVariationAttributes() {
        return $this->variationAttributes;
    }


}

