<?php

namespace App\Form;

use App\Entity\Vouchers;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VouchersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('StartDate', DateType::class,[
                'widget' => 'single_text'
            ])
            ->add('EndDate', DateType::class,[
                'widget' => 'single_text'
            ])
            ->add('DiscountTier')
            //->add('products')type: string default: Y-m-d H:i:s
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vouchers::class,
            'csrf_protection'=>false,
            'csrf_token_id'=>null
        ]);
    }
}
