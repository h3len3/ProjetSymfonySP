<?php

namespace App\Form;

use App\Entity\OrdinateurPortable;
use App\Form\EditOrdinateurFormType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EditOrdinateurFormType extends AbstractType
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
            
            /*TODO image
            //https://symfony.com/doc/current/controller/upload_file.html
            //https://developer.mozilla.org/fr/docs/Web/HTTP/Basics_of_HTTP/MIME_types/Common_types
             * ->add('image', FileType::class, [
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File()
                ],
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => OrdinateurPortable::class,
        ]);
    }
}
