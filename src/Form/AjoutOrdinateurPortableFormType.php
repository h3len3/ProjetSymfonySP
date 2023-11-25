<?php

namespace App\Form;

use App\Entity\OrdinateurPortable;
use Symfony\Component\Form\AbstractType;
use App\Form\AjoutOrdinateurPortableFormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AjoutOrdinateurPortableFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reference')
            ->add('nom')
            ->add(
                'marque', ChoiceType::class,
                [
                    'choices' => OrdinateurPortable::MARQUE
                ]
            )
            ->add('prix')
            ->add(
                'processeur',
                ChoiceType::class,
                [
                    'choices' => OrdinateurPortable::PROCESSEUR
                ]
            )
            ->add(
                'systemeExploitation',
                ChoiceType::class,
                [
                    'choices' => OrdinateurPortable::SYSTEME_EXPLOITATION
                ]
            )
            ->add('commentaire')
            // ->add('image')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => OrdinateurPortable::class,
        ]);
    }
}
