<?php

namespace App\Form;

use App\Entity\Productoxpedidos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\{SubmitType, HiddenType, TextType, EmailType, TextareaType};
class ProductoxpedidoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cantidad', TextType::class)
            ->add('id_producto', HiddenType::class)
            ->add('id_pedido', HiddenType::class)
            ->add('send', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Productoxpedidos::class,
        ]);
    }
}
