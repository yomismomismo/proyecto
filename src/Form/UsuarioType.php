<?php

namespace App\Form;

use App\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\{ChoiceType,TextareaType,SubmitType,HiddenType, TextType};
class UsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('apellido')
            ->add('email')
            ->add('fecha_Registro', HiddenType::class)
            ->add('telefono')
            ->add('provincia',ChoiceType::class, [
                'choices' => [
                    '- selecciona -' => '',
                    'A coruña' => 'A coru&#241;a',
                    'Álava' => 'Álava',
                    'Albacete' => '2',
                    'Alicante' => '1',
                    'Almería' => 'Almer&#237;a',
                    'Asturias' => 'Asturias',
                    'Ávila' => 'Ávila',
                    'Badajoz' => 'Badajoz',
                    'Baleares' => 'Baleares',
                    'Barcelona' => 'Barcelona',
                    'Burgos' => 'Burgos',
                    'Cáceres' => 'Cáceres',
                    'Cádiz' => 'A coru&#241;a',
                    'Cantabria' => 'Cantabria',
                    'Castellón' => 'Castellón',
                    'Ceuta' => 'Ceuta',
                    'Ciudad Real' => 'Ciudad Real',
                    'Córdoba' => 'Córdoba',
                    'Cuenca' => 'Cuenca',
                    'Girona' => 'Girona',
                    'Granada' => 'Granada',
                    'Cantabria' => 'Cantabria',
                    'Castell&#243;n' => 'Castell&#243;n',
                    'Baleares' => 'Baleares',
                    'Barcelona' => 'Barcelona',
                    'Burgos' => 'Burgos',
                    'C&#225;ceres' => 'C&#225;ceres',
                    'C&#225;diz' => 'A coru&#241;a',
                    'Cantabria' => 'Cantabria',
                    'Castell&#243;n' => 'Castell&#243;n',]])
            ->add('direccion')
            ->add('contrasenya')
            ->add('cod_postal')
            ->add('send', submittype::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Usuario::class,
        ]);
    }
}
