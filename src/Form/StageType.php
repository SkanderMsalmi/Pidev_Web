<?php

namespace App\Form;

use App\Entity\Stage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class StageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('duree')
            ->add('type')
            ->add('domaine',ChoiceType::class, array(
                'choices'=>array(
                    'Informatique'=>'Informatique',
                    'Electronique'=>'Electronique' , 
                    'Mécanique'=>'Mécanique', 
                    'Gestion'=>'Gestion',
                    'Economie'=>'Economie',
                    'Sport'=>'Sport'
                       )))
            ->add('description')
            ->add('sujet')
            ->add('datedebut')
           // ->add('datefin')
            /*->add('id_personne') */
            ->add('Confirmer', SubmitType::class) 
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Stage::class,
           
        ]);
    }
}
