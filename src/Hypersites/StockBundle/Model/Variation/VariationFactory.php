<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hypersites\StockBundle\Model\Variation;

use Hypersites\StockBundle\Entity\ProductAttribute;

/**
 * Description of VariationFactory
 *
 * @author aandrade
 */
class VariationFactory {
    
    private $variationCollection = array();
    
    public function factoryByAttributes(ProductAttribute $attributes) 
    {
        
        $firstCollection = array_shift($attributes);
        foreach ($attributes as $attribute) {
            $variation = new \Hypersites\StockBundle\Entity\ProductVariation();
            
            $variation->addVariationAttributes($attribute);
        }
        
    }
    
}
