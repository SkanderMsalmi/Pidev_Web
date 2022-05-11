<?php

namespace App\Form;

use App\Entity\Competance;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompetanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomcompetance')
            ->add('niveau',ChoiceType::class,[
                'choices'=>[
                    'Debutant'=>'Debutant',
                    'Intermediare'=>'Intermediare',
                    'Expert'=>'Expert'
                ]
            ])
            ->add('Ajouter',SubmitType::class)
            /*->add('verifie',ChoiceType::class,[
                'choices'=>[
                    'Oui'=>'Oui',
                    'Non'=>'Non',
                ]
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Competance::class,
        ]);
    }
}
