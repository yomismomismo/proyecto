<?php

namespace App\Form;

use App\Entity\{Comentario, Producto, Usuario};
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\{ChoiceType,TextareaType,SubmitType,HiddenType, TextType};

class ComentarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('puntuacion',ChoiceType::class, [
                'choices' => [
                    'star5' => '5',
                    'star4' => '4',
                    'star3' => '3',
                    'star2' => '2',
                    'star1' => '1'],

            'multiple'=>false,'expanded'=>true])
            ->add('comentario',TextareaType::class,)
            ->add('fecha',HiddenType::class,)
             ->add('send', SubmitType::class,['label' => 'Enviar Comentario'])
             ->add('IdUsuario',HiddenType::class,)
            ->add('IdProducto',HiddenType::class,);


        //     ->add('id_usuario' ,ChoiceType::class,[
        //     'choices' => [
        //         'star5' => '5',
        //         'star4' => '4',
        //         'star3' => '3',
        //         'star2' => '2',
        //         'star1' => '1'],

        // 'multiple'=>false,'expanded'=>true])

    //     ->add('id_producto' ,ChoiceType::class,[
    //         'choices' => [
    //             'star5' => '5',
    //             'star4' => '4',
    //             'star3' => '3',
    //             'star2' => '2',
    //             'star1' => '1'],

    //     'multiple'=>false,'expanded'=>true]);


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Comentario::class,
        ]);
    }
}
