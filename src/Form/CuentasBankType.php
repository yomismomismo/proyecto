<?php

namespace App\Form;

use App\Entity\CuentasBank;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\{ChoiceType,TextareaType,SubmitType,HiddenType, TextType};
class CuentasBankType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('num_tarjeta')
            ->add('ultimos_digitos',HiddenType::class,)
            ->add('titular')
            ->add('fecha_caducidad')
            // ->add('cvv')
            ->add('id_cliente',HiddenType::class,)
            ->add('send', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CuentasBank::class,
        ]);
    }
}
