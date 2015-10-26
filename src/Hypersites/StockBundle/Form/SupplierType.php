<?php

namespace Hypersites\StockBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SupplierType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                    'required'=> true,
                    'label'=>"Supplier's Name:",
                    "attr"=>array(
                        'placeholder'=> "Type Real Name or Company Name"
                        )
                    )
                )
            ->add('alias', 'text',array(
                        'required'=>false,
                        'label' => "Supplier's Alias:"
                    )
                )
            ->add('fiscalDocument', 'text', array(
                        'label' => "Fiscal Document:"
                    )
                )
            ->add('orderEmail', 'email', array(
                        'required'=>false,
                        'label' => "Email to send orders:"
                    ))
            ->add('description', 'textarea', array(
                'required' => false,
                'label' => "Suppliers Description",
                'empty_data' => null,
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Hypersites\StockBundle\Entity\Supplier',
            'class' => 'form-inline',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'hypersites_stockbundle_supplier';
    }
}
