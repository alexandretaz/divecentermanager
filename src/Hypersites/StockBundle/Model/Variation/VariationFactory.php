<?php
namespace Hypersites\StockBundle\Model\Variation;

use Hypersites\StockBundle\Entity\ProductAttribute;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Hypersites\StockBundle\Entity\Product;

/**
 * A Factory that generate a Product Variation
 *
 * @author aandrade
 */
class VariationFactory {
    /**
     *
     * @var ArrayCollection
     */
    private $variationAttributeCollection;
    
    /**
     *
     * @var EntityManager 
     */
    private $em;
    
    /**
     *
     * @var Product
     */
    private $parentProduct;
    /**
     * 
     * @param EntityManager $em
     * @param Product $product
     */
    public function __construct(EntityManager $em, Product $product) {
        $this->em = $em;
        $this->parentProduct = $product;
        $this->variationAttributeCollection = new ArrayCollection();
    }
    /**
     * 
     * @param EntityManager $em
     * @param Product $product
     * @return ArrayCollection
     */
    public static function generate(EntityManager $em, Product $product) {
        $productAttributes = $product->getAttributes();
        $_instance = new self($em, $product);
        return $_instance->factoryByProductAttributes($productAttributes);
    }
    /**
     * Create the Variation based on the parent Product Attributes
     * @param ArrayCollection $attributes
     */
    public function factoryByProductAttributes( $attributes) 
    {
        foreach ($attributes as $attribute) {
            $this->generateVariationAttribute( $attribute );
        }
        $this->generateVariations();
        
    }
    /**
     * Method that create the Variatons Attribute that identify each Variation
     * @param ProductAttribute $productAttribute
     * @retun void()
     */
    private function generateVariationAttribute(ProductAttribute $productAttribute) {
        $values = $productAttribute->getAttributeValue();
        foreach ($values as $variation) {
           $variationAttribute = new \Hypersites\StockBundle\Entity\VariationAttributes();
           $variationAttribute->setProductAttribute($productAttribute);
           $variationAttribute->setAttributeValue($variation);
           $this->em->persist($variationAttribute);
           $this->variationAttributeCollection->add( $variationAttribute );
           
        }
        $productAttribute->setVariationAttributes($this->variationAttributeCollection);
        $this->em->persist($productAttribute);
        $this->em->flush();
    }
    
    private function generateVariations() {
        $agregatedAttributes = $this->separateByProductAttribute();
        foreach ($agregatedAttributes as $aggregationOfAttributes) {
            $variation = new \Hypersites\StockBundle\Entity\ProductVariation();
            $variation->setMaxCost($this->parentProduct->getMaxCost())
                    ->setMinCost($this->parentProduct->getMinCost())
                    ->setProduct($this->parentProduct)
                    ->setQtyStock(0);
            if(is_array($aggregationOfAttributes)) {
                foreach($aggregationOfAttributes as $attribute) {
                    $variation->addVariationAttributes($attribute);
                    $attribute->addProductVariation($variation);
                    $this->em->persist($attribute);
                }
            }
            else{
                $variation->addVariationAttributes($aggregationOfAttributes);
                $attribute->addProductVariation($variation);
                $this->em->persist($aggregationOfAttributes);
            }
            $this->em->persist($variation);
            $this->em->persist($this->parentProduct);
        }
        $this->em->flush();
    }
    
    private function separateByProductAttribute() {
        $variations =[];
        foreach($this->variationAttributeCollection as $variationAttribute){
            $variations[$variationAttribute->getProductAttribute()->getId()][] = $variationAttribute;
        }
        return $this->makeAgregationsForVariations( $variations );
    }
    
    private function makeAgregationsForVariations(array $variationsAttributes) {
       if(count($variationsAttributes)>1) { 
            $baseAttributes = array_shift($variationsAttributes);
            return $this->aggregateDependentAttributes($baseAttributes, $variationsAttributes);
       }
       $simpleReturn = array();
       foreach($variationsAttributes as $attribute) {
           foreach($attribute as $value) {
               $simpleReturn[] =  array($value);
           }
       }
       return $simpleReturn;
       
    }
    
    private function aggregateDependentAttributes( array $variationBaseAttribute, array $variationsAttributes) {
        $qtyDependentsVariations = count($variationsAttributes);
        if($qtyDependentsVariations === 1) {
            return $this->combine($variationBaseAttribute, $variationsAttributes);

        }
        $combination = array_shift($variationBaseAttribute);
        while(!empty($variationsAttributes)) {
            $countVariationsAttributes = count($variationsAttributes);
             if($countVariationsAttributes===1) {
                 return $this->combine($variationBaseAttribute, $combination);
            }
            $arrayToCombine = array_pop($variationsAttributes);
            $combination = $this->combine($combination, $arrayToCombine);
        }
        return $combination;
    }
    
    private function combine( array $attributeSet1, array $attributeSet2) {
        $combinedArray = [];
        foreach ($attributeSet1 as $attributeFromSet1) {
            foreach ($attributeSet2 as $attributeCollectionFromSet2) {
                foreach ($attributeCollectionFromSet2 as $attributeFromSet2) {
                    $combinedArray[] = array($attributeFromSet1,$attributeFromSet2);
                }
            }
        }
        return $combinedArray;
    }
}