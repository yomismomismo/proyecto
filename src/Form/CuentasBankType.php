<?php

namespace App\Form;

use App\Entity\CuentasBank;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CuentasBankType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('num_tarjeta')
            ->add('ultimos_digitos')
            ->add('titular')
            ->add('fecha_caducidad')
            ->add('cvv')
            ->add('id_cliente')
            ->add('estado')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CuentasBank::class,
        ]);
    }
}
