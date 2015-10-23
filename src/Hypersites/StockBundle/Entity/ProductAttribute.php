<?php

namespace Hypersites\StockBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Hypersites\StockBundle\Entity\Product;
use \Doctrine\Common\Collections\ArrayCollection;

/**
 * ProductAttribute
 *
 * @ORM\Table(name="product_attribute")
 * @ORM\Entity(repositoryClass="Hypersites\StockBundle\Entity\ProductAttributeRepository")
 */
class ProductAttribute
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
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="attributes")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;

    /**
     * @var string
     *
     * @ORM\Column(name="attribute_name", type="string", length=255)
     */
    private $attributeName;

    /**
     * @var array
     *
     * @ORM\Column(name="attribute_value", type="array")
     */
    private $attributeValue;
    
    /**
     * @ORM\OneToMany(targetEntity="VariationAttributes", mappedBy="productAttribute")
     **/
    private $variationAttributes;

    public function __construct() {
        $this->variationAttributes = new ArrayCollection();
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
     * @param Product $product
     *
     * @return ProductAttribute
     */
    public function setProduct(Product $product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set attributeName
     *
     * @param string $attributeName
     *
     * @return ProductAttribute
     */
    public function setAttributeName($attributeName)
    {
        $this->attributeName = $attributeName;

        return $this;
    }

    /**
     * Get attributeName
     *
     * @return string
     */
    public function getAttributeName()
    {
        return $this->attributeName;
    }

    /**
     * Set attributeValue
     *
     * @param array $attributeValue
     *
     * @return ProductAttribute
     */
    public function setAttributeValue($attributeValue)
    {
        $this->attributeValue = $attributeValue;

        return $this;
    }

    /**
     * Get attributeValue
     *
     * @return array
     */
    public function getAttributeValue()
    {
        return $this->attributeValue;
    }
    /**
     * 
     * @return ArrayCollection
     */
    public function getVariationAttributes() {
        return $this->variationAttributes;
    }
    
    /**
     * 
     * @param \Hypersites\StockBundle\Entity\VariationAttributes $attribute
     * @return \Hypersites\StockBundle\Entity\ProductAttribute
     */
    public function addVariationAttributes(VariationAttributes $attribute) {
        $this->variationAttributes->add($attribute);
        return $this;
    }
    
    /**
     * 
     * @param ArrayCollection $variationAttributes
     * @return \Hypersites\StockBundle\Entity\ProductAttribute
     */
    public function setVariationAttributes(ArrayCollection $variationAttributes) {
        $this->variationAttributes = $variationAttributes;
        return $this;
    }


}

