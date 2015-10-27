<?php

namespace Hypersites\StockBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Hypersites\StockBundle\Entity\ProductAttribute;

/**
 * VariationAttributes
 *
 * @ORM\Table(name="variation_attributes")
 * @ORM\Entity(repositoryClass="Hypersites\StockBundle\Entity\VariationAttributesRepository")
 */
class VariationAttributes
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
     **
     * @ORM\ManyToOne(targetEntity="ProductAttribute", inversedBy="variationAttributes")
     * @ORM\JoinColumn(name="product_attribute_id", referencedColumnName="id")
     *
     */
    private $productAttribute;

    /**
     * @var string
     *
     * @ORM\Column(name="attribute_value", type="string", length=45)
     */
    private $attributeValue;
     
    /**
     * @ORM\ManyToMany(targetEntity="ProductVariation", mappedBy="variationAttributes")
     * 
     **/
    private $productVariations;

    
    public function __construct() {
        $this->productVariations = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set productAttribute
     *
     * @param \stdClass $productAttribute
     *
     * @return VariationAttributes
     */
    public function setProductAttribute($productAttribute)
    {
        $this->productAttribute = $productAttribute;

        return $this;
    }

    /**
     * Get productAttribute
     *
     * @return \stdClass
     */
    public function getProductAttribute()
    {
        return $this->productAttribute;
    }

    /**
     * Set attributeValue
     *
     * @param string $attributeValue
     *
     * @return VariationAttributes
     */
    public function setAttributeValue($attributeValue)
    {
        $this->attributeValue = $attributeValue;

        return $this;
    }

    /**
     * Get attributeValue
     *
     * @return string
     */
    public function getAttributeValue()
    {
        return $this->attributeValue;
    }
    
    /**
     * 
     * @return ArrayCollection
     */
    public function getProductVariations() {
        return $this->productVariations;
    }
    
    public function addProductVariation(ProductVariation $productVariation) {
        $this->productVariations->add($productVariation);
        return $this;
    }


}

