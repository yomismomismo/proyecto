<?php

namespace App\Form;

use App\Entity\Producto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\{ChoiceType,TextareaType,SubmitType,HiddenType, TextType};
class ProductoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imagen')
            ->add('nombre')
            ->add('descripcion')
            ->add('unidades_stock')
        //     ->add('unidades_vendidas', HiddenType::class, [
        //     'data' => '0',
        // ])
            ->add('precio')
            // ->add('categoria',ChoiceType::class, [
            //     'choices' => [
            //         '- selecciona -' => '',
            //         'Comida' => 'Comida',
            //         'Juguetes' => 'Juguetes',
            //         'Henos' => 'Henos',
            //         'Accesorios' => 'Accesorios',]])

            ->add('send', SubmitType::class,['label' => 'Actualizar'])
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Producto::class,
        ]);
    }
}
