<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehiculeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('make', ChoiceType::class, array(
                'choices' => array(
                    'MG' => 'MG',
                    'Triumph' => 'Triumph',
                    'Austin-Healey'   => 'Austin-Healey'
                ),
                'choice_attr' => function ($val, $key, $index) {
                    return ['data-brand' => $key];
                },
                'choices_as_values' => true,
                'label' => 'Marque',
                'required' => false
            ))
            ->add('model', TextType::class, array(
                'attr' => array(
                    'placeholder' => 'Modèles du véhicule'
                ),
                'label' => 'Modèle',
                'required' => false
            ))
            ->add('id', HiddenType::class, array())
            ->add('year', TextType::class, array(
                'attr' => array(
                    'placeholder' => 'Année du véhicule',
                    'pattern'     => '.{4,}'
                ),
                'label' => 'Année',
                'required' => false
            ))
            ->add('title', TextType::class, array(
                'attr' => array(
                    'placeholder' => 'Titre du véhicule',
                ),
                'label' => 'Titre',
                'required' => false
            ))
            ->add('description', TextareaType::class, array(
                'attr' => array(
                    'cols' => 80,
                    'rows' => 5,
                    'placeholder' => 'Texte descriptif du véhicule'
                ),
                'label' => 'Description',
                'required' => false
            ))
            ->add('price', TextType::class, array(
                'attr' => array(
                    'placeholder' => 'Prix (Facultatif)',
                    'pattern'     => '.{1,}'
                ),
                'label' => 'Prix',
                'required' => false
            ))
            ->add('sold', CheckboxType::class, array(
                'label' => 'Vendu',
                'required' => false
            ))
            ->add('warranty', TextType::class, array(
                'attr' => array(
                    'placeholder' => 'Garantie (Facultatif)',
                    'pattern'     => '.{1,}'
                ),
                'label' => 'Garantie',
                'required' => false
            ))
            ->add('main_image', FileType::class, array(
                'label'    => 'Image Principale',
                'data_class' => null,
                'required' => false
            ))
            ->add('images', FileType::class, array(
                'label'    => 'Autres Images',
                'required' => false,
                'data_class' => null,
                'multiple' => true
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Form\Model\Vehicule',
        ));
    }

    public function getName()
    {
        return 'vehicule';
    }
}