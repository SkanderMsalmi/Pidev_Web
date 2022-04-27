<?php

namespace App\Form;

use App\Entity\Faculte;
use App\Entity\User;
use App\Repository\FaculteRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username')
            ->add('nom')
            ->add('prenom')
            ->add('tel')
            ->add('cin')
            ->add('email')
            ->add('pdp')
            ->add('datenaissance')
            ->add('profil')
            ->add('infos')
            ->add('datenaissance',DateType::class,[
                'widget'=>'single_text',
                'html5'=>'false',
                'attr'=>['class'=>'js-datepicker']
            ])
            ->add('profil')
            ->add('infos',TextareaType::class)
            ->add('idfaculte',EntityType::class,[
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
            'data_class' => User::class,
        ]);
    }
}
