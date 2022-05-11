<?php

namespace App\Form;

use App\Entity\Faculte;
use App\Repository\FaculteRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FaculteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomfaculte',EntityType::class,[
                'class' => Faculte::class,
                'query_builder'=> function(FaculteRepository $rf){
                return $rf->createQueryBuilder('f')
                    ->orderBy('f.nomfaculte','ASC');
                },
                'choice_label'=> 'nomfaculte'
            ])
            ->add('enregistrer',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Faculte::class,
        ]);
    }
}
