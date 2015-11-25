<?php

namespace Hypersites\StockBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Hypersites\StockBundle\Entity\StockMovement;

class StockMovementType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('kindMovement','choice', array(
                'choices'=>  array(
                StockMovement::RECEIVED_FROM_SUPPLIER=>"Received From Supplier",
                StockMovement::SELLED=>"Sell",
                StockMovement::RETURNED_BY_CUSTOMER=>"Return By Customer",
                StockMovement::RETURNED_TO_SUPPLIER=>"Send Back to The Supplier",
                StockMovement::INTERNAL_USE=>"Move to Internal Use",
                StockMovement::RENT=>"Rent Equipament"    
                )
            ))
            ->add('movedBy')
            ->add('description')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Hypersites\StockBundle\Entity\StockMovement'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'hypersites_stockbundle_stockmovement';
    }
}
