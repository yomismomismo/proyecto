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
            // ->add('fecha_Registro', HiddenType::class)
            ->add('telefono')
            ->add('provincia',ChoiceType::class, [
                'choices' => [
                    '- selecciona -' => '',
                    'A coruña' => 'A coruña',
                    'Álava' => 'Álava',
                    'Albacete' => 'Albacete',
                    'Alicante' => 'Alicante',
                    'Almería' => 'Almería',
                    'Asturias' => 'Asturias',
                    'Ávila' => 'Ávila',
                    'Badajoz' => 'Badajoz',
                    'Baleares' => 'Baleares',
                    'Barcelona' => 'Barcelona',
                    'Burgos' => 'Burgos',
                    'Cáceres' => 'Cáceres',
                    'Cádiz' => 'Cádiz',
                    'Cantabria' => 'Cantabria',
                    'Castellón' => 'Castellón',
                    'Ceuta' => 'Ceuta',
                    'Ciudad Real' => 'Ciudad Real',
                    'Córdoba' => 'Córdoba',
                    'Cuenca' => 'Cuenca',
                    'Girona' => 'Girona',
                    'Granada' => 'Granada',
                    'Castellón' => 'Castellón',
                    'Guadalajara' => 'guadalajara',
                    'Guipuzcoa' => 'Guipúzcoa',
                    'Huelva' => 'Huelva',
                    'Huesca' => 'Huesca',
                    'Jaén' => 'Jaén',                    'La rioja' => 'La rioja',
                    'Las palmas' => 'Las palmas',
                    'León' => 'León',
                    'Lleida' => 'Lleida',
                    'Lugo' => 'Lugo',
                    'Madrid' => 'Madrid',
                    'Málaga' => 'Málaga',
                    'Melilla' => 'Melilla',
                    'Murcia' => 'Murcia',
                    'Navarra' => 'Navarra',
                    'Ourense' => 'Ourense',
                    'Palencia' => 'Palencia',
                    'Pontevedra' => 'Pontevedra',
                    'Salamanca' => 'Salamanca',
                    'Santa cruz de tenerife' => 'Santa cruz de tenerife',
                    'Segovia' => 'Segovia',
                    'Sevilla' => 'Sevilla',
                    'Soria' => 'Soria',
                    'Tarragona' => 'Tarragona',
                    'Teruel' => 'Teruel',
                    'Toledo' => 'Toledo',
                    'Valencia' => 'Valencia',                    'Valladolid' => 'Valladolid',
                    'Vizcaya' => 'Vizcaya',
                    'Zamora' => 'Zamora',
                    'Zaragoza' => 'Zaragoza',]])
            ->add('direccion')
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
