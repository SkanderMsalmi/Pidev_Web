<?php

namespace App\Form;

use App\Entity\Faculte;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('mots',SearchType::class,[
                'label'=>false,
                'attr'=>[
                    'class'=>'form-control',
                    'placeholder'=>'Entrer un ou plusieurs mots-clés',

                ],'required'=> false

            ])
            ->add('idfaculte',EntityType::class,[
                'class'=>Faculte::class,
                'label'=>'Faculte',
                'attr'=>[
                    'class'=>'form-control'
                ],
                'required'=>false
            ])
            ->add('role',ChoiceType::class,[
                'choices'=>[
                    'Etudiant'=>'Etudiant',
                    'Recruteur'=>'Recruteur',
                    'Formateur'=>'Formateur'
                ],
                'attr'=>[
                    'class'=>'form-control'
                ],
                'required'=>false
            ])
            ->add('Rechercher',SubmitType::class,[
                'attr'=>[
                    'class'=>'btn btn-primary'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
